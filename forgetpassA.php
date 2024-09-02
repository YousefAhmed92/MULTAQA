<?php
//check
include "mail.php";
$error="";
// $client_id=$_SESSION['client_id'];

    if(isset($_POST['submit'])){
        $emailforget=$_POST['email'];
        $_SESSION['emailforget']=$emailforget;
   
        $select="SELECT * FROM `client` where `email`='$emailforget'";
        $runselect=mysqli_query($connect,$select);
        if(mysqli_num_rows($runselect)>0){ 
$rand=rand(1000,9999);
        $msg="To reset your password, please enter this PIN $rand";

        $current_timeotpcr = new DateTime();

        // Clone the current time and add 60 seconds
            $expiration_timeotpcr = clone $current_timeotpcr;
            $expiration_timeotpcr->add(new DateInterval('PT60S')); // PT60S means 60 seconds
        
        // Store both in session
            $_SESSION['current_timeotpcr'] = $current_timeotpcr->format('Y-m-d H:i:s');
            $_SESSION['expiration_timeotpcr'] = $expiration_timeotpcr->format('Y-m-d H:i:s');
   
             // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
   
        $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA');          //sender mail address , website name
        $mail->addAddress($emailforget);      //reciever mail address
        $mail->isHTML(true);                               
        $mail->Subject = 'Reset password PIN';             //mail subject
         $mail->Body=($msg);                  //mail content
         $mail->send(); 
   // php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    $_SESSION['otp']=$rand;
    header("location:otpcr.php");
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
    <!-- FONT AWESOME LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- GOOGLE FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@800&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/verification.Css">
</head>

<body>
    <!-- FORM CONTAINER STARTS -->
    <div class="container">
        <div class="main">
            
            <div class="form">
                <h1> Enter Your email:</h1>

                <br>

                <form action="" method="POST">
                    <input type="email" placeholder="Email" class="input" name="email">
                    <button class="cssbuttons-io" name="submit">
                    <span>Submit</span>
                    </button>
                </form>
                <!-- button need to be in the form tag -->
                <!-- <button class="cssbuttons-io">
                    <span>submit</span>
                </button> -->
                <!-- i added this -->
                <?php if(!empty($error)){ ?>
                     <p> <?php echo $error ; ?></p>
                <?php } else{}?>
                
            </div>
            <img class="imgg" src="img/forgetpassword.png" alt="">
        </div>
    </div>
    <!-- FORM CONTAINER ENDS -->

    <!-- FOOTER STARTS -->
    <!-- FOOTER ENDS -->
</body>

</html>