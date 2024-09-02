<?php
include "mail.php";
$msgcr="";

function Numberic($pin) {
    if (!ctype_digit($pin)) {
         $msgcr = "Error: Input must be numeric.";
    }  
}

if(isset($_POST['submit'])){
    $namecr=$_POST['name'];
    $_SESSION['namecr']=$namecr;

    $emailcr=$_POST['email'];
    $_SESSION['emailsignclient']=$emailcr;

    $passwordclient=$_POST['password'];
    $_SESSION['passwordclient']=$passwordclient;

    $cpassclient=$_POST['cpassword'];
    $_SESSION['cpassclient']=$cpassclient;

    $country=$_POST['country'];
    $_SESSION['country']=$country;

    $phone=$_POST['phone'];
    $_SESSION['phone']=$phone;
    
    $buss_discrip=$_POST['discrip'];
    $_SESSION['discrip']=$buss_discrip;

    $pin=$_POST['pin'];
    $_SESSION['pin']=$pin;

    $drive=$_POST['drive'];
    $_SESSION['drive']=$drive;

    $select = "SELECT * FROM client WHERE email = '$emailcr'";
    $runsel = mysqli_query($connect , $select);
    $row = mysqli_num_rows($runsel);

    $uppercase=preg_match('@[A-Z]@' ,$passwordclient);
    $lowercase=preg_match('@[a-z]@' ,$passwordclient);
    $number=preg_match('@[0-9]@' ,$passwordclient);
    $character=preg_match('@[^/w]@' ,$passwordclient);

    if(empty($namecr)||empty($emailcr)||empty($passwordclient)||empty($cpassclient)||empty($country)||empty($phone)||empty($buss_discrip)||empty($pin)||empty($drive)){

        $msgcr = "Fill in the requried input please";
        //  fill echo "2";
    }elseif($uppercase<1 || $lowercase<1 ||$number<1 ||$character<1 ){
        $msgcr = "password must contain atleast 1 uppercase, lowercase, number, special characters";
        // pass req echo 3; 
    }elseif($row > 0){
        $msgcr = "This email already exists";
        //  exist echo 4;
    }elseif($passwordclient != $cpassclient){
        $msgcr= "Password doesn't match confirm password";
        //  match echo 5;
    }
    $numcheck=Numberic($pin);

    if(empty($msgcr)){
        header("location:signupAotp.php");
        $randcr=rand(1000,9999);

        $msg="Welcome to MULTAQA, to validate your email please enter this PIN: $randcr";
        $current_timerr = new DateTime();

        // Clone the current time and add 60 seconds
            $expiration_timerr = clone $current_timerr;
            $expiration_timerr->add(new DateInterval('PT60S')); // PT60S means 60 seconds
        
        // Store both in session
            $_SESSION['current_timerr'] = $current_timerr->format('Y-m-d H:i:s');
            $_SESSION['expiration_timerr'] = $expiration_timerr->format('Y-m-d H:i:s');
        
    
              // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
              $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA');     //sender mail address , website name
    
              $mail->addAddress($emailcr);      //reciever mail address
    
              $mail->isHTML(true);                               
    
              $mail->Subject = 'Activation code';             //mail subject
    
              $mail->Body=($msg);                  //mail content
    
              $mail->send(); 
    // php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $_SESSION['otpemailcr']=$randcr;
    }


}
?>

<!-- <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --color-1: #040D12;
    --color-2: #183D3D;
    --color-3: #5C8374;
    --color-4: #93B1A6;
}

body {
    /* font-family: Arial, sans-serif; */
    background-color: var(--color-1);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
#openTOS{
    text-decoration: none;
 color: #5C8374;
}
.image {
    width: 95%;
    height: 100vh;
    top: 0;
    margin-left:30px;

    align-self: flex-start;
    overflow: hidden;
}

.image img {
    width: 85%;
    min-height: 97vh;
    margin-left:30px;
}








.container {
    background-color: var(--color-1);
    box-shadow: 0 0 20px #101514,
        0 0 1px var(--color-3), 0 0 4px var(--color-2),
        0 0 4px var(--color-3), 0 0 6px var(--color-3);
    padding: 20px;
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
}

.heading {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: var(--color-4);
    font-family: none;
}

.form {
    display: flex;
    flex-direction: column;
}

.input-group {
    position: relative;
    margin-bottom: 15px;
    font-family: none;
}

.icon {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
}

.icon-right {
    right: 10px;
    left: auto;
    cursor: pointer;
}

.input-field {
    width: 100%;
    padding: 10px 10px 10px 35px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s;
}

.input-field:focus {
    border-color: #93B1A6;
    border-width: 2px;
}

select.input-field {
    padding-left: 15px;
}

.tos {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    color: #fff;
}

.tos input {
    margin-right: 10px;
}

