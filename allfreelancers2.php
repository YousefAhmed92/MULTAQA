<?php
include("connection.php");

function IncrViewCount($connect){

    if(isset($_POST['incrview'])){
        $freelancer_id = $_POST['view'];
        $_SESSION['id']=$freelancer_id;
        $SelectVcount = "SELECT count_view FROM freelancer WHERE freelancer_id= $freelancer_id ";
        $ExecVcount = mysqli_query($connect, $SelectVcount);
        $data = mysqli_fetch_assoc($ExecVcount);
        $currValue = $data['count_view'];
        $updatedValue = $currValue + 1;
        $UpdateVCount = "update freelancer set count_view= $updatedValue WHERE freelancer_id= $freelancer_id";
        $ExecUpdate = mysqli_query($connect,$UpdateVCount);
        header("Location: viewfreelancerprofile.php?viewprofile=$freelancer_id");
    }
}

if(isset($_POST['send'])){
    $freelancer_id=$_POST['freelancer_id'];
    $_SESSION['free']=$freelancer_id;
    header("location:payment.php");
}

// $client_id = 1;
$client_id = $_SESSION['client_id'];

$select_subcat = "SELECT * FROM freelancer JOIN subcategory ON subcategory.subcategory_id=freelancer.subcategory_id ";
$run_subcat = mysqli_query($connect, $select_subcat);
$subnamefetch= mysqli_fetch_assoc($run_subcat);
$subname=$subnamefetch['sub_name'];


// Fetch categories
$select_cat = "SELECT * FROM `category`";
$run_cat = mysqli_query($connect, $select_cat);

$select_subcat = "SELECT * FROM freelancer JOIN subcategory ON subcategory.subcategory_id=freelancer.subcategory_id ";
$run_subcat = mysqli_query($connect, $select_subcat);
$subnamefetch= mysqli_fetch_assoc($run_subcat);
$subname=$subnamefetch['sub_name'];

// Initialize the base query
$base_query = "SELECT * FROM `freelancer` 
               JOIN `category` ON `category`.`cat_id`=`freelancer`.`cat_id` 
            --    WHERE `freelancer`.`hide` = 1
               ";

// Initialize filter variables
$category_id = '';
$years_of_xp = '';
$available_hours = '';
$price_per_hour = '';
$search_text = '';

// Check if category filter is applied
if (isset($_POST['catbutton'])) {
    $category_id = $_POST['cat'];
}

// Check if experience filter is applied
if (isset($_POST['submit'])) {
    $years_of_xp = $_POST['xps'];
}

// Check if available hours filter is applied
if (isset($_POST['hours'])) {
    $available_hours = $_POST['hours'];
}

// Check if price per hour filter is applied
if (isset($_POST['filter'])) {
    $price_per_hour = $_POST['price'];
}

// Check if search filter is applied
if (isset($_POST['search'])) {
    $search_text = mysqli_real_escape_string($connect, $_POST['text']);
}

// Build the query with the applied filters
$query = $base_query;

if ($category_id) {
    $query .= " AND `freelancer`.`cat_id` = '$category_id'";
}

// if ($years_of_xp) {
//     if ($years_of_xp == 'undergrad') {
//         $query .= " AND `graduate`='undergraduate' AND `year of xp` IN (0, 1, 2,3)";
//     } elseif (in_array($years_of_xp, [0, 1, 2])) {
//         $query .= " AND `graduate`='graduate' AND `year of xp` IN (0, 1, 2)";
//     } elseif (in_array($years_of_xp, [3, 4, 5])) {
//         $query .= " AND `graduate`='graduate' AND `year of xp` IN (3, 4, 5)";
//     } elseif (in_array($years_of_xp, [6, 7, 8, 9])) {
//         $query .= " AND `graduate`='graduate' AND `year of xp` IN (6, 7, 8, 9)";
//     } else {
//         $query .= " AND `graduate`='graduate'";
//     }
// }

