// $(document).ready(function () {
//     isDefault();
// });
const DIR_APP_HOME = location.protocol + '//' + location.host + '/pilotcui/app/includes/';

$('form').on('submit', function (e) {
    e.preventDefault();
    $('#submit-inquiry-btn').prop('disabled', true);
    $('#submit-inquiry-btn').append('&emsp;<i class="fa fa-circle-o-notch fa-spin"></i>');

    $.ajax({
        type : 'POST',
        url : DIR_APP_HOME + 'send_inquiry.php',
        data: $( this ).serialize(),
        success : function (data) {
            if (data == 'success') {
                setTimeout ( () => {
                        $('#inquire-data').trigger("reset");
                        $('#submit-inquiry-btn').prop('disabled', false);
                        $('#submit-inquiry-btn').text('Submit');
                        toastr.success('Your inquiry has been sent!', 'Success');
                    },2000
                );
            }
            else {
                setTimeout ( () => {
                        $('#submit-inquiry-btn').prop('disabled', false);
                        $('#submit-inquiry-btn').text('Submit');
                        toastr.error('Some error has occured, please try again later.', 'Oops!');
                        // toastr.error(data);
                    },2000
                );
            }
        }
    });
});

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