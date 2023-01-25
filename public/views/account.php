<?php include '../models/header.html'; include '../../app/includes/upload_payment.php'?>

<!-- Customer Account Section -->
<main id="main" class=" Account"> <!-- NOTE: overflow-scroll class for the datatables -->
  <section>
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="adjust-top col-xl-12">

        <!-- Navigation Tabs -->
        <div class="card">
          <div class="card-body pt-3 pb-0">
            <!-- Bordered Tabs-->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex">
              <li class="nav-item flex-fill">
                <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#customer-invoice" id="customer-invoice-tab">
                  <h4>Billing Statements</h4>
                </button>
              </li>
              
              <li class="nav-item flex-fill">
                <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#customer-payment" id="customer-payment-tab">
                  <h4>Payment</h4>
                </button>
              </li>

              <li class="nav-item flex-fill">
                <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#customer-prorate" id="customer-prorate-tab">
                  <h4>Prorate</h4>
                </button>
              </li>

            </ul><!--End of Bordered Tabs-->
          </div>
        </div>

        <!-- Customer Invoice History-->
        <form action="../../app/includes/view_invoice.php" method="post" target="_blank">
        <div class="tab-content">
          <div class="tab-pane fade show active customer-invoice" id="customer-invoice">
            <div class="row">
              <div class="col-sm-12">
                <div class="card overflow-auto">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Billing History</h5>
                      <table class="table table-borderless" id="customer-invoice-tbl">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Billing ID</th>
                            <th scope="col">Disconnection Date</th>
                            <th scope="col">Total Bill</th>
                            <th scope="col">Running Balance</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form><!--End Customer Invoice History-->

        <!--Customer Payment History-->
        <div class="tab-content">
          <div class="tab-pane fade customer-payment" id="customer-payment">
            <div class="row">
              <div class="col-sm-12">
                <div class="card p-3">
                  <div class="card-body p-2">

                    <ul class="nav nav-tabs d-flex" role="tablist">
                      <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="tagged-tab" data-bs-toggle="tab" data-bs-target="#tagged-payments" type="button" role="tab" aria-controls="tagged" aria-selected="true">Tagged</button>
                      </li>
                      <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="uploaded-tab" data-bs-toggle="tab" data-bs-target="#uploaded-payments" type="button" role="tab" aria-controls="uploaded" aria-selected="false">Uploaded Payments</button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <!-- Tagged Tab -->
                      <div class="tab-pane fade show active" id="tagged-payments" role="tabpanel" aria-labelledby="tagged-tab">
                        <div class="row pt-3 p-3">
                          <div class="col-sm-6"><h5 class="card-title">Payment History</h5></div>
                          <div class="col-sm-3 text-center pt-2">
                            <a href="#"><button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#upload-payment-modal">Upload Payment</button></a>
                          </div>
                          <div class="col-sm-3 text-center pt-2">
                            <a href="#"><button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#view-qr-modal">View GCash QR</button></a>
                          </div>
                        </div>
                        <table class="table table-borderless" id="customer-payment-tbl">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Reference ID</th>
                              <th scope="col">Amount Paid</th>
                              <th scope="col">Payment Date</th>
                              <th scope="col">Invoice ID</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <!-- End Tagged Tab -->

                      <!-- Uploaded Payment Records -->
                      <div class="tab-pane fade" id="uploaded-payments" role="tabpanel" aria-labelledby="uploaded-tab">
                        <div class="row">
                          <div class="col-md-9">
                            <h5 class="card-title">Uploaded Payment Records</h5>
                          </div>
                        </div>

                        <div>
                          <select id="uploaded-payment-status-filter" class="form-select table-filter" style="display: inline; width: 160px; margin-left: 20px;">
                            <option value="">Show All: Status</option>
                          </select>
                        </div>

                        <table class="table table-borderless" id="uploaded-payment-tbl">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Account ID</th>
                              <th scope="col">Date Uploaded</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                      <!-- End Uploaded Payment Records -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Customer Payment History -->
        
        <!--Customer Prorate History-->
        <div class="tab-content">
          <div class="tab-pane fade customer-prorate" id="customer-prorate">
            <div class="row">
              <div class="col-sm-12">
                <div class="card overflow-auto">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Prorates History <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Prorates are your discounts given by GSTech for unexpected network interruptions."></i></h5>
                      <table class="table table-borderless" id="customer-prorate-tbl">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice ID</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Prorate Discount</th>
                            <th scope="col">Ticket #</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Customer Prorate History -->

        </div>
      </div>

      <!-- Upload Payment Modal -->
      <form action="" method="post" enctype="multipart/form-data" id="upload-payment">
        <div class="modal fade" id="upload-payment-modal" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-m">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title">Upload Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                <div class="row mb-3">
                  <label for="upload_account_id" class="col-sm-4 col-form-label">Account ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="upload_account_id" name="upload_account_id" value="" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="payment_file" class="col-sm-4 col-form-label">Attach Payment</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" id="payment_file" name="payment_file" accept="image/png, image/jpeg" value="" required>
                  </div>
                </div>

              </div>
              <!-- End Modal Body -->

              <!-- Modal Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-success" id="edit-btn">Save Changes</button> -->
                <input type="submit" name="upload_submit" id="upload_submit" class="btn btn-success" value="Upload">
              </div>

            </div>
          </div>
        </div>
      </form>
      
      <!-- View Uploaded Payment Modal -->
      <form id="view-uploaded-data">
        <div class="modal fade" id="view-uploaded-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <!-- Card with an image on top -->
                  <div class="card">
                    <a href="" target="_blank" id="view_uploaded_image_new_tab">
                      <img id="view_uploaded_image" class="img-fluid rounded-start mx-auto d-block" alt="..." data-action="zoom">
                    </a>
                  </div><!-- End Card with an image on top -->

                </div>
                <!-- End Modal Body -->

                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
      </form>
      <!-- End Uploaded Payment Modal -->

      <!-- View GCash QR Modal -->
      <div class="modal fade" id="view-qr-modal" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title">Pay your bill through GCash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                <!-- Card with an image on top -->
                <div class="card">
                  <img src="../images/gstech-qr.jpg" alt="GSTech QR Code" class="img-fluid rounded-start mx-auto d-block" data-action="zoom">
                  <!-- <a href="" target="_blank" id="view_uploaded_image_new_tab" >
                    <img id="view_uploaded_image" class="img-fluid rounded-start mx-auto d-block" alt="..." data-action="zoom">
                  </a> -->
                </div><!-- End Card with an image on top -->
                <ol>
                  <li>Scan QR Code on your GCash App.</li>
                  <li>Enter amount to be paid.</li>
                  <li>Input your Account ID on the message box.</li>
                  <li>Click Next and Press Send.</li>
                  <li>Download the receipt.</li>
                  <li>Click the Upload Payment button on the payment history.</li>
                  <li>Choose and upload your receipt.</li>
                  <li>Wait for the notification that your payment is approved.</li>
                </ol>
              </div>
              <!-- End Modal Body -->

              <!-- Modal Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
      <!-- End GCash QR Modal -->

    </div>
  </section> <!-- End of customer Account profile section-->
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
<script src="../js/account.js"></script>