if ($years_of_xp) {
    if ($years_of_xp === 'undergrad') {
        $query .= " AND `graduate`='undergraduate' AND `year of xp` BETWEEN 0 AND 3";
    } elseif (in_array($years_of_xp, [0, 1, 2])) {
        $query .= " AND `graduate`='graduate' AND `year of xp` BETWEEN 0 AND 2";
    } elseif (in_array($years_of_xp, [3, 4, 5])) {
        $query .= " AND `graduate`='graduate' AND `year of xp` BETWEEN 3 AND 5";
    } elseif (in_array($years_of_xp, [6, 7, 8, 9])) {
        $query .= " AND `graduate`='graduate' AND `year of xp` BETWEEN 6 AND 50";
    } else {
        $query .= " AND `graduate`='graduate'";
    }
}


// if ($available_hours) {
//     $query .= " AND `available hours per day` >= '$available_hours'";
// }

if ($price_per_hour) {
    $query .= " AND `price/hour` <= '$price_per_hour'";
}

// Add search text to the query
if ($search_text) {
    $query .= " AND (`freelancer_name` LIKE '%$search_text%' OR 
                      `skills` LIKE '%$search_text%' OR 
                      `description` LIKE '%$search_text%')";
}

// Execute the query
$run_filtered = mysqli_query($connect, $query);

$select1 = "SELECT `freelancer_name`, `year of xp`, `available hours per day`, `skills`, `description`, `graduate`, `cat_name`, `price/hour`
            FROM `freelancer`
            JOIN `category` ON `category`.`cat_id`=`freelancer`.`cat_id`";

$runselect1 = mysqli_query($connect, $select1);


