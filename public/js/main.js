const DIR_API = 'http://localhost/gstech_api/api/';
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

// Display Default Data
async function setDefaults () {
    const user_data = await getUserData();

    const profile = document.getElementById('profile').children;
    const child = profile[0].children;

    child[0].innerHTML = user_data.first_name + ' ' + user_data.last_name;
    child[1].innerHTML = user_data.rating_status;

    const display = document.getElementById('displayName').children;
    const display_name = display[0].children;
    display_name[1].innerHTML = user_data.first_name;
}

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
