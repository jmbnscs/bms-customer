const DIR_API = 'http://localhost/gstech_api/api/';
const account_id = sessionStorage.getItem('account_id');

// On Boot Load
$(document).ready( () => {
    if (sessionStorage.getItem('pw') != null) { 
        let msg = "Please change your password.";
        let title = "Important!"
        setToastrArgs(msg, title);
    }

    setDefaults();
    setToastr();
});

// Get Data
async function getUserData() {
    let url = DIR_API + 'customer/read_single.php?account_id=' + account_id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

// Get User Level
async function getUserRating() {
    let url = DIR_API + 'ratings/read_single.php?account_id=' + account_id;
    let ratingsResponse;
    let content;

    try {
        ratingsResponse = await fetch (url);
    } catch (error) {
        console.log(error);
    }

    content = await ratingsResponse.json();

    url = DIR_API + 'statuses/read_single.php';

    const statusResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'status_table' : 'ratings_status',
            'status_id' : content.ratings_status_id
        })
    });

    content = await statusResponse.json();

    return content.status_name;
}

// Display Default Data
async function setDefaults () {
    const user_data = await getUserData();
    const user_rating = await getUserRating();

    const profile = document.getElementById('profile').children;
    const child = profile[0].children;

    child[0].innerHTML = user_data.first_name + ' ' + user_data.last_name;
    child[1].innerHTML = user_rating;

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
