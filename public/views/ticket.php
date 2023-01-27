<?php include '../models/header.html'; ?>

<!-- Customer Ticket History Section -->
<main id="main" class="customer-page">

  <!--dito ako nagbago -->
  <section class="tkt-tbl d-flex align-items-center">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="account-ticket col-xl-12">
          <div class="tkt-card">
            <div class="row pt-3 p-3">
              <div class="col-sm-9"><h5 class="card-title">Ticket History</h5></div>
              <div class="col-sm-3 text-center pt-2"><a href="#create"><button class="btn btn-primary w-100">Submit a Ticket</button></a></div>
            </div>
            <div class="card-body">
              <table class="table table-borderless pt-3" id="customer-ticket-tbl">
                <thead>
                  <tr> <!--dito ako nagbago -->
                    <th class="tbl-head" scope="col">#</th>
                    <th class="tbl-head" scope="col">Ticket No.</th>
                    <th class="tbl-head" scope="col">Concern</th>
                    <th class="tbl-head" scope="col">Date Filed</th>
                    <th class="tbl-head" scope="col">Date Resolved</th>
                    <th class="tbl-head" scope="col">Status</th>
                    <th class="tbl-head" scope="col">View</th>
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
  </section> <!-- End of Customer Ticket History Section-->

  <!-- Create a Ticket -->
  <section class="align-items-center" id="create">
  <form class="ticket-form" id="create-ticket">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="card col-md-6">
          <div class="card-body pt-4">
            <header class="section-header">
              <p class="text-center">Submit a Ticket</p>
            </header>

              <div class="row-4">
                <label for="ticket_num_create" class="form-label">Ticket Number</label>
                <input type="text" class="form-control" id="ticket_num_create" readonly>
              </div>

              <div class="row-4">
                <label for="date_filed_create" class="form-label">Date Filed</label>
                  <input type="date" class="form-control" id="date_filed_create" readonly>
              </div>

              <div class="row-g-3">
                <label for="concern_id_create" class="form-label">Concern Category</label>
                  <select class="form-select" id="concern_id_create" required>
                    <option selected disabled value="">Select Concern Category</option>
                  </select>
              </div>

              <div class="row-md-4">
                <label for="concern_details_create" class="form-label">Concern Details</label>
                <textarea class="form-control" id="concern_details_create" rows="4" placeholder="Please tell us your issue..." required></textarea>
              </div>

              <div class="text-center pt-2">
                <button class="btn btn-primary" type="submit">Submit Ticket</button>
              </div>

          </div>
        </div>
      </div>
    </div>
  </form>
  </section>


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
            </div>
          </div>
        </div>
      </div>


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
<script src="../js/ticket.js"></script>

</body>
</html>
