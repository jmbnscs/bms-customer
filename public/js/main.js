const DIR_API = 'http://api.gstechbms.online/api/';
const account_id = localStorage.getItem('account_id');
const pw_check = localStorage.getItem('pw');

// On Boot Load
$(document).ready( () => {
    if (pw_check != null) { 
        let msg = "Please change your password.";
        let title = "Important!"
        setToastrArgs(msg, title);
    }

    setDefaults();
    setToastr();
});

// Check if Default Password
function isDefault () {
    if (pw_check == 0) { 
        window.location.replace('../views/settings.php');
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

async function getUserData() {
    let url = DIR_API + 'views/customer_data.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
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

// Display Default Data
async function setDefaults () {
    const user_data = await getUserData();

    $("#user-name").text(user_data.first_name + ' ' + user_data.last_name);
    $('#user-rating').text(user_data.rating_status);
    $('#user-fn').text(user_data.first_name);
    $('#user-icon').text((user_data.first_name).charAt(0) + (user_data.last_name).charAt(0));
}

// Navbar Active Config
$(() => {
    const path = location.pathname.split('/')[3];
    const id = 'nav-' + path.split('.')[0];

    $('#' + id).addClass('active');

    if (id == 'nav-profile' || id == 'nav-settings')  {
        $('#nav-profile').addClass('active');
    }
})

// Logout Session
function logout() {
    sessionStorage.clear();
    localStorage.clear();
    $.ajax({
        url: '../../app/includes/logout.inc.php',
        cache: false,
        success: function() {
            window.location.replace('../views/login.php');
        },
        error: function (xhr, status, error) {
            console.error(xhr)
        }
    });
}

// Toastr Configs
function setToastr() {
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
}

function setToastrArgs(msg, title) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "2000",
        "hideDuration": "0",
        "timeOut": "0",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
      
      toastr.error(msg, title);
    }
