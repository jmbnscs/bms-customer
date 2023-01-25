<?php include '../models/header.html'; ?>

<main id="main">

<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1 class="profile-welcome-text" data-aos="fade-up" id="welcome-text"></h1>
                <div class="profile-text" data-aos="fade-up" data-aos-delay="400">This is your profile page. You can check your GSTech account information.</div>
                <div data-aos="fade-up" data-aos-delay="600">
                <div class="text-center">
                    <a href="#profile-info" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>View profile</span>
                    <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

     <!-- ======= Profile Section ======= -->
<section id="profile-info" class="view-profile align-items-center">
  <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Profile</h2>
        <p>Check your Information</p>
      </header>

      <div class="row" data-aos="fade-left" class="profile-card-container">
      
        <!-- Customer Information -->
        <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="100">
          <div class="box">
            <h3 style="color: #07d5c0">Basic Information</h3>
            <div class="profile-details">GSTech ID: <span id="gstech_id"></span></div>
            <img src="../assets/img/pricing-free.png" class="img-fluid" alt=""/>
            
            <ul>
              <li>Full Name: <span id="full_name"></span></li>
              <li>Email: <span id="email"></span></li>
              <li>Mobile Number: <span id="mobile_number"></span></li>
              <li>Birthday: <span id="birthdate"></span></li>
              <li>Billing Address: <span id="billing_address"></span></li>
            </ul>
          
          </div>
        </div><!-- End Customer Information -->

        <!-- Account Information -->
        <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="200">
          <div class="box">
            <h3 style="color: #65c600">Account Information</h3>
            <div class="profile-details">Account ID: <span id="account_id"></span></div>
            <img src="../assets/img/account.png" class="img-fluid" alt="" />
          
            <ul>
              <li>Start Date: <span id="start_date"></span></li>
              <li>Lockin End Date: <span id="lockin_end_date"></span></li>
              <li>Billing Day: <span id="billing_day"></span></li>
              <li>Subscription Plan: <span id="plan_name"></span></li>
              <li>Connection Type: <span id="connection_type"></span></li>
              <li>Area: <span id="area_name"></span></li>
              <li>Bill Count: <span id="bill_count"></span></li>
            </ul>
            
          </div>
        </div><!-- End Account Information -->

        <!-- Installation Information -->
        <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <div class="box">
            <h3 style="color: #ff901c">Installation Information</h3>
            <div class="profile-details">Status:  <span id="install_status"></span></div>
            <img src="../assets/img/setting.png" class="img-fluid" alt=""/>
            
            <ul>
              <li>Installation Type: <span id="installation_type"></span></li>
              <li>Installment: <span id="installment"></span></li>
              <li>Total Charge: <span id="installation_total_charge"></span></li>
              <li>Balance: <span id="installation_balance"></span></li>
            </ul>
            
          </div>
        </div><!-- End Installation Information -->

        <!-- Ratings Information -->
        <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="400">
          <div class="box">
            <h3 style="color: #ff0071">Ratings Information</h3>
            <div class="profile-details">Payment Rating:  <span id="avg_rating"></span></div>
            <img src="../assets/img/rating.jpg" class="img-fluid" alt=""/>
            <ul>
              <li>Bill Count: <span id="rating_base"></span></li>
              <li>Overdue Payments: <span id="delinquent_ratings"></span></li>
              <li>Status: <span id="rating_status"></span></li>
        
            </ul>
            
          </div>
        </div><!-- End Ratings Information -->
    </div>
  </div>
</section>
      <!-- End view-Profile Section -->
</main>

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

<!-- Backend JS File -->
<script src="../js/main.js"></script>
<script src="../js/profile.js"></script>

</body>
</html>
