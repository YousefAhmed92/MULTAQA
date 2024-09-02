<?php
require 'connection.php'; 
$client_id = intval($_SESSION['client_id']);
$query = "SELECT `request from freelancer`.`request_id`, 
                 `request from freelancer`.`status`, 
                 `freelancer`.`freelancer_name`, 
                 `project`.`project_id`, 
                 `project`.`project_name`, 
                 `project`.`hours`, 
                 `freelancer`.`price/hour` 
          FROM `request from freelancer`
          JOIN `freelancer` ON `request from freelancer`.`from` = `freelancer`.`freelancer_id`
          JOIN `project` ON `request from freelancer`.`project_id` = `project`.`project_id`
          WHERE `project`.`client_id` = $client_id";

$result = mysqli_query($connect, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

// Handle approval actions
if (isset($_POST['final_approve']) && $_POST['final_approve'] == '1') {
    $request_id = $_POST['request_id'];
    
    $update = "UPDATE `request from freelancer` SET `status` = 'Approved' WHERE `request_id` = '$request_id'";
    $runUpdate = mysqli_query($connect, $update);
    
    if ($runUpdate) {
        $fetchRequest = "SELECT `from`, `project_id` FROM `request from freelancer` WHERE `request_id` = '$request_id'";
        $requestResult = mysqli_query($connect, $fetchRequest);
        $requestData = mysqli_fetch_assoc($requestResult);
        $freelancer_id = $requestData['from'];
        $project_id = $requestData['project_id'];
        
        // Insert the freelancer into the `project_member` table
        $insertProjectMember = "INSERT INTO `project member` (`member_id`, `project_id`,`status`)
                                VALUES ('$freelancer_id', '$project_id' ,'to do')";
        $runInsertProjectMember = mysqli_query($connect, $insertProjectMember);

        if (!$runInsertProjectMember) {
            echo "Error inserting into project_member table: " . mysqli_error($connect);
        } else {
            $insertMessage = "INSERT INTO `freelancer_messages` (`freelancer_id`, `project_id`, `message`)
                              VALUES ('$freelancer_id', '$project_id', 'Your request to work on the project has been approved.')";
            $runInsertMessage = mysqli_query($connect, $insertMessage);
        
            header("Location: agancy.profile.php");
            exit;
        }
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

if (isset($_GET['delete'])) {
    $request_id = $_GET['delete'];
    $delete = "DELETE FROM `request from freelancer` WHERE `request_id` = '$request_id'";
    $runDelete = mysqli_query($connect, $delete);
    if ($runDelete) {
        echo 'Assigned successfully'; 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE NAME -->
    <title>MULTAQA - Approve Request </title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif" />
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
    <link rel="stylesheet" href="css/approve_request.css">
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
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" name="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->


    <form method="post" action="">
        <h2>Approve Request</h2>
        <input type="hidden" name="final_approve" value="1">
        <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($_GET['request_id']); ?>">
        
        <?php
        if (isset($_GET['request_id'])) {
            $request_id = intval($_GET['request_id']);
            $fetchRequest = "SELECT `freelancer`.`freelancer_name`, `project`.`project_name`, `project`.`hours`, `freelancer`.`price/hour`
                             FROM `request from freelancer`
                             JOIN `freelancer` ON `request from freelancer`.`from` = `freelancer`.`freelancer_id`
                             JOIN `project` ON `request from freelancer`.`project_id` = `project`.`project_id`
                             WHERE `request_id` = '$request_id'";
            $requestResult = mysqli_query($connect, $fetchRequest);
            if ($requestResult && mysqli_num_rows($requestResult) > 0) {
                $requestData = mysqli_fetch_assoc($requestResult);
                $freelancer_name = $requestData['freelancer_name'];
                $project_name = $requestData['project_name'];
                $hours = $requestData['hours'];
                $hourly_wage = $requestData['price/hour'];
                $total_salary = $hours * $hourly_wage;
            }
        ?>
        
        <p>Project Name: <input type="text" name="project_name" value="<?php echo htmlspecialchars($project_name); ?>" readonly></p>
        <p>Freelancer Name: <input type="text" name="freelancer_name" value="<?php echo htmlspecialchars($freelancer_name); ?>" readonly></p>
        <p>Hourly Wage: <input type="text" name="hourly_wage" value="<?php echo htmlspecialchars($hourly_wage); ?>" readonly></p>
        <p>Total Salary: <input type="text" name="total_salary" value="<?php echo htmlspecialchars($total_salary); ?>" readonly></p>
        <!-- <button type="submit">Confirm and Send Approval</button> -->
        <button type="submit" class="cssbuttons-io">
                <span>Confirm and Send Approval</span>
        </button>
        <a href="viewrequest.php">Cancel</a>
        <?php } else { ?>
            <p>No request selected for approval.</p>
        <?php } ?>
    </form>
</body>
</html>
