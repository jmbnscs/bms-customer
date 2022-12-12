// On Boot Load
$(document).ready(function () {
    isDefault();
    setDefaultSetting();
});

// Global Variables
let customer_name;

async function setDefaultSetting() {
    const customer_data = await fetchData('views/customer_data.php?account_id=' + account_id);
    customer_name = customer_data.first_name + " " + customer_data.last_name;

    setInvoiceHistory();
    setPaymentHistory();
    setProrateHistory();
}

async function setInvoiceHistory() {
    let content = await fetchData('invoice/read_single_account.php?account_id=' + account_id);
    var t = $('#customer-invoice-tbl').DataTable({
        pageLength : 7,
        lengthMenu: [7, 10, 20],
    });

    for (var i = 0; i < content.length; i++) {
        var tag;
        let status = await getStatusName('invoice_status', content[i].invoice_status_id);
        (status == 'PAID') ? tag = 'bg-success' : tag = 'bg-danger';
        
        t.row.add($(`
            <tr>
                <th scope="row">${content[i].invoice_id}</th>
                <td>${formatDateString(content[i].disconnection_date)}</td>
                <td>&#8369; ${content[i].total_bill}</td>
                <td>&#8369; ${content[i].running_balance}</td>
                <td><span class="badge ${tag}">${status}</span></td>
                <td><button type="submit" class="btn btn-outline-primary" value="${content[i].invoice_id}" name="invoice_id_btn"><i class="ri ri-eye-fill"></i></button></td>
            </tr>
        `)).draw(false);
    }

}

async function setPaymentHistory() {
    let content = await fetchData('payment/read_single_account.php?account_id=' + account_id);
    var t = $('#customer-payment-tbl').DataTable({
        pageLength : 7,
        lengthMenu: [7, 10, 20],
    });

    for (var i = 0; i < content.length; i++) {
        var tag, payment_status;
        if (content[i].tagged == 1) {
            payment_status = 'Tagged';
            tag = 'bg-success';
        }
        else {
            tag = 'bg-danger';
        }
        t.row.add($(`
            <tr>
                <th scope="row">${content[i].payment_reference_id}</th>
                <td>&#8369; ${content[i].amount_paid}</td>
                <td>${formatDateString(content[i].payment_date)}</td>
                <td>${content[i].invoice_id}</td>
                <td><span class="badge ${tag}">${payment_status}</span></td>
                <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-payment" data-bs-whatever="${content[i].payment_id}"><i class="ri ri-eye-fill"></i></button></td>
            </tr>
        `)).draw(false);
    }

    setViewModal('view-payment')
}

async function setProrateHistory() {
    let content = await fetchData('prorate/read_acct.php?account_id=' + account_id);
    var t = $('#customer-prorate-tbl').DataTable({
        pageLength : 7,
        lengthMenu: [7, 10, 20],
    });

    for (var i = 0; i < content.length; i++) {
        var tag;
        let status = await getStatusName('prorate_status', content[i].prorate_status_id);
        if (status == "CHARGED") {
            tag = 'bg-success';
        }
        else {
            tag = 'bg-danger';
        }
        t.row.add($(`
            <tr>
                <th scope="row">${content[i].prorate_id}</th>
                <td>${content[i].duration}</td>
                <td>&#8369; ${content[i].prorate_charge}</td>
                <td>${content[i].ticket_num}</td>
                <td><span class="badge ${tag}">${status}</span></td>
                <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-prorate" data-bs-whatever="${content[i].prorate_id}"><i class="ri ri-eye-fill"></i></button></td>
                </tr>
        `)).draw(false);
    }

    setViewModal('view-prorate')
}

async function setViewModal (table) {
    var viewModal = document.getElementById(table)
    viewModal.addEventListener('show.bs.modal', async function (event) {
        var modalTitle = viewModal.querySelector('.modal-title');
        modalTitle.textContent = customer_name;
        var button = event.relatedTarget;
        var data_id = button.getAttribute('data-bs-whatever');
        let data, id, content;
        if (table == 'view-payment') {
            data = await getPaymentRecordData(data_id);
            (data.tagged == 1) ? setTagElement('tagged', 1) : setTagElement('tagged', 3);
            id = [
                '#payment_reference_id', 
                '#amount_paid', 
                '#payment_date', 
                '#invoice_id', 
                '#tagged'
            ];
            content = [
                data.payment_reference_id, 
                data.amount_paid, 
                formatDateString(data.payment_date), 
                data.invoice_id, 
                'Tagged'
            ];
        }
        else if (table == 'view-prorate') {
            data = await fetchData('prorate/read_single.php?prorate_id=' + data_id);
            let status = await getStatusName('prorate_status', data.prorate_status_id);
            (data.prorate_status_id == 2) ? setTagElement('prorate_status', 1) : setTagElement('prorate_status', 3);
            id = [
                '#prorate_id', 
                '#duration', 
                '#prorate_charge', 
                '#invoice_id_pr', 
                '#prorate_status'
            ];
            content = [
                data.prorate_id, 
                data.duration, 
                '\u20B1 ' + data.prorate_charge, 
                (data.invoice_id == null) ? 'N/A' : data.invoice_id, 
                status
            ];
        }

        for (var i = 0; i < content.length; i++) {
            $(id[i]).val(content[i]);
        }
    });
}