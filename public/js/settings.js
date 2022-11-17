// On Boot Load
$(document).ready( () => {
    setGeneralTab();
    setAccountTab();

    if (pw_check == 0) {
        document.getElementById('account-tab').click();
    }
});

async function setGeneralTab() {
    let customer_data = await getUserData();
    $('#first-name').val(customer_data.first_name);
    $('#middle-name').val(customer_data.middle_name);
    $('#last-name').val(customer_data.last_name);
    $('#birthdate').val(customer_data.birthdate);
    $('#billing-address').val(customer_data.billing_address);
    $('#gstech-id').val(customer_data.gstech_id);

    $('#billing-address').on('propertychange change click keyup', (e) => {
        if ($('#billing-address').val() !== customer_data.billing_address) {
            setUpConfirmPassword(false);
        }
    })
    
    $('#birthdate').on('propertychange change keyup', (e) => {
        if (new Date($('#birthdate').val()) !== new Date(customer_data.birthdate)) {
            setUpConfirmPassword(false);
        }
    })

    function setUpConfirmPassword(bool) {
        $('#confirm-password').attr('disabled', bool);
        $('#save-general-btn').attr('disabled', bool);
    }
}

async function setAccountTab() {
    let customer_data = await getAccountData();
    $('#account-id').val(customer_data.account_id);
    $('#customer-username').val(customer_data.customer_username);
}