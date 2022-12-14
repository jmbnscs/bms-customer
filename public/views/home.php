<?php 
  include '../models/header.html';
//  include '../models/navbar.html'; ?>

<!-- ======= SAMPLE ONLY ======= -->
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Become one of the many customers choosing GSTech</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">service for your home to enjoy
                                                    fast but cheaper internet!</h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Get Started</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="../images/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->


<main id="main">
  <!-- ======= ADVERTISEMENT ONLY ======= -->
<section class="d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class=" d-flex flex-column justify-content-center">

      <div id="ads_container" class="container">
        <div class="row">
          <div class="col align-self-center d-flex flex-column justify-content-center">
          <!-- Carousel -->
          <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../images/GS-TECH AD1.png" alt="Advertisement 1" class="d-block" style="width:100%">
              </div>
              <div class="carousel-item">
                <img src="../images/GS-TECH AD2.png" alt="Advertisement 2" class="d-block" style="width:100%">
              </div>
              <div class="carousel-item">
                <img src="../images/GS-TECH AD3.png" alt="Advertisement 3" class="d-block" style="width:100%">
              </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

</section><!-- End Ads Hero -->
      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container" data-aos="fade-up">
          <div class="row gx-0">
            <div
              class="col-lg-6 d-flex flex-column justify-content-center"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <div class="content">
                <h3>Who We Are</h3>
                <h2>
                  We are Pasig's budget-friendly internet service provider
                  that offers fast bandwidth speeds that will meet all your
                  internet needs
                </h2>
                <p>
                  -from streaming your favorite movies to video calling your
                  family and friends. We got your back! To date, we have been 
                  providing internet to more than a hundred household. 
                </p>
                <div class="text-center text-lg-start">
                  <a
                    href="#ads_container"
                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center"
                  >
                    <span>View Plans</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div
              class="col-lg-6 d-flex align-items-center"
              data-aos="zoom-out"
              data-aos-delay="200"
            >
              <img src="../images/about.jpg" class="img-fluid" alt="" />
            </div>
          </div>
        </div>
      </section>
      <!-- End About Section -->

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
<script src="../js/home.js"></script>

</body>
</html>
