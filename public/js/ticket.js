// On Boot Load
$(document).ready(function () {
    // isDefault();

    // if (sessionStorage.getItem('error_message') == "You don't have access to this page.") {
    //     setToastrArgs(sessionStorage.getItem('error_message'), "Error");
    //     sessionStorage.setItem('error_message', null);
    // }
    setDefaultSetting();
});

// Global Variables
let customer_name;

async function setDefaultSetting() {
    const customer_data = await getCustomerData(account_id);
    customer_name = customer_data.first_name + " " + customer_data.last_name;
    // $('#customer-name').text(customer_name);

    setTicketHistory();
}

async function setTicketHistory() {
    let content = await getTicketHistory(account_id);
    var t = $('#customer-ticket-tbl').DataTable();

    for (var i = 0; i < content.length; i++) {
        var tag;
        let concern = await getConcernCategory(content[i].concern_id);
        let status = await getStatusName('ticket_status', content[i].ticket_status_id);
        if (status.status_name == "RESOLVED") {
            tag = 'bg-success';
        }
        else {
            tag = 'bg-danger';
        }
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

    setViewModal('view-ticket')
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
            (data.ticket_status_id == 3) ? setTagElement('ticket_status', 1) : setTagElement('ticket_status', 2);
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
                (data.resolution_details == null) ? 'N/A' : data.resolution_details, 
                (data.date_resolved == null) ? 'N/A' : formatDateString(data.date_resolved), 
                (data.admin_id == null) ? 'N/A' : admin.first_name + ' ' + admin.last_name, 
                status.status_name
            ];
        }

        setContent();

        function setTagElement(id, status) {
            document.getElementById(id).classList.add('text-white');
            document.getElementById(id).classList.remove('bg-danger');
            document.getElementById(id).classList.remove('bg-success');

            (status == 1) ? document.getElementById(id).classList.add('bg-success') : document.getElementById(id).classList.add('bg-danger');
        }

        function setContent () {
            for (var i = 0; i < content.length; i++) {
                $(id[i]).val(content[i]);
            }
        }
    });
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