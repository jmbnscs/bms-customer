<?php include '../models/landing_header.html'; ?>

<!-- ======= Hero Section ======= -->
<main id="main">

<!-- Main Section -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Become one of the many customers choosing GSTech</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">service for your home to enjoy
                                                    fast but cheaper internet!</h2>
        <!-- <div data-aos="fade-up" data-aos-delay="800">
          <div class="text-center text-lg-start">
            <a href="#inquire" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Get Started</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div> -->
      </div>

      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="../images/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>

</section>
<!-- End Main Section -->


<!-- ======= ADVERTISEMENT ONLY ======= -->
<section id="plans" class="d-flex align-items-center plans-container">
  <div class="container">
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
              <img src="../images/GS-TECH AD1.png" alt="Advertisement 1" class="d-block" style="width:100%; height: 80vh;">
            </div>
            <div class="carousel-item">
              <img src="../images/GS-TECH AD2.png" alt="Advertisement 2" class="d-block" style="width:100%; height: 80vh;">
            </div>
            <div class="carousel-item">
              <img src="../images/GS-TECH AD3.png" alt="Advertisement 3" class="d-block" style="width:100%; height: 80vh;">
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

</section><!-- End Ads Hero -->

<!-- ======= About Section ======= -->
<section id="about" class="hero about d-flex align-items-center">
  <div class="container" data-aos="fade-up">
    <div class="row">
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
          <div class="text-center text-lg-start"></div>
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

<!-- ======= Inquire Section ======= -->
<!-- <section id="inquire" class="inquire-section hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div>
          <h4>Let's talk about everything!</h4>
          <p>We're open to any suggestions or just to have a chat.</p>
          <div class="p-4">
            <div class="d-flex p-2 icon-container">
              <div><i class="ri ri-mail-send-fill inquire-icon pe-3"></i></div>
              <div class="pt-2">bill.gstech@gmail.com</div>
            </div>
            <div class="d-flex p-2 icon-container">
              <div><i class="ri ri-map-pin-2-fill inquire-icon pe-3"></i></div>
              <div>Blk 1 Lot 2A Mars St. Sikat Araw Nagpayong, Pinagbuhatan, Pasig City</div>
            </div>
            <div class="d-flex p-2 icon-container">
              <div><i class="ri ri-map-2-line inquire-icon pe-3"></i></div>
              <div class="inquire-map-link"><a href="https://goo.gl/maps/zSNAPMqvswBSgGXe8">View on Google Maps</a></div>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.997262414154!2d121.10013391527875!3d14.542149182404007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c7a056c5a3a7%3A0x3eee30bda9898713!2sMars%20Street%2C%20Sikat%20Araw%2C%20Nagpayong!5e0!3m2!1sen!2sph!4v1674224002491!5m2!1sen!2sph" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="inquire-map"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="contact-card col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Contact Form</h5>
            <div class="inquire-form">
              <div class="row">
                <label for="inquire_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="inquire_name" required>
              </div>

              <div class="row pt-3">
                <label for="inquire_email" class="form-label">Your Email</label>
                <input type="text" class="form-control" id="inquire_email" required>
              </div>

              <div class="row pt-3">
                <label for="inquire_subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="inquire_subject" required>
              </div>

              <div class="row pt-3">
                <label for="inquire_message" class="form-label">Your Message</label>
                <textarea type="text" class="form-control" id="inquire_message" required></textarea>
              </div>

              <div class="row pt-3">
                <button class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- End Inquire Section -->

</main>

<!-- <footer class="footer py-4 d-flex">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-lg-center">Copyright &copy; The Conquerors 2022</div>
        </div>
    </div>
</footer> -->

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
<!-- <script src="../js/main.js"></script> -->
<script src="../js/home.js"></script>

</body>
</html>
