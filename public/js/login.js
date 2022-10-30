$(document).ready ( () => {
    // Create floating circles
    for (var i = 0; i < 8; i++) {
        const circle = document.createElement('li');
        document.getElementById('circles').appendChild(circle);
    }

    'use strict';

    initializeAttempts();

    // Detect browser for css purpose
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        $('.form form .label').addClass('fontSwitch');
    }

    // Label effect
    $('input').focus(function () {

        $(this).siblings('.label').addClass('active');
    });

    // Form validation
    $('input').blur(function () {

 
        // label effect
        if ($(this).val().length > 0) {
            $(this).siblings('.label').addClass('active');
        } else {
            $(this).siblings('.label').removeClass('active');
        }
    });


    // form switch
    $('a.switch').click(function (e) {
        $(this).toggleClass('active');
        e.preventDefault();

        if ($('a.switch').hasClass('active')) {
            $(this).parents('.form-piece').addClass('switched').siblings('.form-piece').removeClass('switched');
        } else {
            $(this).parents('.form-piece').removeClass('switched').siblings('.form-piece').addClass('switched');
        }
    });


    // Reload page
    $('a.profile').on('click', function () {
        location.reload(true);
    });
});

// ------------------- BACKEND JS
const DIR_API = 'http://localhost/gstech_api/api/';

async function login () {
    const login_username = $('#customer_username').val();
    const customer_password = $('#customer_password').val();

    let url = DIR_API + 'customer/login.php';

    const loginResponse = await fetch(url, {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            'login_username' : login_username,
            'customer_password' : customer_password
        })
    });

    const content = await loginResponse.json();
    
    if (content.message == 'success') {
        window.location.replace('../views/home.php');
    }
    else if (content.message == 'change password') {
        window.location.replace('../views/home.php?change=0');
    }
    else {
        setToastr("Warning", content.message, "error");
    }
}

$(function () {
    $('form').on('submit', function(e) {
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
    setTimeout(function() {
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