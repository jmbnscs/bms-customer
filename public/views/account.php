<?php 
  include '../models/header.html';
//  include '../models/navbar.html'; ?>

<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Navigation Tabs -->
                <div class="card">
                <div class="card-body pt-3 pb-0">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex">

                    <li class="nav-item flex-fill">
                        <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#customer-invoice" id="customer-invoice-tab">Invoice</button>
                    </li>

                    <!-- <li class="nav-item flex-fill">
                        <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#customer-invoice" id="customer-invoice-tab">Invoice</button>
                    </li> -->

                    <li class="nav-item flex-fill">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#customer-payment" id="customer-payment-tab">Payment</button>
                    </li>

                    <li class="nav-item flex-fill">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#customer-prorate" id="customer-prorate-tab">Prorate</button>
                    </li>

                    <li class="nav-item flex-fill">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#customer-ticket" id="customer-ticket-tab">Ticket</button>
                    </li>

                    </ul><!-- End Bordered Tabs -->

                </div>
                </div>

                <!-- Customer Invoice History  -->
                <div class="tab-content">
                <div class="tab-pane fade show active customer-invoice" id="customer-invoice">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                        <div class="card-body">
                            <div>
                            <h5 class="card-title">Invoice History</h5>
                                <table class="table table-borderless" id="customer-invoice-tbl">
                                <thead>
                                    <tr>
                                    <th scope="col">Invoice ID</th>
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
                </div><!-- End Customer Invoice History -->

                <!-- Customer Payment History -->
                <div class="tab-content">
                <div class="tab-pane fade customer-payment" id="customer-payment">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
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

                <!-- Customer Prorate History -->
                <div class="tab-content">
                <div class="tab-pane fade customer-prorate" id="customer-prorate">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                        <div class="card-body">
                            <div>
                            <h5 class="card-title">Prorates History</h5>
                                <table class="table table-borderless" id="customer-prorate-tbl">
                                <thead>
                                    <tr>
                                    <th scope="col">Prorate ID</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Prorate Charge</th>
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

                <!-- Customer Ticket History -->
                <div class="tab-content">
                <div class="tab-pane fade customer-ticket" id="customer-ticket">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                        <div class="card-body">
                            <div>
                            <h5 class="card-title">Tickets History</h5>
                                <table class="table table-borderless" id="customer-ticket-tbl">
                                <thead>
                                    <tr>
                                    <th scope="col">Ticket #</th>
                                    <th scope="col">Concern</th>
                                    <th scope="col">Date Filed</th>
                                    <th scope="col">Date Resolved</th>
                                    <th scope="col">Admin</th>
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
                </div><!-- End Customer Ticket History -->

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
            <label for="prorate_charge" class="col-sm-4 col-form-label">Prorate Charge</label>
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
            <div class="col-sm-3">
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

<!-- Ticket History Modal -->
<div class="modal fade" id="view-ticket" tabindex="-1">
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
            <label for="ticket_num" class="col-sm-4 col-form-label">Ticket #</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="ticket_num" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="concern_category" class="col-sm-4 col-form-label">Concern Category</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="concern_category" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="concern_details" class="col-sm-4 col-form-label">Concern Details</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="concern_details" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="date_filed" class="col-sm-4 col-form-label">Date Filed</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="date_filed" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="resolution_details" class="col-sm-4 col-form-label">Resolution Details</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="resolution_details" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="date_resolved" class="col-sm-4 col-form-label">Date Resolved</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="date_resolved" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="admin_id" class="col-sm-4 col-form-label">Admin</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="admin_id" value="" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="ticket_status" class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-4">
              <input type="text" class="form-control text-center " id="ticket_status" value="" readonly>
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
</section><!-- End Hero -->

<main id="main">
    <!-- ======= Edit Profile ======= -->
    <section id="edit-profile" class="edit-profile">
      <div class="container" data-aos="fade-up">
        <div class="row pt-2">
            
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
<script src="../js/account.js"></script>

</body>
</html>
