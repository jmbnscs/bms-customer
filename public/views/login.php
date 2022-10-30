<?php include '../models/login_header.html'; ?>
<!-- Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- Local CSS -->
<link rel="stylesheet" href="../css/login.css">
</head>

<body class="area">
<!-- Floating Circles? --> 
<ul class="circles" id="circles">
</ul>
<!-- Floating Circles? End-->

<div class="container">
    <section id="formHolder">
        <div class="row">
            <!-- Brand Box -->
            <div class="col-sm-6 brand">
                <!-- <img src="../images/gst-logo.ico" alt="GSTech Logo" class="logo"> -->
                <div>
                    <img src="../images/gstech-logo-vector.png" class="heading">
                </div>
            </div>

            <!-- Form Box -->
            <div class="col-sm-6 form">

                <!-- Login Form -->
                <div class="login form-piece switched">
                    <form class="login-form">
                        <div class="label">
                            <h1>Customer Login</h1>
                        </div>

                        <div class="form-group">
                            <label class="label">Username / Account ID</label>
                            <input type="text" name="customer_username" id="customer_username" required>
                        </div>
                            
                        <div class="form-group">
                            <label class="label">Password</label>
                            <input
                                type="password"
                                name="customer_password"
                                id="customer_password"
                                required>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <label class="form-check-label">Remember me</label>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    id="invalidCheck2">
                            </div>
                        </div>

                        <div class="CTA">
                            <input type="submit" id="submit" value="Login" />
                        </div>

                    </form>

                </div>
                <!-- End Login Form -->

                <!-- Welcome Page -->
                <div class="welcome form-piece">
                    <form class="signup-form" action="#" method="post">
                        <div class="login-message">
                            <h1>Welcome back!</h1>
                        </div>
                        <div class="CTA">
                            <a href="#" class="switch">Click to Login</a>
                        </div>
                    </form>
                </div>
                <!-- End Welcome Page -->
            </div>
        </div>
    </section>
</div>



    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Local JS -->
    <script src="../js/login.js"></script>
</body>
</html>