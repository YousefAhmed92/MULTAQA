<?php
include "mail.php";  // Include your PHPMailer script
 // Ensure session is started
$current_time = new DateTime($_SESSION['current_time']);
$expiration_time = new DateTime($_SESSION['expiration_time']);
$new_time = new DateTime();



$nationalIDx = $_SESSION['national'];
$birthdatey = $_SESSION['date'];
$name = $_SESSION['name'];
$email = $_SESSION['emailsign'];
$password = $_SESSION['password'];
$cpass = $_SESSION['cpass'];
// $photo = $_SESSION['photo'];
// $tmpphoto = $_SESSION['tmp_photo'];
$price_hr = $_SESSION['price_hr'];
$availablehr = $_SESSION['available'];
// $skills = $_SESSION['skills'];
$graduate = $_SESSION['graduate'];
$free_cat = $_SESSION['free_cat'];
// $dis = $_SESSION['discription'];
$years_of_xp = $_SESSION['experiences'];

$free_subcat= $_SESSION['free_subcat'];
$pin= $_SESSION['pin'];

$count_view=$_SESSION['count_view'];
// $old_time = $_SESSION['old_time'];




// Convert old_time to DateTime
// $old_time = new DateTime($old_time);
// $new_time = new DateTime(date("Y-m-d H:i:s"));

$msgcode = "";

// Function to generate a random OTP
function generateOTP() {
    return rand(1000, 9999); // 4-digit OTP
}

// Check if the resend button was clicked
if (isset($_POST['resend'])) {
    $new_otp = generateOTP();
    $_SESSION['otpemail'] = $new_otp;

    $current_time = new DateTime();
    $expiration_time = clone $current_time;
    $expiration_time->add(new DateInterval('PT60S'));

    $_SESSION['current_time'] = $current_time->format('Y-m-d H:i:s');
    $_SESSION['expiration_time'] = $expiration_time->format('Y-m-d H:i:s');
    $mg_on_mail="Your new validation PIN is $new_otp";

    // Send the OTP via email using PHPMailer
    $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
    $mail->addAddress($email); // Receiver mail address
    $mail->isHTML(true);
    $mail->Subject = 'Activation code'; // Mail subject
    $mail->Body = $mg_on_mail; // Mail content
    $mail->send();
}

if (isset($_POST['submit'])) {
    $otp = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit_4'];
    if ($new_time > $expiration_time) {
        $msgcode = "Expired OTP. Please press 'resend'.";
        unset($_SESSION['otpemail']); // Unset OTP if expired
    } elseif ($_SESSION['otpemail'] == $otp) {
        echo "Email validated successfully";
        // Insert freelancer data into the database
        $passhash = password_hash($password, PASSWORD_DEFAULT);
        // $hide=1;
        $insert = "INSERT INTO freelancer VALUES (NULL, '$name', '$email', '$passhash', NULL, '$nationalIDx', '$birthdatey', NULL, '$price_hr', '$availablehr', NULL, '$graduate', '$years_of_xp', '$free_cat',NULL,'$free_subcat','$pin','$count_view')";
        $run_insert = mysqli_query($connect, $insert);
        unset($_SESSION['otpemail']); // Unset OTP after successful validation
        // echo "Registration complete";
        $signup_msg="Welcome to MULTAQA, $name! we are glad to have you here with us. Your security PIN for logging in is $pin 
        please keep this mail incase you forgot your security PIN 
        -MULTAQA TEAM ";
        $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
        $mail->addAddress($email); // Receiver mail address
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to MULTAQA!'; // Mail subject
        $mail->Body = $signup_msg; // Mail content
        $mail->send();
        header("Refresh: 1; url=logF.php");
        exit();
    } else {
        $msgcode = "Incorrect OTP";
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
        <form method="POST" action="signupFotp.php">
            <div class="input-field">
                <input type="text" name="digit1" />
                <input type="text"  name="digit2" disabled />
                <input type="text" name="digit3" disabled />
                <input type="text" name="digit_4" disabled />
            </div>
            <button class=""  type="submit" name="submit">Verify OTP</button>
            <button class="resendBtn" type="submit"  name="resend">Resend OTP</button>
        </form>
        <!-- i added this -->
        <?php if (!empty($msgcode)) { ?>
             <p><?php echo $msgcode; ?></p>
        <?php } ?>
    </div>
    <script src="js/OTP.js"></script>
</body>
</html>