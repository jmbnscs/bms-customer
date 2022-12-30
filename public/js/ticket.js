$(document).ready(function () {
    isDefault();
    displaySuccessMessage();
    setTicketPage();
});

async function setTicketPage() {
    let content = await fetchData('ticket/display.php?account_id=' + account_id);
    var t = $('#customer-ticket-tbl').DataTable({
        pageLength: 5,
        lengthChange: false,
        "searching": true,
        "autoWidth": false
    });

    for (var i = 0; i < content.length; i++) {
        var tag;
        
        tag = (content[i].status == "RESOLVED") ? 'bg-success' : (content[i].status == "PENDING") ? 'bg-warning' : 'bg-danger';
        
        t.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td>${content[i].ticket_num}</td>
                <td>${content[i].category}</td>
                <td>${content[i].date_filed}</td>
                <td>${content[i].date_resolved}</td>
                <td><span class="badge ${tag}">${content[i].status}</span></td>
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
        const [status, concern] = await Promise.all([getStatusName('ticket_status', data.ticket_status_id), fetchData('concerns/category.php?concern_id=' + data.concern_id)]);

        (data.ticket_status_id == 3) ? setTagElement('ticket_status', 1) : (data.ticket_status_id == 2) ? setTagElement('ticket_status', 2) : setTagElement('ticket_status', 3);
        
        id = [
            '#ticket_num', 
            '#concern_category', 
            '#concern_details', 
            '#date_filed', 
            '#resolution_details',
            '#date_resolved',
            '#ticket_status'
        ];

        content = [
            data.ticket_num, 
            concern.category, 
            data.concern_details, 
            formatDateString(data.date_filed),
            (data.resolution_details == null || data.resolution_details == "") ? 'N/A' : data.resolution_details, 
            (data.date_resolved == null || data.date_resolved == "0000-00-00") ? 'N/A' : formatDateString(data.date_resolved), 
            status
        ];

        for (var i = 0; i < content.length; i++) {
            $(id[i]).val(content[i]);
        }
    });

    setCreateTicket();
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