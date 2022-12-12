// On Boot Load
$(document).ready(function () {
    isDefault();

    if (sessionStorage.getItem("save_message") == "Ticket Created Successfully.") {
        toastr.success(sessionStorage.getItem("save_message"));
        sessionStorage.removeItem("save_message");
    }

    setDefaultSetting();
});

// Global Variables
let customer_name;

async function setDefaultSetting() {
    const customer_data = await fetchData('views/customer_data.php?account_id=' + account_id);
    customer_name = customer_data.first_name + " " + customer_data.last_name;

    setTicketHistory();
    setCreateTicket();
}

async function setTicketHistory() {
    let content = await fetchData('ticket/read_single_account.php?account_id=' + account_id);
    var t = $('#customer-ticket-tbl').DataTable();

    for (var i = 0; i < content.length; i++) {
        var tag;
        const [concern, status] = await Promise.all ([fetchData('concerns/read_single.php?concern_id=' + content[i].concern_id), getStatusName('ticket_status', content[i].ticket_status_id)]);
        
        tag = (status == "RESOLVED") ? 'bg-success' : (status == "PENDING") ? 'bg-warning' : 'bg-danger';
        
        t.row.add($(`
            <tr>
                <th scope="row">${content[i].ticket_num}</th>
                <td>${concern.concern_category}</td>
                <td>${formatDateString(content[i].date_filed)}</td>
                <td>${(content.date_resolved == null) ? 'N/A' : formatDateString(content.date_resolved)}</td>
                <td>${content[i].ticket_num}</td>
                <td><span class="badge ${tag}">${status}</span></td>
                <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-ticket" data-bs-whatever="${content[i].ticket_num}"><i class="ri ri-eye-fill"></i></button></td>
                </tr>
        `)).draw(false);
    }

    var viewModal = document.getElementById('view-ticket')
    viewModal.addEventListener('show.bs.modal', async function (event) {
        var modalTitle = viewModal.querySelector('.modal-title');
        modalTitle.textContent = customer_name;
        var button = event.relatedTarget;
        var data_id = button.getAttribute('data-bs-whatever');
        let data, id, content;

        data = await fetchData('ticket/read_single.php?ticket_num=' + data_id);
        const [status, category, admin] = await Promise.all([getStatusName('ticket_status', data.ticket_status_id), fetchData('concerns/read_single.php?concern_id=' + data.concern_id), fetchData('admin/read_single.php?admin_id=' + data.admin_id)]);

        (data.ticket_status_id == 3) ? setTagElement('ticket_status', 1) : (data.ticket_status_id == 2) ? setTagElement('ticket_status', 2) : setTagElement('ticket_status', 3);
        
        id = [
            '#ticket_num', 
            '#concern_category', 
            '#concern_details', 
            '#date_filed', 
            '#resolution_details',
            '#date_resolved',
            '#admin_id',
            '#ticket_status'
        ];

        content = [
            data.ticket_num, 
            category.concern_category, 
            data.concern_details, 
            formatDateString(data.date_filed),
            (data.resolution_details == null || data.resolution_details == "") ? 'N/A' : data.resolution_details, 
            (data.date_resolved == null || data.date_resolved == "0000-00-00") ? 'N/A' : formatDateString(data.date_resolved), 
            (data.admin_id == null) ? 'N/A' : admin.first_name + ' ' + admin.last_name, 
            status
        ];

        for (var i = 0; i < content.length; i++) {
            $(id[i]).val(content[i]);
        }
    });
}

async function generateTicketNum() {
    const added_string = 'TN';
    while (true) {
        let rand_num = added_string + Math.round(Math.random() * Number((9).toString().repeat(6)));
        let content = await fetchData('ticket/read.php?ticket_num=' + rand_num);
        if (!content.exist) {
            if (rand_num.length == (6 + added_string.length)) {
                return rand_num;
            }
        }
    }
}

async function setCreateTicket () {
    const create_ticket = document.getElementById('create-ticket');
    if (sessionStorage.getItem('ticket_num') == null) {
        sessionStorage.setItem('ticket_num', await generateTicketNum());
    }
    $('#ticket_num_create').val(sessionStorage.getItem('ticket_num'));
    $("#date_filed_create").val(generateDateString());

    const concern = await fetchData('concerns/read.php');
    for (var i = 0; i < concern.length; i++) {
        var opt = `<option value='${concern[i].concern_id}'>${concern[i].concern_category}</option>`;
        $("#concern_id_create").append(opt);
    }

    // Form Submits -- onclick Triggers
    create_ticket.onsubmit = (e) => {
        e.preventDefault();
        createTicket();
    };

    async function createTicket() {
        const ticket_num = $('#ticket_num_create').val();
        const concern_id = $('#concern_id_create').val();
        const concern_details = $('#concern_details_create').val();

        const date_filed = generateDateString();
        const user_level = (concern_id == 1 || concern_id == 2) ? 3 : 5;
        
        let url = DIR_API + 'ticket/create.php';
        const createTicketResponse = await fetch(url, {
            method : 'POST',
            headers : {
                'Content-Type' : 'application/json'
            },
            body : JSON.stringify({
                'concern_id' : concern_id,
                'concern_details' : concern_details,
                'date_filed' : date_filed,
                'ticket_status_id' : 1,
                'account_id' : account_id,
                'ticket_num' : ticket_num,
                'user_level' : user_level
            })
        });

        const ticket_content = await createTicketResponse.json();

        if (ticket_content.message == 'Ticket Created') {
            sessionStorage.removeItem('ticket_num');
            sessionStorage.setItem('save_message', "Ticket Created Successfully.");
            window.location.reload();
        }
        else {
            toastr.error("Ticket was not created. " + ticket_content.message + ". Please try again.");
            setTimeout(function(){
                window.location.reload();
            }, 2000);
        }
    }
}