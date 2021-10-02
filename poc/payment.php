<?php
include "style.php";
if(!isset($_POST['payment_api']) && !isset($_POST['payment']) ){
    die("Sorry! amount not sent, <a href='/' > Go back to site</a>");
}
$amount = $_POST['amount'];


if ($_POST['TestPayment']){
    $_SESSION[$_SESSION['username'].'is_pro_user'] = true;
    echo '<script type="text/javascript" >window.location.href  = "/"</script>';

    die;
}
else if(isset($_POST['payment']) && isset($_POST['amount']) && isset($_POST['cardNumber']) && isset($_POST['cvv']) ){
   echo "
   <div class='mt-2'>
   <div class='alert alert-danger' role='alert'>
     Sorry!! Payment declined.</div></div>";
    die;
}
?>

<style>
.rounded {
    border-radius: 1rem
}

.nav-pills .nav-link {
    color: #555
}

.nav-pills .nav-link.active {
    color: white
}

input[type="radio"] {
    margin-right: 5px
}

.bold {
    font-weight: bold
}
</style>


<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Bootstrap Payment Forms</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <p>you will be charged $60</p>
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" method="post">
                                <div class="form-group"> <label for="username">
                                <input type="hidden" name="amount" value="<?= $amount ?>" />
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" name="cvv" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button type="submit" name="payment" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment  ($<?= $amount ?>) </button>
                            <input type="hidden" name="TestPayment" value="lorem" />
                            </form>
                        </div>
                    </div> <!-- End -->
                    
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>