<?php
include "mail.php";
$client_id = $_SESSION['client_id'];
//starrrttt
if (!isset($_SESSION['attemptscr'])) {
    $_SESSION['attemptscr'] = 0;
}

// $pin = $_SESSION['pin'];
// $client_id = $_SESSION['client_id'];
// $select_email = "SELECT * FROM `client` WHERE `client_id`='$client_id'";
// $run = mysqli_query($connect , $select_email);
// $emailfetch=mysqli_fetch_assoc($run);
// $emailclient=$emailfetch['email'];

$sel = "SELECT * FROM `client` WHERE `client_id`='$client_id'";
$run = mysqli_query($connect , $sel);
$emailfetch=mysqli_fetch_assoc($run);
$email=$emailfetch['email'];
$pindata1=$emailfetch['pin'];

    
$error = "";
    
    if (isset($_POST['submit'])) {
        // Construct the pin from the form input
        $pin = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit_4'];
    
        // Check if the pin is correct
        if ($pin != $pindata1) {
            $_SESSION['attemptscr']++; // Increment the attempt counter
            $error = "Wrong security number.";
    
            // Check if the number of attempts has reached 3
            if ($_SESSION['attemptscr'] >= 3) {
                $error = "You have entered the Wrong security PIN 3 times. Can't remeber your PIN? click 'send me a mail reminder' .";
                // header("Refresh: ; url=landing.php");
                // header("Location:landing.php");
            }
        } elseif ($pin == $pindata1) {
            // Reset attempts on successful input
            $_SESSION['attemptscr'] = 0;
            header("Location: landing.php");
            exit();
        }
    }
    $PINmsg="Oops, looks like you forgot your Security PIN . No worries your PIN is: $pindata1 
        -  MULLTAQA TEAM";
    if (isset($_POST['send'])) {
        $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA'); // Sender mail address
        $mail->addAddress($email); // Receiver mail address
        $mail->isHTML(true);
        $mail->Subject = 'Security PIN reminder'; // Mail subject
        $mail->Body = $PINmsg; // Mail content
        $mail->send();
        header("Location: security pin client.php");
        exit();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE TITLE -->
    <title>security PIN</title>
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
        <h4>Enter security PIN</h4>
        <form method="POST" action="security pin client.php">
            <div class="input-field">
                <input type="text" name="digit1" />
                <input type="text"  name="digit2" disabled />
                <input type="text"  name="digit3" disabled />
                <input type="text"  name="digit_4" disabled />
            </div>
            <button class=""  type="submit" name="submit">Enter</button>
            <?php  if ($_SESSION['attemptscr'] >= 3) { ?>
                <button type="submit" class="resendBtn" name="send">send me a reminder</button>
            <?php } ?>
        </form>
        <?php if(!empty($error)){ ?>
            <p> <?php echo $error ;?></p>
        <?php } else{}?>

    </div>
    <script src="js/OTP.js"></script>
</body>
</html>