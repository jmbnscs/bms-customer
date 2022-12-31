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

<!-- Login start -->
<body>
	 <img class="wave" src="../images/bg8.jpg">
	 <div class="container">
		 <div class="img">
			 <img src="../images/gstech-logo-vector.png">
		 </div>
		 <div class="login-content">
			 <form>
				 <img src="../images/profile2.png">
				 <h2 class="title">Welcome</h2>
				 <div class="input-div one">
					 <div class="i">
						 <i class="fas fa-user"></i>
					 </div>
					 <div class="div">
						 <h5>Username / Account ID</h5>
						 <input type="text" class="form-control" name="customer_username" id="customer_username" autocomplete="on" required>
					 </div>
				 </div>
				 <div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" class="form-control" name="customer_password" id="customer_password" autocomplete="on" required>
					</div>
				</div>
				<a href="forgot.php" target="_blank">Forgot Password?</a>
				<input type="submit" class="btn" id ="submit" value="Login">
			 </form>
		 </div>
	 </div>

     <!-- End of Login -->




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

    <!--add-ons by KL -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script> 

    <!-- Local JS -->
    <script src="../js/login.js"></script>
</body>
</html>