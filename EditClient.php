<?php
include("connection.php");
$client_id=$_SESSION['client_id'];
$select_edit = "SELECT * FROM client WHERE client_id = '$client_id'";
$runedit = mysqli_query($connect, $select_edit);
$fetch = mysqli_fetch_assoc($runedit);
$client_name=$fetch['client_name'] ;
$email=$fetch['email'];
$drive=$fetch['drive'];
$country=$fetch['country'];
$phone_no=$fetch['phone_no'];
$discription=$fetch['business_descroption'];


if(isset($_POST['update'])){
    $client_name = $_POST['client_name'];
    $edit_email = $_POST['email'];
    $drive = $_POST['drive'];
    $country=$_POST['country'];
$phone_number=$_POST['phone_no'];
$discription=$_POST['description'];



    $update = "UPDATE client SET client_name='$client_name' ,  email='$edit_email' , `drive`='$drive',
    country='$country',phone_no='$phone_number',business_descroption='$discription' WHERE client_id = '$client_id'";
    $runupdate = mysqli_query($connect , $update);
    header("location:agancy.profile.php");
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
    <link rel="stylesheet" href="css/editprofileA.css">
</head>

<body>
    <form method="post">
    <div class="container"> 
        <div class="mid">
            <div class="title">Edit Profile</div>
            <div class="input-container ic1">
                <input class="input" type="text" placeholder="Name" name="client_name"
                value="<?php echo $client_name ; ?>"/>
            </div>
            <div class="input-container ic2">
                <input class="input" type="text" placeholder="E-mail" name="email" 
                value="<?php echo $email ; ?>"/>
            </div>
            <div class="input-container ic2">
                <input class="input" type="text" placeholder="Drive Link" name="drive" 
                value="<?php echo $drive ; ?>"/>
            </div>
            <div class="input-container ic2">
            <!-- try select to countries -->
                <select name="country" class="input">
                    <option selected disabled value="">your country now: <?php echo $country ; ?> </option>
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

            <div class="input-container ic2">
                <input class="input" type="text" placeholder="Contact Number" name="phone_number" 
                value="<?php echo $phone_no ; ?>"/>
            </div>
            <div class="input-container ic2">
                <input class="input" type="text" placeholder="Business Description" name="description"
                value="<?php echo $discription ; ?>"/>
            </div>
            <button class="cssbuttons-io" name="update">
                <span>Update</span>
            </button>
        </div>
    </div>
    </form>
</body>

</html>