if(isset($_POST['search'])){
    $text=$_POST['text'];
    $select_search="SELECT `freelancer_id`,`freelancer_name`, `year of xp`, `available hours per day`, `skills`, `description`, `graduate`, `cat_name`, `price/hour`,`image`
            FROM `freelancer`
            JOIN `category` ON `category`.`cat_id`=`freelancer`.`cat_id` WHERE (`freelancer_name` LIKE '%$text%') 
    or (`price/hour` LIKE '%$text%') or (`description` LIKE '%$text%') or (`cat_name` LIKE '%$text%')
     or (`skills` LIKE '%$text%')or (`graduate` LIKE '%$text%') ";
    $run_select_search= mysqli_query($connect,$select_search);
} else { $run_select1 = mysqli_query($connect, $select1);
}
IncrViewCount($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTAQA - Freelancers</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif">
   <!-- FONT AWESOME LINK -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- FONTS LINK -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@800&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
     <!-- FONT AWESOME LINK -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
     <!-- BOOTSTRAP LINK -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/freelancer page.css">
</head>

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
                        <a class="nav-link" href="agancy.profile.php">Profile</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" name="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="search" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE TITLE STARTS -->
    <div class="title">
        <h1>FREELANCERS</h1>
    </div>
    <!-- PAGE TITLE ENDS -->
     
     <!-- FILTERS START -->
    <div class="allfilters">
        <div class="filter-div"></div>
    <!-- filter1 -->
    <form class="filters-form" method="post" enctype="multipart/form-data">
            <div class="input_box">
                <select name="cat" id="cat" >
                <option selected disabled value="">Category</option>

                <?php foreach ($run_cat as $catdata) { ?>

                    <option value="<?php echo $catdata['cat_id'] ?>" <?php echo ($category_id == $catdata['cat_id']) ? 'selected' : '' ?>>
                    <?php echo $catdata['cat_name'] ?></option>
                    <?php } ?>
                 </select>
               <button class="Submit" type="submit" name="catbutton">Submit Category</button>
            </div>
    </form>

    <!-- filter2 -->
    <form class="filters-form" method="post">
            <div class="input_box">
                <select name="xps" id="xp" >
                    <option selected disabled value="">XP/Grad</option>
                    <option value="1">  <?php echo ($years_of_xp == '0' or $years_of_xp == '1' or $years_of_xp == '2') ? 'selected' : '' ?> 0-2 Grad</option>
                    <option value="3">  <?php echo ($years_of_xp == '3' or $years_of_xp == '4' or $years_of_xp == '5') ? 'selected' : '' ?> 3-5 Grad</option>
                    <option value="6">  <?php echo ($years_of_xp == '6' or $years_of_xp == '7' or $years_of_xp == '8' or $years_of_xp == '9') ? 'selected' : '' ?> 6-10+ Grad</option>
                    <option value="undergrad" <?php echo ($years_of_xp == 'undergrad') ? 'selected' : '' ?>> 0-3 Undergrad</option>
                </select>
               <button class="Submit" type="submit" name="submit">Submit XP/Grad</button>
            </div>
    </form>

    <!-- filter3 -->
    <div class="input_box">
            <form class="filters-form" method="post">
                
                <input type="number" name="price" placeholder="Max price/hour" id="filter3" 
                value="<?php echo htmlspecialchars($price_per_hour); ?>">
            
                <button class="Submit" type="submit" name="filter">Filter Hours/Price</button>
            </form>
    </div>

      </div>
    <!-- end of all filters div -->
    </div>
    <!-- FILTERS END -->

    <!-- MAIN CONTENT STARTS -->

    <?php if(isset($_POST['search'])){ ?>

        <div class="main">
        <!-- CARDS CONTAINER STARTS -->
        <div class="main-container">
            <?php foreach ($run_select_search as $row) { ?>
                <div class="card">
                    <div class="content">
                        <img <?php echo htmlspecialchars($row['image']); ?> alt="">
                        <p class="info"> Name: <?php echo htmlspecialchars($row['freelancer_name']); ?> </p>
                        <p class="info"> Category: <?php echo htmlspecialchars($row['cat_name']); ?> </p>
                        <p class="info"> Sub Category: <?php echo htmlspecialchars($subname); ?> </p>
                        <p class="info"> Skills: <?php echo htmlspecialchars($row['skills']); ?> </p>
                        <p class="info"> Price/Hour: <?php echo htmlspecialchars($row['price/hour']); ?> </p>
                        <p class="info"> Years of Experience: <?php echo htmlspecialchars($row['year of xp']); ?> </p>
                        <p class="info"> Available Hours/Day:
                            <?php echo htmlspecialchars($row['available hours per day']); ?>
                        </p>
                       <div class="card-btns">
                        <form method="post" class="anchor">
                            <button type='submit' class="anchor" name='incrview'> view profile</button>
                            <input type="hidden" name="view" value="<?php echo $row['freelancer_id'] ?>">
                        </form>
                            <a class="anchor"
                            href="payment.php?freelancer_id=<?php echo htmlspecialchars($row['freelancer_id']); ?>">Send Request</a>
                       </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!-- CARDS CONTAINER ENDS -->
    </div>
    

<?php }else{ ?>


    <div class="main">
        <!-- CARDS CONTAINER STARTS -->
        <div class="main-container">
            <?php foreach ($run_filtered as $data) { ?>
                <div class="card">
                    <div class="content">
                        <img <?php echo htmlspecialchars($data['image']); ?> alt="">
                        <p class="info"> Name: <?php echo htmlspecialchars($data['freelancer_name']); ?> </p>
                        <p class="info"> Category: <?php echo htmlspecialchars($data['cat_name']); ?> </p>
                        <p class="info"> Sub Category: <?php echo htmlspecialchars($subname); ?> </p>
                        <p class="info"> Skills: <?php echo htmlspecialchars($data['skills']); ?> </p>
                        <p class="info"> Price/Hour: <?php echo htmlspecialchars($data['price/hour']); ?> </p>
                        <p class="info"> Years of Experience: <?php echo htmlspecialchars($data['year of xp']); ?> </p>
                        <p class="info"> Available Hours/Day:
                            <?php echo htmlspecialchars($data['available hours per day']); ?>
                        </p>
                       <div class="card-btns">
                        <form method="post" >
                            <button type="submit" class="anchor" name='incrview'> view profile</button>
                            <input type="hidden" name="view" value="<?php echo $data['freelancer_id'] ?>">
                        </form>
                        <form method="post" >
                            <button type='submit' class="anchor" name='send'>Send Request</button>
                            <input type="hidden" name="freelancer_id" value="<?php echo $data['freelancer_id'] ?>">
                        </form>
                       </div>
                            
                        <!-- <a class="anchor" href="#">Send Request</a> -->
                    </div>
                </div>
            <?php } ?>

        </div>
        <!-- CARDS CONTAINER ENDS -->
    </div>
    <?php } ?>

    <!-- MAIN CONTENT ENDS -->

    <!-- FOOTER STARTS -->
    <!-- FOOTER ENDS -->

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6j+WxN"
        crossorigin="anonymous"></script>
</body>

</html>