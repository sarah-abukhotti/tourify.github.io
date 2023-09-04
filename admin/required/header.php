<?php 
include_once('..\required/server.php'); 
  ?>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="..\assets/img/booking.png" alt="">
        <span class="d-none d-lg-block">
               <?php echo $_SESSION['systemInfo']['short_name'] ?>

      </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
 

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
 
   
        </li><!-- End Messages Nav -->


        <li class="nav-item dropdown pe-3">
          <?php
         /*   <img src="..\profile/'.$_SESSION['user']['image'].'" alt="Profile" class="rounded-circle">*/

          if (isLoggedIn()) { 
            echo '<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../profile/'.$_SESSION['user']['image'].'" alt="Profile" class="rounded-circle"> 
            <span class="d-none d-md-block dropdown-toggle ps-2">'.$FullName.'</span>
          </a>  
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span>'.$FullName.'</span>
             </li>
            <li>
              <hr class="dropdown-divider">
            </li>

         
            <li>
              <hr class="dropdown-divider">
            </li>
  
                <li>
              <hr class="dropdown-divider">
            </li>
  
            <li>
            <a class="dropdown-item d-flex align-items-center" href="../settings.php">
              <span> <i class="ri-settings-line"></i> Settings </span>
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center">
              <span> <i class="ri-history-fill"></i> Joined on '.$_SESSION['user']['joinAt'].' </span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="?logout=1">
              <i class="bi bi-box-arrow-right"></i>
              <span> Logout </span>
            </a>
          </li>
          </ul> ';
             
           } 
          ?> 
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->