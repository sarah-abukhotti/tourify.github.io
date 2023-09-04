<?php
include_once('required/server.php');
?>

<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center justify-content-between">
    <i class="bi bi-list mobile-nav-toggle"></i>

    <h1 class="logo"><a href="index.php"><?= $_SESSION['systemInfo']['short_name'] ?></a></h1>

    <nav id="navbar" class="navbar">
      <ul dir="ltr">
        <?php
        if (!isLoggedIn()) {
          echo '
            <li class="dropdown"><a href="#" class="nav-link scrollto active"><span>Sections</span><i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#services">Services</a></li>
                <li><a href="#Questions">FAQs</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </li>
            <li><a class="nav-link scrollto active" href="browse.php">Browse</a></li>
            <li><a class="nav-link scrollto active" href="login.php">Login</a></li>
            <li><a class="getstarted scrollto" href="login.php">Get Started</a></li>
          ';
        } else {
          if ($_SESSION['user']['type'] == 1) {
            $href = 'admin/';
          } elseif ($_SESSION['user']['type'] == 2) {
            $href = 'owner/';
          } else {
            $href = '';
          }

          echo '
            <li><a class="nav-link scrollto active" href="browse.php">Browse</a></li>
            <li class="dropdown btn-group"><a href="#"><span>' . @$FullName . '</span><i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="' . $href . '">' . getUserType($_SESSION['user']['type']) . '</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="?logout=1">Logout</a></li>
              </ul>
            </li>
            <li class="navbar-brand" href="#">
              &nbsp;&nbsp;
              <img src="profile/' . $_SESSION['user']['image'] . '" class="rounded-circle" width="32" height="32" alt="" style="border: 1px double #AB81FF; padding: 2px">
            </li>
          ';
        }
        ?>
      </ul>
      <i class="bi mobile-nav-toggle bi-x"></i>
    </nav>
  </div>
</header>
