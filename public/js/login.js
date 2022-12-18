const inputs = document.querySelectorAll(".form-control");

function AddClass() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function RemoveClass() {
    let parent = this.parentNode.parentNode;
    if (this.value == '') {
        parent.classList.remove("focus");
    }
}

inputs.forEach(input => {
    input.addEventListener("focus", AddClass);
    input.addEventListener("blur", RemoveClass);
});

// ------------------- BACKEND JS
const DIR_API = '/gstech_api/api/';

async function login() {
    const login_username = $('#customer_username').val();
    const customer_password = $('#customer_password').val();

    let url = DIR_API + 'customer/login.php';

    const loginResponse = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'login_username': login_username,
            'customer_password': customer_password
        })
    });

    const content = await loginResponse.json();

    if (content.message == 'success') {
        localStorage.setItem('account_id', content.account_id);
        window.location.replace('../views/home.php');
    }
    else if (content.message == 'change password') {
        localStorage.setItem('pw', 0);
        localStorage.setItem('account_id', content.account_id);
        window.location.replace('../views/settings.php');
    }
    else {
        setToastr("Warning", content.message, "error");
    }
}

$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();

        // if (localStorage.getItem('customer_username') == null) {
        //     localStorage.setItem('customer_username', customer_username);
        // }
        // else if (localStorage.getItem('customer_username') != customer_username) {
        //     localStorage.setItem('attempts', 3);
        //     localStorage.setItem('customer_username', customer_username);
        // }
        login();

    });
});

function disableLoginButton() {
    $('#submit').prop('disabled', true);
    $('#submit').css('background-color', '#808080');
    setTimeout(function () {
        $('#submit').prop('disabled', false);
        $('#submit').css('background-color', '#4397d0');
    }, 5000);
}

function initializeAttempts() {
    if (localStorage.getItem('admin_username') == null) {
        localStorage.setItem('attempts', 3);
    }
    if (localStorage.getItem('attempts') == null) {
        localStorage.setItem('attempts', 3);
    }
}

function setToastr(title, message, type) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    if (type == "error") {
        toastr.error(message, title);
    }
    else {
        toastr.warning(message, title);
    }
}