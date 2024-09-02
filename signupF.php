<?php
include "mail.php";
$result="";
$msgz="";

function validateEgyptianID($nationalID, $birthdate) {
    // Check if the national ID and birthdate are in the correct format

    if(empty($nationalID)||empty($birthdate)){
        $msgz= "Please fill all inputs.";
    }
    if (!preg_match('/^\d{14}$/', $nationalID)) {
        $msgz= "Invalid National ID. It should be 14 digits.";
    }

    // Extract the birthdate part from the national ID
    $century = substr($nationalID, 0, 1);
    $year = substr($nationalID, 1, 2);
    $month = substr($nationalID, 3, 2);
    $day = substr($nationalID, 5, 2);

    // Determine the full year based on the century digit
    if ($century == '2') {
        $fullYear = '19' . $year;
    } elseif ($century == '3') {
        $fullYear = '20' . $year;
    } else {
        return "Invalid century digit in National ID.";
    }

    // Format the extracted date from national ID
    $idBirthdate = $fullYear . '-' . $month . '-' . $day;

    // Compare the extracted birthdate with the provided birthdate
    if ($idBirthdate === $birthdate) {
        $msgz= "The national ID is valid.";
    } else {
        $msgz= "The national ID doesn't match the birthdate.";
    }
}

function Numberic($pin) {
    if (!ctype_digit($pin)) {
         $msgz = "Error: Input must be numeric.";
    }  
}

// Example usage
// $nationalID = '29801012345678'; // Example national ID
// $birthdate = '1998-01-01'; // Example birthdate in YYYY-MM-DD format
$categories="SELECT * FROM category";
$runcategories=mysqli_query($connect, $categories);
// $fetch=mysqli_fetch_assoc($runcategories);
// $cat_id=$fetch['cat_id'];

$subcategories="SELECT * FROM subcategory";
$runsubcategories=mysqli_query($connect, $subcategories);
// $fetchsub=mysqli_fetch_assoc($runsubcategories);
// $catsub_id=$fetch['category_id'];


