<!DOCTYPE html>
<html lang="en">

<?php
// code refactor needed.
// require_once('colours.php');
require('auth.php');
require_once('logger.php');
require('contact.php');
$apiKey = "supersecretapikey";
$amount = 60;
// hash = username + amount + secret key
// $hash =  calculate_hash($_SESSION['username']);

// function calculate_hash($username,$amount,$apiKey){
//     return md5($username. $amount . $apiKey); 
// }

// register
if(isset($_POST['fullname']) && isset($_POST['email']))
{
    $contact = new \Contact();
    $contact->fullname = $_POST['fullname'];
    $contact->email = $_POST['email'];
    $contact->description = $_POST['description'];
    $cache->set($_SERVER['REMOTE_ADDR'],serialize($contact));
}

// fetch user from cache
$get_contact = $cache->get($_SERVER['REMOTE_ADDR']);

// get user details from cache 
if(isset($get_contact) && !empty($get_contact))
{
    $getContactClass = unserialize($get_contact);
//     print_r($getContactClass);
    // set data to variables
    $fullname= $getContactClass->fullname;
    $email = $getContactClass->email;
    $description = $getContactClass->description;
    
}

// upload file from input.
// upload file from input.
if(isset($_POST['uploadFile'])  ){
    $target_dir = "uploads/".$_SESSION['username'].'/';
    if(!file_exists($target_dir)) mkdir($target_dir,0777,true);

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
      } else {
        die( "Sorry, there was an error uploading your file.");
    }
}


// upload file url url
if(isset($_POST['urlUpload'])){

    // system(" curl ".$_POST['url'] ." --output uploads/".$_SESSION['username']."/".mt_rand(1111,99999)  );
    stream_wrapper_unregister('file');
    stream_wrapper_unregister('php');
    $file=trim($_POST['urlUpload']);
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $file);
    curl_exec ($curl);
    curl_close ($curl);
}

//  does payment

if(isset($_POST['payment'])){
    //TODO for payment
    $_SESSION[$_SESSION['username'].'is_pro_user'] = true;
}

?>

<!-- === second page  -->
<head>


<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Storage - CloudOnier</title>
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
</head>

<!-- end secondpage navbar -->

<body>


 <!-- ======= Header ======= -->
 <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
          <form class="d-flex">
          <li><a class="nav-link  scrollto" href="?logout">logout</a></li>
          </form>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->




  
<div class="container">
<p class="lead">List of files you have uploaded </p>
<ol class="list-group list-group-numbered">
    <?php 
        $dir = "uploads/".$_SESSION['username'].'/*';
        $files = glob($dir);
        
        foreach($files as $file):
    ?>
            <li class="list-group-item">
                <img src="<?php echo $file ?>"  width="10%"/>    
                <?php echo end(explode('/',$file)) ?>
            </li>
    <?php endforeach ?>
</ol>



<?php if(count($files) < 1 || $_SESSION[$_SESSION['username'].'is_pro_user'] == true): ?>
    <form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="form-label">Choose a file</label>
        <input class="form-control" type="file" name="file" />
    </div>
    <div class="form-group mt-2">
        <input type="submit" value="Upload" name="uploadFile" class="btn btn-primary" />
    </div>
    <?php 
    if($_SESSION[$_SESSION['username'].'is_pro_user']):
        echo "<p>Congrats, you are a pro user,you can now upload files directly from urls</p>";

        ?>
    <form method="post">
        <div class="form-group">
            <label class="form-label">File url</label>
            <input class="form-control" type="url" name="url" placeholder="http://example.com/myfiles.zip" />
        </div>
        <input type="submit" name="urlUpload" value="upload" class="btn btn-primary" />
    </form>

    <?php 
        
        endif;
    
    ?>
</form>

<?php  endif;

if(count($files) >= 1 && !$_SESSION[$_SESSION['username'].'is_pro_user']):
?>

<div class="mt-2">
    <div class="alert alert-danger" role="alert">
        you have reached the limit, Please see the pricing below
    </div>
</div>

<!--  -->


    <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="text-center p-5">
            <h2 class="text-highlight">price for your awesome product.</h2>
        </div>
        <div class="text-center">
            <div class="block d-inline-flex">
                <div class="p-4 p-sm-5 b-r"> <sup class="text-sm" style="top: -0.5em">$</sup><span class="h1">0</span>
                    <div class="text-muted">Free Account<BR>
                                            $0 / mo<BR>
                                            2 users included <BR>
                                            2 mb of storage<BR>
                                            Email support<BR>
                                            Help center access<BR>
                    </div>
                    <div class="py-4"><a href="#" class="btn btn-sm btn-rounded btn-primary" data-abc="true">Purchase</a></div> <small class="text-muted">End-product <strong>not</strong> for sale</small>
                </div>


                <div class="block d-inline-flex">
                <div class="p-4 p-sm-5 b-r"> <sup class="text-sm" style="top: -0.5em">$</sup><span class="h1">60$</span>
                    <div class="text-muted">Pro Account<BR>
                                            $60 / mo<BR>
                                            2 users included <BR>
                                            2 mb of storage<BR>
                                            Email support<BR>
                                            Help center access<BR>
                    </div>
                    <form method="post" action="/payment.php">
                    <input type="hidden" name="amount" value="<?= $amount ?>" /><BR>
                    <input type="hidden" name="hash" value="<?= $hash ?>" />
                    <button type="submit" name="payment" class="btn btn-sm btn-block btn-primary">Get started</button>
                 </form>

                </div>


                <div class="block d-inline-flex">
                <div class="p-4 p-sm-5 b-r"> <sup class="text-sm" style="top: -0.5em">$</sup><span class="h1">$?</span>
                    <div class="text-muted">Enterprise<BR>
                                          
                                          
                    <form method="post"> 
        <p> need unlimited uploads and backup<br>
        support? get a custom quote now</p>
        <div class="form-group">
            <label class="form-label"> FullName
                <input type="text" name="fullname" requred class="form-control" />
            </label>
        </div>
        <div class="form-group">
            <label  class="form-label"> Email
                <input type="email" name="email" class="form-control"  />
            </label>
        </div>
        <div class="form-group">
            <label  class="form-label">
                Description
                <textarea name='description' class="form-control" ></textarea>
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </form>



                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
</div>
</div>
</body>
</html>
