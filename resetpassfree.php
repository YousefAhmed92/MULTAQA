<?php
//check
include 'connection.php';
$er_msg="";
$freelancer_id=$_SESSION['freelancer_id'];
$emailforgetfr=$_SESSION['emailforgetfr'];
// $client_id=$_SESSION['client_id'];

if(isset($_POST['submit'])){
    //  $emailforgetfr=$_SESSION['emailforgetfr'];
     $password=$_POST['pass'];
     $confirm=$_POST['cpass'];

     $uppercase = preg_match('@[A-Z]@', $password);
     $lowercase = preg_match('@[a-z]@', $password);
     $numbers = preg_match('@[0-9]@', $password);
     $character = preg_match('@[^a-zA-Z0-9]@', $password);

     if(empty($password)||empty($confirm)){
          $er_msg="please fill required data";
     }elseif($password!=$confirm){
          $er_msg="password doesn't match comfirm password";

     }elseif($uppercase<1||$lowercase<1||$numbers<1||$character<1){
          $er_msg="password should contain atleast 1 uppercase,lowercase,numbers or special character";
     }else{
          $hashed=password_hash($password,PASSWORD_DEFAULT);
        //   if($freelancer_id==$_SESSION['freelancer_id']){
            $update="UPDATE `freelancer` SET `password`='$hashed' WHERE `email`='$emailforgetfr'";
            $runupdate=mysqli_query($connect,$update);
            echo "password changed sucessfully1";
            unset($_SESSION['otp']);
            unset($_SESSION['emailforgetfr']);
            header("Refresh: 1; url=logF.php");

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
    <link rel="stylesheet" href="css/resetpass.css">
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
    <div class="container">
        <div class="main">

            <div class="form">
                <h1> Reset Your Password:</h1>

                <br>

                <form action="" method="POST">
                    <input type="password" placeholder="Enter Password" class="input" name="pass">
                    <input type="password" placeholder="Enter confirm Password" class="input" name="cpass">

                    <button class="cssbuttons-io" name="submit">
                        <span>Submit</span>
                    </button>
                </form>
                <?php if(!empty($er_msg)){ ?>
                   <p> <?php echo $er_msg ;?></p>
                <?php } else{}?>

                <!-- <button class="cssbuttons-io">
                    <span>submit</span>
                </button> -->
                
            </div>
            <img class="imgg" src="img/reset.png" alt="">
        </div>
    </div>
</body>

</html>