.form button {
    /* padding: 12px; */
    background-color: var(--color-2);
    color: #fff;
    border: none;
    border-radius: 30px;
    /* font-size: 16px; */
    cursor: pointer;
    width: 60%;
    height: 55px;
}

.btn {
    display: block;
    width: 60%;
    height: 55px;
    position: relative;
    font-weight: 500;
    letter-spacing: 0.05em;
    border-radius: 30px;
    background: linear-gradient(to right, #040D12, #5C8374);
    color: var(--color-4);
    overflow: hidden;
    margin: 8px auto;
    text-align: center;
    transition: background-color 0.4s;
    font-family: none;
}

.btn:hover {
    background-color: var(--color-3);
}

.btn span {
    position: relative;
    z-index: 10;
    transition: color 0.4s;
    display: inline-flex;
    align-items: center;
    font-size: 20px;
    padding: 0.8em 1.2em 0.8em 1.05em;
}

.btn::before,
.btn::after {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.btn::before {
    content: "";
    background: var(--color-2);
    width: 120%;
    left: -10%;
    transform: skew(30deg);
    transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
}

.btn:hover::before {
    transform: translate3d(100%, 0, 0);
}

.btn:active {
    transform: scale(0.95);
}

.already {
    text-align: center;
    margin-top: 10px;
    color: #fff;
}

.already a {
    color: var(--color-4);
    text-decoration: none;
}

.already a:hover {
    text-decoration: underline;
}
.main_container{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    min-height: 100vh;
    gap: 40px;
    padding: 7px 25px 7px 25px;
}


.tos-popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.tos-popup .tosContent {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    position: relative;
    width: 90%;
    max-width: 600px;
}

.close-tos {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
} -->

<!-- /* Responsive Design */
@media (max-width: 600px) {
    .container {
        padding: 15px;
    }

    .heading {
        font-size: 20px;
    }

    .input-field {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
        padding: 8px;
    }
} -->
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif">
   <!-- FONT AWESOME LINK -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
     <!-- BOOTSTRAP LINK -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/signupA.Css">

</head>

<body>
 <!-- NAV BAR STARTS -->
<!--  <nav id="NAV" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
        <div class="container">
        <img src="img/image.png" alt="">
            <a class="navbar-brand" href="#">MULTAQA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-4">
                        <a class="nav-link active" aria-current="page" href="#">Landing</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
  </nav> -->
    <!-- NAV BAR ENDS -->

 <!-- FORM STARTS -->

  <div class="main-content">
   <div class="main-container">
    <div class="form-title"> Sign Up</div>
     <form class="form" method="POST">

        <div class="input-group">
            <i class="fa-solid fa-user icon"></i>
            <input class="input-field" type="text" placeholder="Under which name" required  name="name">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock icon"></i>
            <i id="showPass" class="fa-solid fa-eye icon-right" id='showConfirmIcon' ></i>
            <input id="passwordInput" class="input-field" type="password" placeholder="Password" required name="password">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock icon"></i>
            <i id="showPass" class="fa-solid fa-eye icon-right" id='showConfirmIcon'></i>
            <input id="passwordInput" class="input-field" type="password" placeholder="confirm Password" required name="cpassword">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-envelope icon"></i>
            <input class="input-field" type="email" placeholder="E-mail" required name="email">
        </div>

        <div class="input-group">
          <i class="fa-regular fa-comment icon"></i>
            <input class="input-field" type="text" placeholder="business description" required  name="discrip">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-phone icon"></i>
            <input class="input-field" type="tel" placeholder="Phone number" name="phone">
        </div>

        <div class="input-group">
           <i class="fa-solid fa-link icon"></i>
            <input class="input-field" type="text" placeholder="Drive Link"  name="drive">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-shield icon"></i>
            <input class="input-field" type="text" placeholder="Enter a security PIN"  name="pin" maxlength="4">
        </div>

        <div class="input-group">
            <select class="input-field" name="country" id="country" required>
                <option selected disabled value="">Select your country</option>
                <option value="Egypt">Egypt</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="Kuwait">Kuwait</option>
                <option value="qatar">qatar</option>
                <option value="Oman">Oman</option>
                <option value="Bahrain">Bahrain</option>
                <option value="lebanon">lebanon</option>
            </select>
        </div>
      

        <div class="tos">
            <input type="checkbox" required>
            <label class="forget" for="">I agree on all <a id="openTOS" href="#">Terms of Services</a></label>

        </div>

        <button type="submit" class="btn" name="submit"><span>Sign Up</span></button>

        <p class="already">Already have an account? <a href="loginA.php">Login</a></p>
    </form>

    <!-- popup start -->
    <!-- popup end -->
    
     </div>
     <!-- main container end -->
    <div class="image">
    <img src="./img/image final.png" alt="">
   </div>
   <!-- img end -->
  </div>
  <!-- main content end -->

  <script src="./js/signupA.js"></script>
</body>

</html>
