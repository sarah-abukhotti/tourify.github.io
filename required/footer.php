<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 footer-contact">
          <h3><?= $_SESSION['systemInfo']['short_name'] ?></h3>
          <p>
            <?= $_SESSION['systemInfo']['HTMLLocation'] ?>
            <strong>Phone:</strong>+<?= $_SESSION['systemInfo']['contact'] ?><br>
            <strong>Email:</strong><?= $_SESSION['systemInfo']['email'] ?><br>
          </p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Important Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i><a href="#services">Our Services</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="#Questions">FAQs</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Categories</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i><a href="index.php">Home</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="browse.php">Browse</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="registry.php">Registration</a></li>
            <li><i class="bx bx-chevron-right"></i><a href="login.php">Login</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4><?php echo $_SESSION['systemInfo']['name'] ?></h4>
          <p>Remember, time is money. Use it wisely. Don't waste your time thinking when others are getting things done here.</p>
        </div>
      </div>
    </div>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets2/vendor/purecounter/purecounter.js"></script>
<script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets2/vendor/php-email-form/validate.js"></script>
<script src="toster/SwetAlert/sweetalert2@11.js"></script>
<!-- Template Main JS File -->
<script src="assets2/js/main.js"></script>
</body>
</html>
