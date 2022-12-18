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

const DIR_API = 'https://api.gstechbms.online/api/';
const DIR_APP_LOAD = 'https://cui.gstechbms.online/app/includes/';

$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();

        fetch (DIR_API + 'customer/verify_email.php', {
            method : 'POST',
            cache : 'no-cache',
            headers : {
                'Content-Type' : 'application/json'
            },
            body : JSON.stringify({
                'account_id' : $('#account_id').val(), 
                'email' : $('#email').val()
            })
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                $.ajax({
                    type : 'POST',
                    url : DIR_APP_LOAD + 'send_verification.php',
                    data: $( this ).serialize(),
                    success : function (data) {
                        if (data == 'success') {
                            // toastr.success('Email verification sent.');
                            setTimeout (
                                toastr.success('Email verification sent.'), 5000
                            );
                            window.location.replace('login.php');
                        }
                        else {
                            toastr.error('Some error has occured, please try again later.');
                        }
                    }
                });
            }
            else {
                toastr.error(data.message);
            }
        });
    });
});
