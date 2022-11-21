const edit_general = document.getElementById('edit-general');
const edit_account = document.getElementById('edit-account');

// On Boot Load
$(document).ready( () => {
    displayDataOnTabs();

    if (pw_check == 0) {
        document.getElementById('account-tab').click();
    }

    if (localStorage.getItem("save_message") == "Customer Updated Successfully.") {
        toastr.success(localStorage.getItem("save_message"));
        localStorage.removeItem("save_message");
    }
});

async function displayDataOnTabs() {
    let customer_data = await getUserData();
    $('#first-name').val(customer_data.first_name);
    $('#middle-name').val(customer_data.middle_name);
    $('#last-name').val(customer_data.last_name);
    $('#birthdate').val(customer_data.birthdate);
    $('#billing-address').val(customer_data.billing_address);
    $('#email').val(customer_data.email);
    $('#mobile-number').val(customer_data.mobile_number);
    $('#gstech-id').val(customer_data.gstech_id);

    let account_data = await getAccountData();
    $('#account-id').val(account_data.account_id);
    $('#customer-username').val(account_data.customer_username);

    // General Tab Edit Functionality
    $('#billing-address').on('propertychange change click keyup', (e) => {
        if ($('#billing-address').val() !== customer_data.billing_address) {
            setUpConfirmPassword(false);
        }
    })
    
    $('#email').on('propertychange change keyup', (e) => {
        if (new Date($('#email').val()) !== new Date(customer_data.email)) {
            setUpConfirmPassword(false);
        }
    })

    $('#mobile-number').on('propertychange change keyup', (e) => {
        if (new Date($('#mobile-number').val()) !== new Date(customer_data.mobile_number)) {
            setUpConfirmPassword(false);
        }
    })

    function setUpConfirmPassword(bool) {
        $('#confirm-password').attr('disabled', bool);
        $('#save-general-btn').attr('disabled', bool);
    }
}

async function updateGeneralTab() {
    // Fetch Data
    const billing_address = $('#billing-address').val();
    const email = $('#email').val();
    const mobile_number = $('#mobile-number').val();
    const confirm_password = $('#confirm-password').val();

    var content;

    // Verify Password
    url = DIR_API + 'customer/verify_password.php';
    const verifyResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'account_id' : account_id,
            'customer_password' : confirm_password
        })
    });

    const verify = await verifyResponse.json();

    if (verify.message == 'success') {
        let url = DIR_API + 'customer/update.php';
        const updateCustomerResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'account_id' : account_id,
            'billing_address' : billing_address,
            'mobile_number' : mobile_number,
            'email' : email
        })
        });

        content = await updateCustomerResponse.json();
    }
    else {
        toastr.error('Current Password do not match.');
    }

    if(content) {
        if (content.message = 'Customer Updated') {
            localStorage.setItem('save_message', "Customer Updated Successfully.");
            location.reload();
        }
    }
}

async function updateAccountTab() {
    const currentPassword = $('#current-password').val();
    const newPassword = $('#new-password').val();
    const renewPassword = $('#re-new-password').val();

    // Verify Password
    let url = DIR_API + 'customer/verify_password.php';
    const verifyResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'account_id' : account_id,
            'customer_password' : currentPassword
        })
    });

    const verify = await verifyResponse.json();

    if (verify.message == 'success') {
        if (newPassword == renewPassword) {
                url = DIR_API + 'customer/update_password.php';
                const changeResponse = await fetch(url, {
                method : 'POST',
                headers : {
                    'Content-Type' : 'application/json'
                },
                body : JSON.stringify({
                    'account_id' : account_id,
                    'customer_password' : newPassword
                })
            });

            const content = await changeResponse.json();
            
            if (content.message = 'Password Updated') {
                sessionStorage.setItem('customer_password', newPassword);
                sessionStorage.setItem('pw', 1);
                toastr.success(content.message);
                // location.reload();
                setTimeout(function(){
                    logout();
                    // window.location.reload();
                 }, 2000);
            }
        }
        else {
            toastr.error('New Password do not match.');
        }
    }
    else {
        toastr.error('Current Password do not match.');
    }
}

edit_general.onsubmit = (e) => {
    e.preventDefault();
    updateGeneralTab();
};

edit_account.onsubmit = (e) => {
    e.preventDefault();
    updateAccountTab();
}