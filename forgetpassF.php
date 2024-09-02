<?php
//check
include "mail.php";
$error="";
$freelancer_id=$_SESSION['freelancer_id'];
// $client_id=$_SESSION['client_id'];

//change the email session namee



    if(isset($_POST['submit'])){
        $emailforgetfr=$_POST['email'];
        $_SESSION['emailforgetfr']=$emailforgetfr;
   
        $select="SELECT * FROM `freelancer` where `email`='$emailforgetfr'";
        $runselect=mysqli_query($connect,$select);
        if(mysqli_num_rows($runselect)>0){

$rand=rand(1000,9999);
            $msg="To reset your password, please enter this PIN $rand";
                $current_timeotpfr = new DateTime();

                // Clone the current time and add 60 seconds
                    $expiration_timeotpfr = clone $current_timeotpfr;
                    $expiration_timeotpfr->add(new DateInterval('PT60S')); // PT60S means 60 seconds
                
                // Store both in session
                    $_SESSION['current_timeotpfr'] = $current_timeotpfr->format('Y-m-d H:i:s');
                    $_SESSION['expiration_timeotpfr'] = $expiration_timeotpfr->format('Y-m-d H:i:s');
           
   
             // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
   
                $mail->setFrom('fatma.said283@gmail.com', 'MALTAQA');          //sender mail address , website name
                $mail->addAddress($emailforgetfr);      //reciever mail address
                $mail->isHTML(true);                               
                $mail->Subject = 'Reset password PIN';             //mail subject
                $mail->Body=($msg);                  //mail content
                $mail->send(); 
   // php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $_SESSION['otp']=$rand;
            header("location:otpfr.php");
                // exit();
            }else{
             $error= "email not found";
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
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/verification.css">
    <!-- FONT AWESOME LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- GOOGLE FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@800&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- NAV BAR STARTS -->
    <!-- NAV BAR ENDS -->

    <!-- FORM CONTAINER STARTS -->
    <div class="container">
        <div class="main">
            
            <div class="form">
                <h1> Enter Your Email:</h1>

                <br>

                <form action="" method="POST">
                    <input type="email" placeholder="Enter" class="input" name="email">
                    <button class="cssbuttons-io" name="submit">
                        <span>submit</span>
                    </button>
                </form>
                <!-- i added this -->
                <?php if(!empty($error)){ ?>
                     <p> <?php echo $error ; ?></p>
                <?php } else{}?>
               
            </div>
            <img class="imgg" src="img/forgetpassword.png" alt="">
        </div>
    </div>
    <!-- FORM CONTAINER STARTS -->

    <!-- FOOTER STARTS -->
    <!-- FOOTER ENDS -->
</body>

</html>