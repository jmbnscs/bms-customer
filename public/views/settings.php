<?php 
  include '../models/header.html';
//  include '../models/navbar.html'; ?>

<section class="customer-page content-bg align-items-center">
  <div class="container adjust-top" data-aos="fade-up">
        <div class="row justify-content-center">
          <!-- Account Settings -->
          <div class="card col-md-8">
            <div class="card-body pt-4">

              <!-- Account Settings Tab -->
              <div class="d-flex align-items-start ">
                <div class="nav nav-tabs nav-tabs-bordered d-flex">
                  <li class="nav-item flex-fill">
                    <button class="nav-link active w-100" id="general-tab" data-bs-toggle="tab" data-bs-target="#settings-general" type="button" role="tab" aria-controls="settings-general" aria-selected="true">General</button>
                  </li>
                  <li class="nav-item flex-fill">
                    <button class="nav-link w-100" id="account-tab" data-bs-toggle="tab" data-bs-target="#settings-account" type="button" role="tab" aria-controls="settings-account" aria-selected="false">Account</button>
                  </li>
                </div>

                
              </div>
            </div>
             <!-- Settings Tab Content -->
          <div class="tab-content p-3">
                  <!-- General Settings Tab Content -->
                  <div class="tab-pane fade show active" id="settings-general" role="tabpanel" aria-labelledby="general-tab">
                    <!-- General Edit Form -->
                    <form class="form-setting" id="edit-general">

                      <div class="row mb-3">
                        <label for="gstech-id" class="col-lg-3 col-form-label">GSTech ID</label>
                        <div class="col-lg-9">
                          <input name="gstech-id" type="text" class="form-control" id="gstech-id" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="first-name" class="col-lg-3 col-form-label">First Name</label>
                        <div class="col-lg-9">
                          <input name="first-name" type="text" class="form-control" id="first-name" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="middle-name" class="col-lg-3 col-form-label">Middle Name</label>
                        <div class="col-lg-9">
                          <input name="middle-name" type="text" class="form-control" id="middle-name" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="last-name" class="col-lg-3 col-form-label">Last Name</label>
                        <div class="col-lg-9">
                          <input name="last-name" type="text" class="form-control" id="last-name" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="birthdate" class="col-lg-3 col-form-label">Birthdate</label>
                        <div class="col-lg-9">
                          <input name="birthdate" type="date" class="form-control" id="birthdate" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="billing-address" class="col-lg-3 col-form-label">Billing Address</label>
                        <div class="col-lg-9">
                          <input name="billing-address" type="text" class="form-control" id="billing-address" value="" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="email" class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                          <input name="email" type="email" class="form-control" id="email" value="" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="mobile-number" class="col-lg-3 col-form-label">Mobile Number</label>
                        <div class="col-lg-9">
                          <input name="mobile-number" type="text" class="form-control" id="mobile-number" pattern="[0]{1}[9]{1}[0-9]{9}" maxlength="11" size="11" value="" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="confirm-password" class="col-lg-3 col-form-label">Confirm Password</label>
                        <div class="col-lg-9">
                          <input name="confirm-password" type="password" class="form-control" id="confirm-password" value="" autocomplete="on" required disabled>
                        </div>
                      </div>

                      <div class="row justify-content-center">
                        <div class="text-center col-lg-12">
                          <button type="submit" class="btn btn-primary" id="save-general-btn" disabled>Save Changes</button>
                        </div>
                      </div>
                      
                    </form><!-- End General Edit Form -->
                  </div>

                  <!-- Account Settings Tab Content -->
                  <div class="tab-pane fade pt-6" id="settings-account" role="tabpanel" aria-labelledby="account-tab">
                    <!-- Account Edit Form -->
                    <form class="form-setting" id="edit-account">

                      <div class="row mb-3">
                        <label for="account-id" class="col-lg-3 col-form-label">Account ID</label>
                        <div class="col-lg-9">
                          <input name="account-id" type="text" class="form-control" id="account-id" value="" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="customer-username" class="col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9">
                          <input name="customer-username" type="text" class="form-control" id="customer-username" value="" autocomplete="on" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="current-password" class="col-lg-3 col-form-label">Current Password</label>
                        <div class="col-lg-9">
                          <input name="current-password" type="password" class="form-control" id="current-password" value="" autocomplete="on" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="new-password" class="col-lg-3 col-form-label">New Password</label>
                        <div class="col-lg-9">
                          <input name="new-password" type="password" class="form-control" id="new-password" value="" autocomplete="on" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="re-new-password" class="col-lg-3 col-form-label">Repeat New Password</label>
                        <div class="col-lg-9">
                          <input name="re-new-password" type="password" class="form-control" id="re-new-password" value="" autocomplete="on" required>
                        </div>
                      </div>

                      <div class="row justify-content-center">
                        <div class="text-center col-lg-12 pt-2">
                          <button type="submit" class="btn btn-primary" id="update-username-btn">Change Password</button>
                        </div>
                      </div>
                       
                    </form><!-- End Account Edit Form -->
                  </div>
                </div>
        </div>
          </div><!-- End Account Settings -->

         
  </div>

</section><!-- End Hero -->


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
<script src="../js/settings.js"></script>

</body>
</html>
