<?php
include "mail.php";
$current_timerr = new DateTime($_SESSION['current_timerr']);
$expiration_timerr = new DateTime($_SESSION['expiration_timerr']);
$new_timerr = new DateTime();
//sesions
$namecr=$_SESSION['namecr'];
$emailcr=$_SESSION['emailsignclient'];
$passwordclient=$_SESSION['passwordclient'];
$cpassclient=$_SESSION['cpassclient'];
$country=$_SESSION['country'];
$phone= $_SESSION['phone'];
$buss_discrip= $_SESSION['discrip'];
$pin=$_SESSION['pin'];
$drive=$_SESSION['drive'];

$msgcode="";
function generateOTP() {
    return rand(1000,9999); // 6-digit OTP
}

// Check if the resend button was clicked
if (isset($_POST['resend'])) {
    $new_otp = generateOTP();
    $_SESSION['otpemailcr'] = $new_otp;

    $current_timerr = new DateTime();
    $expiration_timerr = clone $current_timerr;
    $expiration_timerr->add(new DateInterval('PT60S'));

    $_SESSION['current_timerr'] = $current_timerr->format('Y-m-d H:i:s');
    $_SESSION['expiration_timerr'] = $expiration_timerr->format('Y-m-d H:i:s');
    $msg_on_mail="your new validation PIN is $new_otp ";

    // Send the OTP via email using PHPMailer

    // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


    $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA');          //sender mail address , website name

    $mail->addAddress($emailcr);      //reciever mail address

    $mail->isHTML(true);                               

    $mail->Subject = 'Activation code';             //mail subject

    $mail->Body=($msg_on_mail);                  //mail content

    $mail->send(); 
    // $to = $_SESSION['emailcr'];  // Use the stored email from the session
    // $subject = "Your OTP Code";
    // $message = "Your OTP code is: " . $new_otp;

    // $mail->setFrom('fatma.said283@gmail.com', 'Website Name');
    // $mail->addAddress($to);
    // $mail->isHTML(true);
    // $mail->Subject = $subject;
    // $mail->Body = $message;

    // if ($mail->send()) {echo "OTP has been resent to your email.";
    // } else {
    //     $msgcode= "Failed to resend OTP. Please try again.";
    // }
}

$randcr = $_SESSION['otpemailcr'];
if (isset($_POST['submit'])) {
    // $otp = $_POST['email_otp'];
    $otp = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit_4'];
    if($new_timerr > $expiration_timerr){
        $msgcode = "Expired OTP. Please press 'resend'.";
        unset($_SESSION['otpemailcr']); // Unset OTP if expired
    }elseif ($_SESSION['otpemailcr']==$otp) {
        echo "Email validated successfully";
        // unset($_SESSION['otpemail']);
        // header("Refresh: 1; url=home.php");
        $passhashr = password_hash($passwordclient, PASSWORD_DEFAULT);
        $stmt = $connect->prepare("INSERT INTO client (client_name, email, password, country, phone_no, business_descroption, pin, drive) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $namecr, $emailcr, $passhashr, $country, $phone, $buss_discrip, $pin, $drive);
        $stmt->execute();
        $stmt->close();
        // $insert="INSERT INTO client VALUES (NULL,'$namecr','$emailcr','$passhashr','$country','$phone','$buss_discrip','$pin','$drive')";
        // $run_insert=mysqli_query($connect,$insert);
        unset($_SESSION['otpemailcr']);
        $signup_msg="Welcome to MULTAQA, $namecr! we are glad to have you here with us. Your security PIN for logging in is $pin 
        please keep this mail incase you forgot your security PIN 
        -MULTAQA TEAM ";
        $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
        $mail->addAddress($emailcr); // Receiver mail address
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to MULTAQA!'; // Mail subject
        $mail->Body = $signup_msg; // Mail content
        $mail->send();
        header("Refresh: 1; url=loginA.php");

        exit();  

    } else {
        $msgcode= "Incorrect OTP";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE TITLE -->
    <title>OTP verification Form</title>
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Reem+Kufi:wght@400..700&display=swap" rel="stylesheet">
    <!-- GOOGLE ICONS LINK -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/OTP.css">
    <!-- JS LINK -->
    <script src="js/OTP.js " defer></script>
</head>
<body>
    <div class="container"> 
        <header>
          <i class="material-symbols-outlined"> verified_user</i>
        </header>
        <h4>Enter OTP Code</h4>
        <form method="POST" action="signupAotp.php">
            <div class="input-field">
                <input type="text" name="digit1" />
                <input type="text"  name="digit2" disabled  />
                <input type="text" name="digit3" disabled />
                <input type="text" name="digit_4" disabled />
            </div>
            <button class=""  type="submit" name="submit">Verify OTP</button>
            <button class="resendBtn" type="submit" name="resend">Resend OTP</button>
        </form>
        <!-- i added this -->
                     <?php if(!empty($msgcode)){ ?>
                            <p><?php echo $msgcode ;?></p>
                     <?php }else { } ?>
    </div>
    <script src="js/OTP.js"></script>
</body>
</html>