if(isset($_POST['submit'])){
    //make seesion for each one of them 
    //variable emaill need to be named email
    $nationalIDx = $_POST['NI'];
    $_SESSION['national']=$nationalIDx;

    $birthdatey=$_POST['date'];
    $_SESSION['date']=$birthdatey;

    $name=$_POST['name'];
    $_SESSION['name']=$name;

    $email=$_POST['email'];
    $_SESSION['emailsign']=$email;

    $password=$_POST['password'];
    $_SESSION['password']=$password;

    $cpass=$_POST['cpassword'];
    $_SESSION['cpass']=$cpass;

    // $photo=$_FILES['photo']['name'];
    // $_SESSION['photo']=$photo;

    // $tmpphoto=$_FILES['photo']['tmp_name'];
    // $_SESSION['tmp_photo']=$tmpphoto;

    $price_hr=$_POST['price_hr'];
    $_SESSION['price_hr']=$price_hr;

    $availablehr=$_POST['hr_day'];
    $_SESSION['available']=$availablehr;

    // $skills=$_POST['skills'];
    // $_SESSION['skills']=$skills;

    $years_of_xp=$_POST['experience'];
    $_SESSION['experiences']=$years_of_xp;
    

    $graduate=$_POST['graduate'];
    $_SESSION['graduate']=$graduate;

    $free_cat=$_POST['category'];
    $_SESSION['free_cat']=$free_cat;

    $free_subcat=$_POST['subcategory'];
    $_SESSION['free_subcat']=$free_subcat;

    $pin=$_POST['pin'];
    $_SESSION['pin']=$pin;

    $count_view=$_POST['count_view'];
    $_SESSION['count_view']=$count_view;


    // $dis=$_POST['discription'];
    // $_SESSION['discription']=$dis;

    $select = "SELECT * FROM freelancer WHERE email = '$email'";
    $runsel = mysqli_query($connect , $select);
    $row = mysqli_num_rows($runsel);

    $uppercase=preg_match('@[A-Z]@' ,$password);
    $lowercase=preg_match('@[a-z]@' ,$password);
    $number=preg_match('@[0-9]@' ,$password);
    $character=preg_match('@[^/w]@' ,$password);

    if(empty($name) || empty($password) || empty($email)||empty($nationalIDx)||empty($birthdatey)||empty($cpass)||empty($price_hr)||empty($availablehr)||empty($years_of_xp)||empty($graduate)||empty($free_cat)||empty($free_subcat)||empty($pin)){

        $msgz = "Fill in the requried input please";
        //  fill echo "2";
    }
    elseif($uppercase<1 || $lowercase<1 ||$number<1 ||$character<1 ){
        $msgz = "password must contain atleast 1 uppercase, lowercase, number, special characters";
        // pass req echo 3; 
    }
    
    elseif($row > 0){
        $msgz = "This email already exists";
        //  exist echo 4;
    }
    elseif($password != $cpass){
        $msgz= "Password doesn't match confirm password";
        //  match echo 5;
    }else{
        // $msgz="this sub category isn't included in this category";
        $subcategory_check_query = "SELECT * FROM subcategory WHERE subcategory_id = '$free_subcat' AND category_id = '$free_cat'";
        $subcategory_check_result = mysqli_query($connect, $subcategory_check_query);

        if (mysqli_num_rows($subcategory_check_result) == 0) {
            $msgz = "This subcategory isn't included in the selected category";
        } 
    }

    
 $result = validateEgyptianID($nationalIDx, $birthdatey);
 $numcheck=Numberic($pin);

    if(empty($msgz)){
        header("location:signupFotp.php");
        $rand=rand(1000,9999);

        $msg="wellcome to MULTAQA, to validate your email please enter this PIN : $rand ";
        //expired otp
        // $time=date("H:i:s");
        // $old_time=$time + 60;
        // $_SESSION['old_time']=$old_time;
        // Get current time
    $current_time = new DateTime();

// Clone the current time and add 60 seconds
    $expiration_time = clone $current_time;
    $expiration_time->add(new DateInterval('PT60S')); // PT60S means 60 seconds

// Store both in session
    $_SESSION['current_time'] = $current_time->format('Y-m-d H:i:s');
    $_SESSION['expiration_time'] = $expiration_time->format('Y-m-d H:i:s');


    
              // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
        $mail->setFrom('fatma.said283@gmail.com', 'MULTAQA');          //sender mail address , website name
    
        $mail->addAddress($email);      //reciever mail address
    
        $mail->isHTML(true);                               
    
        $mail->Subject = 'Activation code';             //mail subject
    
        $mail->Body=($msg);                  //mail content
    
        $mail->send(); 
    // php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $_SESSION['otpemail']=$rand;
                $move_photos=move_uploaded_file($tmpphoto,"image/".$photo);
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
    <link rel="stylesheet" href="css/signupF.css">
</head>
<!-- FORM STARTS -->
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

<!-- FORM STARTS -->
 <div class="main-content">
   <div class="main-container">
    <div class="form-title"> Sign Up</div>
    <form method="POST" enctype="multipart/form-data">
        <div class="user_details">
            <div class="input_box">
                <span class="details">Full Name</span>
                <input type="text" placeholder="Enter your name"  name="name">
               
            </div>
            <div class="input_box">
                <span class="details">Email</span>
                <input type="email" placeholder="Enter your Email"  name="email">
            </div>
            <div class="input_box">
                <i class="fa-solid fa-eye" id='showPasswordIcon'  style= 'color: white'></i>
                <span class="details">Password</span>
                <input type="password" id='passwordInput' placeholder="Enter your Password" name="password">
            </div>
            <div class="input_box">
            <i class="fa-solid fa-eye" id='showPasswordIcon'  style= 'color: white'></i>
                <span class="details">Confirm Password</span>
                <input type="password" placeholder="Enter your Password"  name="cpassword">
            </div>
            <div class="input_box">
                <span class="details">available hours</span>
                <input type="tel" placeholder="Enter your available hours"   name="hr_day">
            </div>
            <div class="input_box">
                <span class="details">National ID</span>
                <input type="number" placeholder="Enter your National ID"  name="NI">
            </div>
            <div class="input_box">
                <span class="details">Birth date</span>
                <input type="date"   name="date">
            </div>
            <div class="input_box">
                <span class="details">Years of Experience</span>
                <input type="text" placeholder="Enter the Years of Experience"   name="experience">
            </div>
            <!-- <div class="input_box">
                <span class="details">Profile Picture</span>
                <input type="file"  name="photo">
            </div> -->
            <div class="input_box">
                <span class="details">Price/Hour</span>
                <input type="number" placeholder="Enter The price"  name="price_hr">
                <input type="hidden" name="count_view" value="0">
            </div>
            <div class="input_box">
                <span class="details">Grad/Undergrad</span>
                <select name="graduate" id="2" >
                    <option selected disabled value="">education</option>
                    <option value="graduate"> graduate</option>
                    <option value="under_graduate">under graduate</option>
                </select>
            </div>
            <!-- i added this -->
            <div class="input_box">
                <span class="details">Category</span>
                <select name="category" id="2">
                <option selected disabled value="">select a category</option>
                <?php foreach ($runcategories as $data) { ?>
                    <option value="<?php echo $data['cat_id']?>"> <?php echo $data['cat_name']?> </option>
                <?php }?>
                </select>
                <!-- <select name="category" id="2">
                    <optgroup lable ="designer" value="14">
                   
                        <option name="subcategory" value="7">web design</option>
                        <option name="subcategory" value="8">fashion design</option>
               
                    </optgroup>
                    <optgroup label="developer" value="15">
                        <option  name="subcategory" value="9">web developer</option>
                        <option  name="subcategory" value="10">product developer</option>
          
                    </optgroup>

                </select> -->
                <!-- <select name="category" id="2" >
                    <option selected disabled value="">category</option>
                    <option value="8">voice over</option>
                    <option value="9">data analyst</option>
                    <option value="10">developer</option>
                    <option value="11">marketing analyst</option>
                    <option value="12">designer</option>
                    <option value="13">content creator</option>
                </select> -->
            </div>
            <div class="input_box">
                <span class="details">Subcategory</span>
                    <select name="subcategory" id="2">
                        <option selected disabled value="">select a subcategory</option>

                        <optgroup label ="voice over">
                            <option value="7">voice over</option>
                            <option value="16">voice actor</option>
                        </optgroup>

                        <optgroup label ="developer">
                            <option value="9">backend developer</option>
                            <option value="10">frontend developer</option>
                        </optgroup>

                        <optgroup label="content creator">
                            <option value="11">content creator</option>
                        </optgroup>

                        <optgroup label="analyst">
                            <option value="12">market research analyst</option>
                            <option value="13">financial analyst</option>
                            <option value="14">business intelligence analyst</option>
                        </optgroup>

                        <optgroup label="design">
                            <option value="15">fashion graphic designer</option>
                        </optgroup>

                    </select>  
            </div>
            <div class="input_box">
                <span class="details">Security PIN</span>
                <input type="text" placeholder="Enter a security PIN"  name="pin" maxlength="4">
            </div>
         
        </div>
        <div class="agreement">
            <input type="checkbox" >
            <label class="forget" for="">I agree on all <a id="openTOS" href="#">Terms of Services</a></label>
        </div>
        <div class="info">
            <div class="first">
                <p class="already">I have an account!<a href="logF.php">Log In</a></p>
                <!-- <a href="">Login as agency</a> -->
            </div>
        </div>
        <button type="submit" class="cssbuttons-io" name="submit">
            <span>Submit</span>
        </button>
    </form>
    <?php if (!empty ($msgz)) { ?>
        <p class="zeina"><?php echo $msgz ;?></p>
    <?php } ?>
    <!-- i added this  -->
    <div id="tosPopUp" class="tos-popup">
        <div class="tosContent">
            <i class="fa-solid fa-x close-tos" id="closeTOS"></i>
            <h2>Our Terms Of Service</h2>
            <p>
               A disclaimer of liability for any technical issues between the client and the freelancer if the freelancer does not upIoad the file after the payment transaction. (positive)
            </p>
        </div>
        
        </div>
    </div>
  <div class="image">
        <img src="./img/image final.png" alt="">
    </div>
 </div> 
<!-- FORM ENDS -->


<script src="./js/signup.js"></script>
</body>

</html>