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
    let content = await fetchData('payment/read_single_account.php?account_id=' + account_id);
    var t = $('#customer-payment-tbl').DataTable({
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
        t.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td data-label="Reference ID">${content[i].payment_reference_id}</td>
                <td data-label="Amount Paid">&#8369; ${content[i].amount_paid}</td>
                <td data-label="Payment Date">${formatDateString(content[i].payment_date)}</td>
                <td data-label="Invoice ID">${content[i].invoice_id}</td>
                <td data-label="Status"><span class="badge ${tag}">${payment_status}</span></td>
                <td data-label="View"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-payment" data-bs-whatever="${content[i].payment_id}"><i class="ri ri-eye-fill"></i></button></td>
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

    setViewModal('view-payment');
    // -------------------------------- End of Tagged Payments

    
    // -------------------------------- Uploaded Payments

    // let invalid_approval_content = await fetchData('payment/read_invalid_approval.php');

    // var invalid_table = $('#invalid-payments-table').DataTable({
    //     pageLength: 5,
    //     lengthMenu: [5, 10, 20],
    //     "searching": true,
    //     "autoWidth": false
    // });

    // for (var i = 0; i < invalid_approval_content.length; i++) {
    //     invalid_table.row.add($(`
    //         <tr>
    //             <th scope="row" style="color: #012970;"><strong>${i+1}</strong></th>
    //             <td data-label="Account ID">${invalid_approval_content[i].account_id}</td>
    //             <td data-label="Date Uploaded">${new Date(invalid_approval_content[i].date_uploaded).toLocaleDateString('PHT')}</td>
    //             <td data-label="Status"><span class="badge bg-danger">${invalid_approval_content[i].status}</span></td>
    //             <td data-label="Actions">
    //                 <button type="button" class="btn btn-outline-info m-1" data-bs-toggle="modal" data-bs-target="#view-invalid-modal" data-bs-whatever="${invalid_approval_content[i].approval_id}" ><i class="bi bi-eye"></i></button>
    //             </td>
    //         </tr>
    //     `)).draw(false);
    // }

    // var invalidViewModal = document.getElementById('view-invalid-modal');
    // invalidViewModal.addEventListener('show.bs.modal', async function (event) {

    //     var button = event.relatedTarget;
    //     var data_id = button.getAttribute('data-bs-whatever');
    //     let data, id, content;
    //     data = await fetchData('payment/read_single_invalid.php?approval_id=' + data_id);

    //     const account_data = await fetchData('customer/read_single.php?account_id=' + data.account_id);
    //     var modalTitle = invalidViewModal.querySelector('.modal-title');
    //     modalTitle.textContent = account_data.first_name + ' ' + account_data.last_name;

    //     document.querySelector("#view_uploaded_image").src = '../../app/includes/view_image.php?approval_id=' + data_id;
    //     document.querySelector("#view_uploaded_image_new_tab").href = '../../app/includes/view_image.php?approval_id=' + data_id;

    //     const react_fn = document.getElementById('react-invalid-data');
    //     react_fn.onsubmit = (e) => {
    //         e.preventDefault();
    //         processReactivate();
    //     };

    //     async function processReactivate() {
    //         const react_data = JSON.stringify({
    //             'approval_id' : data_id
    //         });
    //         const response = await deleteData('payment/react_invalid_payment.php', react_data);

    //         const log = await logActivity('Reactivated Payment Record #' + data_id + ' [' + data.account_id + ']', 'Invalid Payment');
            
    //         if (response.success && log) {
    //             sessionStorage.setItem('save_message', "Payment Record Reactivated Successfully.");
    //             window.location.reload();
    //         }
    //         else {
    //             toastr.error("Transaction not processed.");
    //         }
    //     }
    // });

    // // -------------------------------- End Invalid Approval Payments

    // // Uploaded Payment Modal
    // var pendingDeleteModal = document.getElementById('view-uploaded-modal');
    // pendingDeleteModal.addEventListener('show.bs.modal', async function (event) {

    //     $('#view_pending_account_id').val(data.account_id);

    //     document.querySelector("#view_uploaded_image").src = '../../app/includes/view_image.php?approval_id=' + data_id;
    //     document.querySelector("#view_uploaded_image_new_tab").href = '../../app/includes/view_image.php?approval_id=' + data_id;

    //     const delete_fn = document.getElementById('pending-delete-data');
    //     delete_fn.onsubmit = (e) => {
    //         e.preventDefault();
    //         processDelete();
    //     };

    //     async function processDelete() {
    //         const delete_data = JSON.stringify({
    //             'approval_id' : data_id
    //         });
    //         const response = await deleteData('payment/invalid_pending_payment.php', delete_data);

    //         const log = await logActivity('Invalidated Payment Record #' + data_id + ' [' + data.account_id + ']', 'Invalid Pending Payment');
            
    //         if (response.success && log) {
    //             sessionStorage.setItem('save_message', "Payment Record Invalidated Successfully.");
    //             window.location.reload();
    //         }
    //         else {
    //             toastr.error("Transaction not processed.");
    //         }
    //     }
        
    // });
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
        }
        t.row.add($(`
            <tr>
                <th scope="row">${i+1}</th>
                <td data-label="Prorate ID">${content[i].prorate_id}</td>
                <td data-label="Duration">${content[i].duration}</td>
                <td data-label="Prorate Discount">&#8369; ${content[i].prorate_charge}</td>
                <td data-label="Ticket #">${content[i].ticket_num}</td>
                <td data-label="Status"><span class="badge ${tag}">${status}</span></td>
                <td data-label="View"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#view-prorate" data-bs-whatever="${content[i].prorate_id}"><i class="ri ri-eye-fill"></i></button></td>
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