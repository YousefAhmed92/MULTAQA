<?php
include("connection.php");
// $freelancer_id=16;
$freelancer_id = $_SESSION['freelancer_id'];

$select_edit = "SELECT * FROM `freelancer` LEFT JOIN `sample` ON `sample`.`freelancer_id`=`freelancer`.`freelancer_id` 
LEFT JOIN `link` ON `link`.`freelancer_id`=`freelancer`.`freelancer_id`  WHERE `freelancer`.`freelancer_id` = '$freelancer_id'";
$runedit = mysqli_query($connect, $select_edit);
$fetch = mysqli_fetch_assoc($runedit);
$freelancer_name=$fetch['freelancer_name'] ;
$email=$fetch['email'];
$image=$fetch['image'];
$price=$fetch['price/hour'];
$years=$fetch['year of xp'];
$HoursPerDay=$fetch['available hours per day'];
$skills=$fetch['skills'];
$graduate=$fetch['graduate'];
// $description=$fetch['description'];
$sample=$fetch['sample_name'];
$link=$fetch['link'];

$disfinal = "SELECT * FROM `freelancer` WHERE `freelancer_id` = '$freelancer_id'";
$run_final = mysqli_query($connect, $disfinal);
$fetch=mysqli_fetch_assoc($run_final);
$finaldistrial=$fetch['description'];



if (isset($_POST['update'])) {
    $freelancer_name = $_POST['freelancer_name'];
    $edit_email = $_POST['email'];
    $pricee = $_POST['price/hour'];
    $HoursPerDay = $_POST['available_hours_per_day'];
    $skills = $_POST['skills'];
    $graduate = $_POST['graduate'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $years = $_POST['years'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $temp_name = $_FILES['image']['tmp_name'];
        $image = $_FILES['image']['name'];
        $uploadfile = "./img/" . $image;

        if (move_uploaded_file($temp_name, $uploadfile)) {
            // Success
        } else {
            // Handle upload error
            echo "Failed to upload file.";
            $image = $fetch['image']; // Preserve the old image if upload fails
        }
    } else {
        $image = $fetch['image']; // Preserve the old image if no new image was uploaded
    }

    $updateQuery = "UPDATE `freelancer` SET `freelancer_name`='$freelancer_name', 
                    `email`='$edit_email', `image`='$image', `price/hour`='$pricee', 
                    `available hours per day`='$HoursPerDay',`year of xp`='$years', `skills`='$skills', 
                    `graduate`='$graduate', `description`='$description'
                    WHERE `freelancer_id`='$freelancer_id'";
    
    $runupdate = mysqli_query($connect, $updateQuery);
    
    if (!$runupdate) {
        die("Error: " . mysqli_error($connect));
    }

    // Update link table
    $updateLink = "INSERT INTO `link` (`link_id`, `link`, `freelancer_id`) VALUES (NULL, '$link', '$freelancer_id')";
    mysqli_query($connect, $updateLink);

    header("Location: freelancer.profile.php");
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
    <link rel="stylesheet" href="css/editprofileF.Css">
</head>

<body>
     <div class="container">
        <div class="mid">
            <div class="title">Update Profile</div>
            <form method="post" enctype="multipart/form-data">

            <div class="user_details">
                <div class="input-container ic1">
                    <label for="name" class="input-label">Name</label>
                    <input id="name" class="input" type="text" placeholder="Enter your name"  name="freelancer_name"
                    value="<?php echo $freelancer_name; ?>">
                </div>
                <div class="input-container ic2">
                    <label for="email" class="input-label">E-mail</label>
                    <input id="email" class="input" type="email" placeholder="Enter your email"  name="email"
                    value="<?php echo $email; ?>">
                </div>
                <div class="input-container ic1">
                    <label for="file" class="input-label">Upload your photo</label>
                    <input type="file" id="file" class="input file-input" name="image" value="<?php echo $image ; ?>" >
                </div>
                <!-- <div class="input-container ic2">
                    <label for="description" class="input-label">Description</label>
                    <textarea id="description" class="input textarea" placeholder="Enter a brief description" name="description"  value="<?php echo $finaldistrial ; ?>" > <?php echo $finaldistrial ; ?></textarea>
                </div> -->
                <div class="input-container ic2">
                    <label for="price" class="input-label">Price/hour</label>
                    <input id="price" class="input" type="number" placeholder="Enter price per hour" name="price/hour"  
                    value="<?php echo $price ; ?>">
                </div>
                <div class="input-container ic2">
                    <label for="HoursPerDay" class="input-label">Available hours per day</label>
                    <input id="HoursPerDay" class="input" type="number" placeholder="Enter available hours per day " name="available_hours_per_day"  
                    value="<?php echo $HoursPerDay ; ?>">
                </div>
                
                <div class="input-container ic2">
                    <label for="HoursPerDay" class="input-label">Years Of Experience</label>
                    <input id="HoursPerDay" class="input" type="number" placeholder="Enter years of experience " name="years"  
                    value="<?php echo $years ; ?>">
                </div>

                <div class="input-container ic2">
                    <label for="skills" class="input-label">Skills</label>
                    <input id="skills" class="input" type="text" placeholder="Enter your skills" name="skills"  
                    value="<?php echo $skills ; ?>">
                </div>
                <div class="input-container ic2">
                    <label for="graduate" class="input-label">Graduate</label>
                    <!-- <input id="projects" class="input" type="list" placeholder="graduate" name="graduate"
                    value=""> -->
                    <select name="graduate" id="2">
                    <option selected="" disabled="" value=" <?php echo $graduate ; ?>">  your education now: <?php echo $graduate ; ?></option>
                    <option value="graduate">Graduate</option>
                    <option value="undergraduate">Under Grad</option>
                    </select>
                </div>
                <div class="input-container ic2">
                    <label for="link" class="input-label">Link</label>
                    <input id="link" class="input" type="text" placeholder="Enter hours of project" value="<?php echo $link ; ?>" >
                </div>
<!--                 <div class="input-container ic2">
                    <label for="description" class="input-label">Description</label>
                    <textarea id="description" class="input-desc" placeholder="Enter a brief description" name="description" >Add a description to your profile</textarea>
                </div> -->
            </div>

                <button class="cssbuttons-io" name="update" type="submit">
                    <span>Update</span>
                </button>
            </form>
        </div>
    </div>
</body>

</html>
