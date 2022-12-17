<?php 
  include '../models/header.html';
//  include '../models/navbar.html'; ?>

<!-- customer Account profile section -->
<main id="main" class=" Account"> <!-- NOTE: overflow-scroll class for the datatables -->
  <!-- ======= Edit Profile ======= -->
  <section id="edit-profile" class="edit-profile">
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
              
              <!-- <li class="nav-item flex-fill">
                <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#customer-invoice" id="customer-invoice-tab">Invoice</button>
              </li> -->
              
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
                <div class="card overflow-auto">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Payment History</h5>
                      <table class="table table-borderless" id="customer-payment-tbl">
                        <thead>
                          <tr>
                            <th scope="col">Reference ID</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Invoice ID</th>
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
        </div><!-- End Customer Payment History -->
        
        <!--Customer Prorate History-->
        <div class="tab-content">
          <div class="tab-pane fade customer-prorate" id="customer-prorate">
            <div class="row">
              <div class="col-sm-12">
                <div class="card overflow-auto">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Prorates History</h5>
                      <table class="table table-borderless" id="customer-prorate-tbl">
                        <thead>
                          <tr>
                            <th scope="col">Prorate ID</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Prorate Discount</th>
                            <th scope="col">Ticket #</th>
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
        </div><!-- End Customer Prorate History -->

 
        <!-- Template -->
        <!-- <div class="tab-content pt-1">
          <div class="tab-pane fade customer-invoice" id="customer-invoice">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title">Invoice History</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        </div>
      </div>

      <!-- Payment Record Modal -->
      <div class="modal fade" id="view-payment" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-m">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
              <div class="row mb-3">
                <label for="payment_reference_id" class="col-sm-4 col-form-label">Reference ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="payment_reference_id" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="amount_paid" class="col-sm-4 col-form-label">Amount Paid</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="amount_paid" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="payment_date" class="col-sm-4 col-form-label">Payment Date</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="payment_date" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="invoice_id" class="col-sm-4 col-form-label" id="invoice_id_lbl">Invoice ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="invoice_id" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="tagged" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control text-center " id="tagged" value="" readonly>
                </div>
              </div>

            </div>
            <!-- End Modal Body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary" id="edit-btn">Edit</button>
              <button type="submit" class="btn btn-success" id="save-btn" disabled>Save Changes</button> -->
            </div>

          </div>
        </div>
      </div>

      <!-- Prorate Record Modal -->
      <div class="modal fade" id="view-prorate" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-m">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
              <div class="row mb-3">
                <label for="prorate_id" class="col-sm-4 col-form-label">Prorate ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="prorate_id" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="duration" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="prorate_charge" class="col-sm-4 col-form-label">Prorate Discount</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="prorate_charge" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="invoice_id_pr" class="col-sm-4 col-form-label">Invoice ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="invoice_id_pr" value="" readonly>
                </div>
              </div>

              <div class="row mb-3">
                <label for="prorate_status" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control text-center " id="prorate_status" value="" readonly>
                </div>
              </div>

            </div>
            <!-- End Modal Body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary" id="edit-btn">Edit</button>
              <button type="submit" class="btn btn-success" id="save-btn" disabled>Save Changes</button> -->
            </div>
          </div>
        </div>
      </div>


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



