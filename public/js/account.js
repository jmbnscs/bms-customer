// On Boot Load
$(document).ready(function () {
    isDefault();
    setInvoiceHistory();
    setPaymentHistory();
    setProrateHistory();
});

async function setInvoiceHistory() {
    let content = await fetchData('invoice/read_single_account.php?account_id=' + account_id);
    var t = $('#customer-invoice-tbl').DataTable({
        pageLength : 5,
        lengthChange : false,
        "searching": true,
        "autoWidth": false
    });

    for (var i = 0; i < content.length; i++) {
        var tag;
        let status = await getStatusName('invoice_status', content[i].invoice_status_id);
        (status == 'PAID') ? tag = 'bg-success' : tag = 'bg-danger';
        
        t.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td data-label="Invoice ID">${content[i].invoice_id}</td>
                <td data-label="Disconnection Date">${formatDateString(content[i].disconnection_date)}</td>
                <td data-label="Total Bill">&#8369; ${content[i].total_bill}</td>
                <td data-label="Running Balance">&#8369; ${content[i].running_balance}</td>
                <td data-label="Status"><span class="badge ${tag}">${status}</span></td>
                <td data-label="View"><button type="submit" class="btn btn-outline-primary" value="${content[i].invoice_id}" name="invoice_id_btn"><i class="ri ri-eye-fill"></i></button></td>
            </tr>
        `)).draw(false);
    }

}

async function setPaymentHistory() {

    // -------------------------------- Tagged Payments
    const [content, account_data, approval_statuses, uploaded_payment_content] = await Promise.all ([fetchData('payment/read_single_account.php?account_id=' + account_id), fetchData('customer/read_single.php?account_id=' + account_id), fetchData('statuses/read.php?status_table=approval_status'), fetchData('payment/read_single_payment_approval.php?account_id=' + account_id)]);

    var tagged_table = $('#customer-payment-tbl').DataTable({
        pageLength : 5,
        lengthChange : false,
        "searching": true,
        "autoWidth": false
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
        tagged_table.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td data-label="Reference ID">${content[i].payment_reference_id}</td>
                <td data-label="Amount Paid">&#8369; ${content[i].amount_paid}</td>
                <td data-label="Payment Date">${formatDateString(content[i].payment_date)}</td>
                <td data-label="Invoice ID">${content[i].invoice_id}</td>
                <td data-label="Status"><span class="badge ${tag}">${payment_status}</span></td>
            </tr>
        `)).draw(false);
    }

    var uploadModal = document.getElementById('upload-payment-modal');
    uploadModal.addEventListener('show.bs.modal', async function (event) {
        $('#upload_account_id').val(account_id);

        // $('#upload-payment').on('submit', (e) => {
        //     // e.preventDefault();
        //     $('#upload-payment').attr('action', '../../app/includes/upload_payment.php');
            
        // })
    });

    // setViewModal('view-payment');
    // -------------------------------- End of Tagged Payments
    
    // -------------------------------- Uploaded Payments
    var uploaded_table = $('#uploaded-payment-tbl').DataTable({
        pageLength: 3,
        lengthChange : false,
        "searching": true,
        "autoWidth": false
    });
    
    for (var i = 0; i < approval_statuses.length; i++) {
        var opt = `<option value='${approval_statuses[i].status_name}'>${approval_statuses[i].status_name}</option>`;
        $("#uploaded-payment-status-filter").append(opt);
    }

    for (var i = 0; i < uploaded_payment_content.length; i++) {
        var tag;
        (uploaded_payment_content[i].status == 'Approved') ? tag = 'bg-success' : (uploaded_payment_content[i].status == 'Pending') ? tag = 'bg-warning' : tag = 'bg-danger';

        uploaded_table.row.add($(`
            <tr>
                <th scope="row" style="color: #012970;"><strong>${i+1}</strong></th>
                <td data-label="Account ID">${uploaded_payment_content[i].account_id}</td>
                <td data-label="Date Uploaded">${new Date(uploaded_payment_content[i].date_uploaded).toLocaleDateString('PHT')}</td>
                <td data-label="Status"><span class="badge ${tag}">${uploaded_payment_content[i].status}</span></td>
                <td data-label="Actions">
                    <button type="button" class="btn btn-outline-info m-1" data-bs-toggle="modal" data-bs-target="#view-uploaded-modal" data-bs-whatever="${uploaded_payment_content[i].approval_id}" ><i class="bi bi-eye"></i></button>
                </td>
            </tr>
        `)).draw(false);
    }

    $("#uploaded-payment-tbl_filter.dataTables_filter").append($("#uploaded-payment-status-filter"));

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'uploaded-payment-tbl'){
                return true;
            }

            var selectedItem = $('#uploaded-payment-status-filter').val()
            var category = data[3];
            if (selectedItem === "" || category.includes(selectedItem)) {
                return true;
            }
            return false;
        }
    );

    $("#uploaded-payment-status-filter").change(function (e) {
        uploaded_table.draw();
    });

    tagged_table.draw();
    uploaded_table.draw();

    var uploadedViewModal = document.getElementById('view-uploaded-modal')
    uploadedViewModal.addEventListener('show.bs.modal', async function (event) {

        var button = event.relatedTarget;
        var data_id = button.getAttribute('data-bs-whatever');
        let data, id, content;
        data = await fetchData('payment/read_single_pending.php?approval_id=' + data_id);

        var modalTitle = uploadedViewModal.querySelector('.modal-title');
        modalTitle.textContent = account_data.first_name + ' ' + account_data.last_name;

        document.querySelector("#view_uploaded_image").src = '../../app/includes/view_image.php?approval_id=' + data_id;
        document.querySelector("#view_uploaded_image_new_tab").href = '../../app/includes/view_image.php?approval_id=' + data_id;
    });
}

