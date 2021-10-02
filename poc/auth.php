<?php 
session_start();



if( isset($_SESSION['username']) && !isset($_SESSION[$_SESSION['username'].'is_pro_user'])){
    $_SESSION[$_SESSION['username'].'is_pro_user'] = false;
}

$cache =  new \Memcached();
$cache->addServer('localhost', '11211');

if(isset($_GET['logout'])){
    session_destroy();
    echo "<script type='text/javascript'>window.location.href= '/'</script>";
    die;
}

if(isset($_GET['remove_pro'])){
    $_SESSION[$_SESSION['username'].'is_pro_user'] = false;
}

if(isset($_GET['delete_cache'])){
    $cache->flush();
    die('All cache are flushed');
}


if(isset($_POST['username']) && !empty($_POST['username'])){
    $_SESSION['username'] = $_POST['username'];
}
    
if(!isset($_SESSION['username'])):
?>



<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CloudOnier</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Knight - v4.5.0
  * Template URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <a href="index.html" class="hero-logo" data-aos="zoom-in"><img src="assets/img/hero-logo.png" alt=""></a>
      <h1 data-aos="zoom-in">Welcome to CloudOnier</h1>
      <h2 data-aos="fade-up">Please choose a username to get started</h2>

      <form method="post">
        <label>
            <input type="text" data-aos-delay="200"   name="username" class="btn-get-started-form scrollto" placeholder="username" />
        </label>
        <input data-aos="fade-up" data-aos-delay="200"   type="submit" value="Register" class="btn-get-started scrollto">

        </form>
    </div>
  </section><!-- End Hero -->


    </div>
  </header><!-- End Header -->

    <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


<?php die; endif; ?>