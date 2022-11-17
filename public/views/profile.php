<?php 
  include '../models/header.html';
//  include '../models/navbar.html'; ?>

<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up" id="welcome-text"></h1>
                <h2 data-aos="fade-up" data-aos-delay="400">This is your profile page. You can see the Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                <div class="text-center text-lg-start">
                    <a href="#edit-profile" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>View profile</span>
                    <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= Edit Profile ======= -->
    <section id="edit-profile" class="edit-profile">
      <div class="container" data-aos="fade-up">
        <div class="row pt-2">
            <!-- Customer Information -->
            <div class="col-sm-6">
                <div class="card ">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Basic Information</h5>
                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">GSTech ID</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="gstech_id"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">First Name</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="first_name"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Middle Name</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="middle_name"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Last Name</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="last_name"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Email</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="email"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Mobile Number</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="mobile_number"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Birthday</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="birthdate"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Billing Address</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="billing_address"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Customer Information -->

              <!-- Account Information -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Account Information</h5>
                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom ">Account ID</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="account_id"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Start Date</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="start_date"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Lockin End Date</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="lockin_end_date"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Billing Day</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="billing_day"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Subscription Plan</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="plan_name"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Connection Type</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="connection_type"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Area</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="area_name"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Bill Count</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="bill_count"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Account Information -->

              <!-- Installation Information -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Installation Information</h5>
                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom ">Installation Type</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="installation_type"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Installment</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="installment"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Total Charge</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="installation_total_charge"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Balance</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="installation_balance"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Status</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="install_status"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Installation Information -->

              <!-- Ratings Information -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Ratings Information</h5>
                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom ">Payment Rating</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="avg_rating"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Bill Count</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="rating_base"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Overdue Payments</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="delinquent_ratings"></div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4 col-md-4 label border-bottom">Status</div>
                          <div class="col-lg-7 col-md-8 border-bottom" id="rating_status"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Ratings Information -->
        </div>

      </div>
    </section><!-- End Profile Section -->
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
