<section id="counts" class="counts section-bg">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
        <div class="count-box">
          <i class="bi bi-emoji-smile"></i>
          <span data-purecounter-start="0" data-purecounter-end="<?php echo countInteractions() ?>" data-purecounter-duration="1" class="purecounter" style="font-family: sans-serif; font-weight: bold;"></span>
          <p style="font-family: sans-serif; font-weight: bold;">User Interactions</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
        <div class="count-box">
          <i class="bi bi-layout-text-sidebar-reverse"></i>
          <span data-purecounter-start="0" data-purecounter-end="<?php echo countLandmarks() ?>" data-purecounter-duration="1" class="purecounter" style="font-family: sans-serif; font-weight: bold;"></span>
          <p style="font-family: sans-serif; font-weight: bold;">Number of Entertainment Places</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
        <div class="count-box">
          <i class="bi bi-people"></i>
          <span data-purecounter-start="0" data-purecounter-end="<?php echo countClients() ?>" data-purecounter-duration="1" class="purecounter" style="font-family: sans-serif; font-weight: bold;"></span>
          <p style="font-family: sans-serif; font-weight: bold;">Total Users</p>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Counts Section -->


<main id="main">

  <style>
    .our_services {
      /* margin-bottom: 10px; */
      padding: 50px;
    }
  </style>

  <!-- ======= Why Us Section ======= -->

  <section id="services" class="why-us">
    <div class="container">
      <div class="section-title">
        <h2 class="our_services">Our Services</h2>
      </div>

      <div class="row">
        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="box">
            <span>01</span>
            <h4>Easy Booking Process</h4>
            <p>You can easily book villas and resorts. The system facilitates the booking process between owners and customers.</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="box">
            <span>02</span>
            <h4>Easy to Use</h4>
            <p>It is easy to find information about entertainment places and villas. All you have to do is search in the box or browse the entertainment places.</p>
          </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="box">
            <span>03</span>
            <h4>If You're an Owner</h4>
            <p>If you agree to collaborate with us, we will create a page for your services and you will receive reservations from our users.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- End Counts Section -->

  <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="Questions" class="faq">
    <div class="container">
      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
      </div>

      <ul class="faq-list">

        <li>
          <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">How do we work? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq3" class="collapse" data-bs-parent=".faq-list">
            <p>We add the place, its details, specifications, and rental price to the website to make browsing, searching, and booking easier for you.</p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">How can I publish my properties on the Villat website?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq1" class="collapse" data-bs-parent=".faq-list">
            <p>If you have an available property and want to generate financial returns from it and facilitate booking for people, feel free to join our website. When registering your user data, don't forget to select the account type (owner). Go to <a href="registry.php">Registration</a>.</p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">How to build an owner profile?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq4" class="collapse" data-bs-parent=".faq-list">
            <p>You can go to the user registration page after entering your information. Make sure to choose the user type as the owner to enter the property management interfaces for the owner.</p>
          </div>
        </li>

      </ul>

    </div>
  </section><!-- End Frequently Asked Questions Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact section-bg">
    <div class="container">
      <div class="section-title">
        <h2>Contact</h2>
        <p>You can report any issues you encounter in the system.</p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3><?= $_SESSION['systemInfo']['city'] ?></h3>
                <p><?= $_SESSION['systemInfo']['location'] ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Email:</h3>
                <p><?= $_SESSION['systemInfo']['email'] ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Phone:</h3>
                <p><?= $_SESSION['systemInfo']['contact'] ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
          <form method="post" id="myForm" class="php-email-form">
            <div class="row gy-4">
              <?php
              if (isLoggedIn()) {
                echo '
                <div class=col-md-6>
                  <input type="text" id="name" class="form-control" name="name" value ="' . $FullName . '" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="email" id="email"  value =' . $_SESSION['user']['email'] . '>
                </div>';
              } else {
                echo '
                <div class=col-md-6>
                  <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>';
              }
              ?>
              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <button type="button" name="send" class="btn btn-outline-danger" id="send">Send Message</button>
              </div>

            </div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<script>
  $('form').on("click", '#send', function() {

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    if (name == '') {
      CuteAleart('error', 'Error', 'Full name is required');
    } else {
      if (email == '') {
        CuteAleart('error', 'Error', 'Email is required');
      } else {
        if (subject == '') {
          CuteAleart('error', 'Error', 'Subject is required');
        } else {
          if (message == '') {
            CuteAleart('error', 'Error', 'Message is required');
          } else {
            var formData = $('#myForm').serializeArray();
            $.ajax({
              type: "POST",
              data: formData,
              datatype: 'json',
              url: "required/contact.php",
              success: function(html) {
                CuteAleart('info', 'Success', 'Message sent successfully');
                document.getElementById("myForm").reset();
              },
            });
          }
        }
      }
    }
  });
</script>