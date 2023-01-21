const DIR_API = location.protocol + '//' + location.host + '/pilotapi/api/';
const DIR_APP = location.protocol + '//' + location.host + '/pilotcui/app/includes/';
const account_id = localStorage.getItem('account_id');
const pw_check = localStorage.getItem('pw');
const customer_data = getUserData();
let customer_name;

// On Boot Load
$(document).ready( () => {
    if (pw_check != null) { 
        let msg = "Please change your password.";
        let title = "Important!"
        toastr.error(msg, title);
    }

    customer_data.then(data => {
        $("#user-name").text(data.first_name + ' ' + data.last_name);
        $('#user-rating').text(data.rating_status);
        $('#user-fn').text(data.first_name);
        $('#user-icon').text((data.first_name).charAt(0) + (data.last_name).charAt(0));

        customer_name = `${data.first_name} ${data.last_name}`;
    })

});

// Navbar Active Config
$(() => {
    const path = location.pathname.split('/')[4];
    const id = 'nav-' + path;
    $('#' + id).addClass('active');
})

function displaySuccessMessage() {
    const msg = sessionStorage.getItem('save_message');
    if (msg !== null) {
        toastr.success(sessionStorage.getItem("save_message"));
        sessionStorage.removeItem("save_message");
    }
}

// Check if Default Password
function isDefault () {
    if (pw_check == 0) { 
        window.location.replace('../views/settings');
    }
}

async function getUserData() {
    let url = DIR_API + 'views/customer_data.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

// Get Data
async function fetchData(page) {
    let url = DIR_API + page;
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
        withcredentials : false,
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'status_table' : status_table,
            'status_id' : status_id
        })
    });

    let content = await statusResponse.json();

    return content.status_name;
}

async function getAccountData() {
    let url = DIR_API + 'customer/read_single.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function getPaymentRecordData(payment_id) {
    let url = DIR_API + 'payment/read_single.php?payment_id=' + payment_id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

function formatDateString(date) {
    var temp = new Date(date);
    var month = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"][temp.getMonth()];
    return month + ' ' + temp.getDate() + ', ' + temp.getFullYear();
}


function generateDateString() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); 
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

function setTagElement(id, status) {
    document.getElementById(id).classList.add('text-white');
    document.getElementById(id).classList.remove('bg-danger');
    document.getElementById(id).classList.remove('bg-warning');
    document.getElementById(id).classList.remove('bg-success');

    (status == 1) ? document.getElementById(id).classList.add('bg-success') : (status == 2) ? document.getElementById(id).classList.add('bg-warning') : document.getElementById(id).classList.add('bg-danger');
}

async function getAdminData(admin_id) {
    let url = DIR_API + 'admin/read_single.php?admin_id=' + admin_id;
    try {
        let res = await fetch(url);
        return await res.json();        
    } catch (error) {
        console.log(error);
    }
}

// Logout Session
function logout() {
    sessionStorage.clear();
    localStorage.clear();
    $.ajax({
        url: '../../app/includes/logout.inc.php',
        cache: false,
        success: function() {
            window.location.replace('../views/home');
        },
        error: function (xhr, status, error) {
            console.error(xhr)
        }
    });
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "rtl": false,
    "positionClass": "toast-bottom-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}