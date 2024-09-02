<?php
include "mail.php";
// include "connection.php";
    $errorlog ="";
    if(isset($_POST['btn'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $sel = "SELECT * FROM client WHERE email ='$email'";
        $run = mysqli_query($connect , $sel);
        $row = mysqli_num_rows($run);

        if(empty($email) || empty($pass)){
            $errorlog = "Fill in the requried input please"; 
        }

        if($row>0){
            $fetch = mysqli_fetch_assoc($run);
            $hash = $fetch['password'];
            if(password_verify($pass , $hash)){
                $client_id = $fetch['client_id'];
                $_SESSION['client_id'] = $client_id;
                // echo "logged";
                header("Location:security pin client.php");
                $secured=" Welcome back to MULTAQA you're about to login to your account if it's not you please click here to to get your account back: http://localhost/lastdance/loginA.php
                  -MULTAQA TEAM ";
                $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
                $mail->addAddress($email); // Receiver mail address
                $mail->isHTML(true);
                $mail->Subject = 'login action'; // Mail subject
                $mail->Body = $secured; // Mail content
                $mail->send();
                // header("Location:security pin client.php");
            }
            else{
                $errorlog = "The password entered is incorrect";
            }
        }else{
            $errorlog = "This email doesn't exist";
        }
    }
?>



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
    <link rel="stylesheet" href="css/log.css">
</head>

<body>
  <!-- NAV BAR STARTS -->
  <nav id="NAV" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
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
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
  <!-- NAV BAR ENDS -->

  <!-- PAGE CONTENT STARTS -->
  <div class="main-content">
  <div class="form-container">
    <!-- LEFT SRECTION STARTS -->
    <div class="left-section">
      <img src="img/Digital nomad-pana.png" alt="" class="img">
    </div>
    <!-- LEFT SRECTION ENDS -->

    <!-- RIGHT SRECTION STARTS -->
    <div class="right-section">
      <h2>YOU'RE A MEMBER ? LOGIN NOW</h2>
      <p>and start your own work</p>

   
      <!-- FORM STARTS -->
      <form method="POST">

        <!-- INPUTS -->
        <div class="input-group">
          <i class="fa-solid fa-user icon"></i>
          <input class="input-field" type="text" name="email" placeholder="Under which name" required>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock icon"></i>
          <!-- <i id="showPassword" class="fa-solid fa-eye icon-right"></i> -->
          <input id="passwordInput" class="input-field" type="password" name="password" placeholder="Password" required>
        </div>
        
        <!-- BUTTON STARTS -->
        <button class="cssbuttons-io" name="btn">
          <span>LOG IN</span>
      </button>
        <!-- BUTTON ENDS -->

      </form>

      <!-- i added this -->
      <?php if(!empty($errorlog)){ ?>
            <p class="zeina"><?php echo $errorlog ;?></p> 
      <?php }else{}?>
      <!-- FORM ENDS -->

      <!-- SIGN UP ANCHOR  -->
      <p class="login-link">Don't have an account? <a href="signupA.php">sign up</a></p>
      <!-- i added this anchor -->
      <p class="login-link">forgot your password?<a href="forgetpassA.php"> reset password</a></p>
      
    </div>
    <!-- RIGHT SRECTION ENDS -->

  </div>
  <!-- PAGE CONTENT ENDS -->

  <!-- FOOTER STARTS -->
  <!-- FOOTER ENDS -->
</body>

</html>
