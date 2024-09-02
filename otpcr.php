<?php
include "mail.php";

$emailforget = $_SESSION['emailforget'];

// Function to generate a random OTP
function generateOTP() {
    return rand(1000, 9999); // 4-digit OTP
}

// Handle OTP resend
if (isset($_POST['resend'])) {
    $new_otp = generateOTP();
    $_SESSION['otp'] = $new_otp;
    $reset_msg="To reset your password, please enter this PIN $new_otp";

    $current_timeotpcr = new DateTime();
    $expiration_timeotpcr = clone $current_timeotpcr;
    $expiration_timeotpcr->add(new DateInterval('PT60S')); // Set expiration time to 60 seconds

    $_SESSION['current_timeotpcr'] = $current_timeotpcr->format('Y-m-d H:i:s');
    $_SESSION['expiration_timeotpcr'] = $expiration_timeotpcr->format('Y-m-d H:i:s');

    // Send the OTP via email using PHPMailer
    $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
    $mail->addAddress($emailforget); // Receiver mail address
    $mail->isHTML(true);
    $mail->Subject = 'Reset password PIN'; // Mail subject
    $mail->Body = $reset_msg; // Mail content
    $mail->send();
}

// Initialize error variable
$error = "";

// Handle OTP submission
if (isset($_POST['submit'])) {
    // $otp = $_POST['otp'];
    $otp = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit_4'];
    $current_timeotpcr = new DateTime(); // Update current time each time the form is submitted
    $expiration_timeotpcr = new DateTime($_SESSION['expiration_timeotpcr']);

    if ($current_timeotpcr > $expiration_timeotpcr) {
        $error = "Expired OTP. Please press 'resend'.";
        unset($_SESSION['otp']);
    } elseif ($_SESSION['otp'] == $otp) {
        echo "Validation completed";
        header("location:resetpassclient.php");
        // // Redirect based on the type of user
        // if (isset($_SESSION['client_id'])) {
        //     header("location:resetpasscr.php");
        // } elseif (isset($_SESSION['freelancer_id'])) {
        //     header("location:resetpassfr.php");
        // }
        unset($_SESSION['otp']);
        exit();
    } else {
        $error = "Incorrect OTP";
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
        <form method="POST" action="otpcr.php">
            <div class="input-field">
                <input type="text" name="digit1" />
                <input type="text" name="digit2" disabled />
                <input type="text"  name="digit3" disabled />
                <input type="text"  name="digit_4" disabled />
            </div>
            <button class="" type="submit" name="submit">Verify OTP</button>
            <button class="resendBtn"  type="submit"name="resend">Resend OTP</button>
        </form>
        <?php if (!empty($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <script src="js/OTP.js"></script>
</body>
</html>