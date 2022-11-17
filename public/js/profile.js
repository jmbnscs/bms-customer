$(document).ready( () => {
    setSettingsPage();
});

async function setSettingsPage() {
    let content = await getUserData();

    $('#welcome-text').text('Hi, ' + content.first_name + '!');
    $('#full-name').text(content.first_name + ' ' + content.last_name);

    setCustomerData(content);
}

async function setCustomerData(customer_data) {
    // Customer Information
    $('#first_name').text(customer_data.first_name);
    $('#middle_name').text(customer_data.middle_name);
    $('#last_name').text(customer_data.last_name);
    $('#email').text(customer_data.email);
    $('#mobile_number').text(customer_data.mobile_number);
    $('#birthdate').text(formatDateString(customer_data.birthdate));
    $('#billing_address').text(customer_data.billing_address);
    $('#gstech_id').text(customer_data.gstech_id);

    // Account Information
    $('#account_id').text(customer_data.account_id);
    $('#start_date').text(formatDateString(customer_data.start_date));
    $('#lockin_end_date').text(formatDateString(customer_data.lockin_end_date));
    $('#billing_day').text(customer_data.billing_day);
    $('#plan_name').text(customer_data.plan_name);
    $('#connection_type').text(customer_data.connection_type);
    $('#area_name').text(customer_data.area_name);
    $('#bill_count').text(customer_data.bill_count);

    // Installation Information
    $('#installation_type').text(customer_data.installation_type);
    $('#installment').text(customer_data.installment);
    $('#installation_total_charge').text(customer_data.installation_total_charge);
    $('#installation_balance').text(customer_data.installation_balance);
    $('#install_status').text(customer_data.install_status);

    // Ratings Information
    $('#avg_rating').text(parseInt(100 - customer_data.avg_rating) + ' %');
    $('#rating_base').text(customer_data.rating_base);
    $('#delinquent_ratings').text(customer_data.delinquent_ratings);
    $('#rating_status').text(customer_data.rating_status);
}