async function setProrateHistory() {
    let content = await fetchData('prorate/read_acct.php?account_id=' + account_id);
    var t = $('#customer-prorate-tbl').DataTable({
        pageLength : 5,
        lengthChange : false,
        "searching": true,
        "autoWidth": false
    });

    for (var i = 0; i < content.length; i++) {
        var tag;
        let status = await getStatusName('prorate_status', content[i].prorate_status_id);
        if (status == "Tagged") {
            tag = 'bg-success';
        }
        else {
            tag = 'bg-danger';
            content[i].invoice_id = 'N/A';
        }
        t.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td data-label="Invoice ID">${content[i].invoice_id}</td>
                <td data-label="Duration">${content[i].duration}</td>
                <td data-label="Prorate Discount">&#8369; ${content[i].prorate_charge}</td>
                <td data-label="Ticket #">${content[i].ticket_num}</td>
                <td data-label="Status"><span class="badge ${tag}">${status}</span></td>
                </tr>
        `)).draw(false);
    }

    // setViewModal('view-prorate')
}

// async function setViewModal (table) {
//     var viewModal = document.getElementById(table)
//     viewModal.addEventListener('show.bs.modal', async function (event) {
//         var modalTitle = viewModal.querySelector('.modal-title');
//         modalTitle.textContent = customer_name;
//         var button = event.relatedTarget;
//         var data_id = button.getAttribute('data-bs-whatever');
//         let data, id, content;
//         if (table == 'view-payment') {
//             data = await getPaymentRecordData(data_id);
//             (data.tagged == 1) ? setTagElement('tagged', 1) : setTagElement('tagged', 3);
//             id = [
//                 '#payment_reference_id', 
//                 '#amount_paid', 
//                 '#payment_date', 
//                 '#invoice_id', 
//                 '#tagged'
//             ];
//             content = [
//                 data.payment_reference_id, 
//                 data.amount_paid, 
//                 formatDateString(data.payment_date), 
//                 data.invoice_id, 
//                 'Tagged'
//             ];
//         }
//         else if (table == 'view-prorate') {
//             data = await fetchData('prorate/read_single.php?prorate_id=' + data_id);
//             let status = await getStatusName('prorate_status', data.prorate_status_id);
//             (data.prorate_status_id == 2) ? setTagElement('prorate_status', 1) : setTagElement('prorate_status', 3);
//             id = [
//                 '#prorate_id', 
//                 '#duration', 
//                 '#prorate_charge', 
//                 '#invoice_id_pr', 
//                 '#prorate_status'
//             ];
//             content = [
//                 data.prorate_id, 
//                 data.duration, 
//                 '\u20B1 ' + data.prorate_charge, 
//                 (data.invoice_id == null) ? 'N/A' : data.invoice_id, 
//                 status
//             ];
//         }

//         for (var i = 0; i < content.length; i++) {
//             $(id[i]).val(content[i]);
//         }
//     });
// }