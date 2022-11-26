// On Boot Load
$(document).ready(function () {
    isDefault();

    // if (sessionStorage.getItem('error_message') == "You don't have access to this page.") {
    //     setToastrArgs(sessionStorage.getItem('error_message'), "Error");
    //     sessionStorage.setItem('error_message', null);
    // }
    if (sessionStorage.getItem("save_message") == "Ticket Created Successfully.") {
        toastr.success(sessionStorage.getItem("save_message"));
        sessionStorage.removeItem("save_message");
    }

    setDefaultSetting();
});

// Global Variables
let customer_name;

async function setDefaultSetting() {
    const customer_data = await getCustomerData(account_id);
    customer_name = customer_data.first_name + " " + customer_data.last_name;
    // $('#customer-name').text(customer_name);

    setTicketHistory();
    setCreateTicket();
}

async function setTicketHistory() {
    let content = await getTicketHistory(account_id);
    var t = $('#customer-ticket-tbl').DataTable();

    for (var i = 0; i < content.length; i++) {
        var tag;
        let concern = await getConcernCategory(content[i].concern_id);
        let status = await getStatusName('ticket_status', content[i].ticket_status_id);
        
        tag = (status.status_name == "RESOLVED") ? 'bg-success' : (status.status_name == "PENDING") ? 'bg-warning' : 'bg-danger';
        
        t.row.add($(`
            <tr>
                <th scope="row">${content[i].ticket_num}</th>
                <td>${concern.concern_category}</td>
                <td>${formatDateString(content[i].date_filed)}</td>
                <td>${(content.date_resolved == null) ? 'N/A' : formatDateString(content.date_resolved)}</td>
                <td>${content[i].ticket_num}</td>
                <td><span class="badge ${tag}">${status.status_name}</span></td>
                <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-ticket" data-bs-whatever="${content[i].ticket_num}"><i class="ri ri-eye-fill"></i></button></td>
                </tr>
        `)).draw(false);
    }

    setViewModal('view-ticket');
}

// Set View Modal
async function setViewModal (table) {
    var viewModal = document.getElementById(table)
    viewModal.addEventListener('show.bs.modal', async function (event) {
        var modalTitle = viewModal.querySelector('.modal-title');
        modalTitle.textContent = customer_name;
        var button = event.relatedTarget;
        var data_id = button.getAttribute('data-bs-whatever');
        let data, id, content;
        if (table == 'view-ticket') {
            data = await getTicketData(data_id);
            let status = await getStatusName('ticket_status', data.ticket_status_id);
            let category = await getConcernCategory(data.concern_id);
            let admin = await getAdminData(data.admin_id);
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
                status.status_name
            ];
        }

        setContent();

        function setTagElement(id, status) {
            document.getElementById(id).classList.add('text-white');
            document.getElementById(id).classList.remove('bg-danger');
            document.getElementById(id).classList.remove('bg-warning');
            document.getElementById(id).classList.remove('bg-success');

            (status == 1) ? document.getElementById(id).classList.add('bg-success') : (status == 2) ? document.getElementById(id).classList.add('bg-warning') : document.getElementById(id).classList.add('bg-danger');
        }

        function setContent () {
            for (var i = 0; i < content.length; i++) {
                $(id[i]).val(content[i]);
            }
        }
    });
}

async function generateTicketNum() {
    let url = DIR_API + 'ticket/read.php';
    try {
        let res = await fetch(url);
        response = await res.json();

        let unique = false;
        while(unique == false) {
            let checker = 0;
            let rand_num = "TN" + Math.round(Math.random() * 999999);
            for(let i = 0; i < response.length; i++) {
                if(rand_num == response[i]['ticket_num']) {
                    checker++;
                }
            }
            if (checker == 0) {
                unique = true;
                return rand_num;
            }
        }
    } catch (error) {
        console.log(error);
    }
}

function setCreateTicket () {
    const create_ticket = document.getElementById('create-ticket');

    // Set Default Values
    setDefaultFormValues();
    setAddDropdown();

    // Form Submits -- onclick Triggers
    create_ticket.onsubmit = (e) => {
        e.preventDefault();
        createTicket();
    };
}

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

function generateDateString() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); 
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

function setDefaultFormValues() {
    const getTicketNum = async () => {
        const result = await generateTicketNum();
        return result;
    }

    getTicketNum().then(result => {
        $("#ticket_num_create").attr("value", result);
    });

    const getDateToday = async () => {
        const result = generateDateString();
        return result;
    }

    getDateToday().then(result => {
        $("#date_filed_create").attr("value", result);
    });
}

async function setAddDropdown() {
    const concern = await displayConcerns();
    for (var i = 0; i < concern.length; i++) {
        var opt = `<option value='${concern[i].concern_id}'>${concern[i].concern_category}</option>`;
        $("#concern_id_create").append(opt);
    }
}

async function displayConcerns() {
    let url = DIR_API + 'concerns/read.php';
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function getCustomerData() {
    let url = DIR_API + 'views/customer_data.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();        
    } catch (error) {
        console.log(error);
    }
}



async function getTicketHistory() {
    let url = DIR_API + 'ticket/read_single_account.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();        
    } catch (error) {
        console.log(error);
    }
}

async function getTicketData(ticket_num) {
    let url = DIR_API + 'ticket/read_single.php?ticket_num=' + ticket_num;
    try {
        let res = await fetch(url);
        return await res.json();        
    } catch (error) {
        console.log(error);
    }
}

async function getConcernCategory(concern_id) {
    let url = DIR_API + 'concerns/read_single.php?concern_id=' + concern_id;
    try {
        let res = await fetch(url);
        return await res.json();        
    } catch (error) {
        console.log(error);
    }
}

async function getStatusName(status_table, status_id) {
    let url = DIR_API + 'statuses/read_single.php';
    const statusResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'status_table' : status_table,
            'status_id' : status_id
        })
    });

    return await statusResponse.json();
}