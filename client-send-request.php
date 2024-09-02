<?php
include('connection.php');

$freelancer_id = $_SESSION['freelancer_id'];

if (isset($_POST['action']) && $_POST['action'] == 'reject') {
    $request_id = $_POST['request_id'];

        
    $delete = "DELETE FROM `request from client` WHERE `request from client_id` = '$request_id'";
    $runDelete = mysqli_query($connect, $delete);

    header("location:client-send-request.php");

}
// Initialize a message variable
$message = '';

// Process form submission for Accept/Reject
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['request_id']) && isset($_POST['action'])) {
        $request_id = $_POST['request_id'];
        $action = $_POST['action'];
        
        if ($action === 'accept') {
            // Retrieve details for the request
            $details_query = "
                SELECT 
                    c.`client_name`, 
                    p.`project_name`, 
                    f.`freelancer_id`, 
                    r.`project_id`,
                    (f.`price/hour` * p.`hours`) AS `total_price`
                FROM `request from client` r
                JOIN `freelancer` f ON `r`.`to` = f.freelancer_id
                JOIN `project` p ON `r`.`project_id` = `p`.`project_id`
                JOIN `client` c ON `r`.`from` = `c`.`client_id`
                WHERE `r`.`request from client_id` = '$request_id'
            ";
            $details_result = mysqli_query($connect, $details_query);
            if ($details_result) {
                $details = mysqli_fetch_assoc($details_result);
                
                $client_name = $details['client_name'];
                $project_name = $details['project_name'];
                $freelancer_id = $details['freelancer_id'];
                $project_id = $details['project_id'];
                $total_price = $details['total_price'];

                // Insert into `project member` table
                $project_details_query = "
                    INSERT INTO `project member` (`member_id`, `project_id`,`status`) 
                    VALUES ('$freelancer_id', '$project_id' ,'to do')"; // Adjust 'Category' as needed
                $insert_result = mysqli_query($connect, $project_details_query);

                // Insert message into `agency_messages` table
                $message_content = "Freelancer has accepted your project. {$project_name} , and {$total_price} dollar has been transferred to the freelancer's account.";
                $message_content = mysqli_real_escape_string($connect, $message_content);
                
                $message_query = "
                    INSERT INTO `agency_messages` (id, message) 
                    VALUES (NULL, '$message_content')
                ";
                mysqli_query($connect, $message_query);

                $update_status="UPDATE `request from client` SET `status`='yes' WHERE
                `request from client_id` = '$request_id'";
                $run_update_status=mysqli_query($connect,$update_status);
                

                if ($insert_result) {
                    echo 'doneeeeee' ;
                } else {
                    $message = 'Failed to insert data.';
                }
            } else {
                $message = 'Failed to retrieve details.';
            }
        }


        header("location:client-send-request.php");

        // Handle the reject action if needed
    }
    // header("location:client-send-request.php");

}

$query = "
    SELECT DISTINCT
        c.`client_name`, 
        p.`project_name`, 
        p.`hours`,
        f.`price/hour` , 
        (f.`price/hour` * p.`hours`) AS `total_price`,
        `r`.`request from client_id` AS `request from client_id`
    FROM `request from client` r
    JOIN `freelancer` f ON `r`.`to` = `f`.`freelancer_id`
    JOIN `project` p ON `r`.`project_id` = `p`.`project_id`
    JOIN `client` c ON `r`.`from` = `c`.`client_id`
    JOIN `request from client` ON `request from client`.`from`=`c`.`client_id`
    WHERE `r`.`status`='pending'";

$result = mysqli_query($connect, $query);

mysqli_close($connect);

// $request_id = $_POST['request_id'];
        
        

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <style></style> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSIT NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif">
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/freelance interface.css">
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
                        <a class="nav-link active" aria-current="page" href="landing.php">Landing</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="freelancer.profile.php">Profile</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="agencies.php">Agencies</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV BAR ENDS -->

    <!-- PAGE CONTENT STARTS -->
    <div class="main">
        <h1>My Requests</h1>

        <!-- TABLE STARTS -->
        <div class="table">
            <table>
            <tr>
                    <td><h3>Agency Name</h3></td>
                    <td><h3>Project Name</h3></td>
                    <td><h3>Project Hours</h3></td>
                    <td><h3>Messages</h3></td>
                    <td><h3>Action</h3></td>
                </tr>

                <!--####################################################-->
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><p><?php echo htmlspecialchars($row['client_name']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['project_name']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['hours']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['client_name']) . " has offered you $" . number_format($row['total_price'], 2) . " dollars"; ?></p></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request from client_id']); ?>">
                                <button type="submit" name="action" value="accept">Accept</button>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <!-- TABLE ENDS -->
        </div>
    </div>
    <!-- PAGE CONTENT ENDS -->

    <!-- FOOTER STARTS -->
    <footer class="text-center text-lg-start bg-body-tertiary text-muted" style=" width: 100%;  background-color: transparent !important;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.047)  !important;
    left: 13.79%; bottom: -70%;">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <!-- <div class="me-5 d-none d-lg-block" style="color: white !important;">
                        <span>Get connected with us on social networks:</span>
                    </div> -->
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f" style="color: white !important" ;></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter" style="color: white !important;"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google" style="color: white !important;"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram" style="color: white !important;"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin" style="color: white !important;"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github" style="color: white !important;"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase text-center fw-bold mb-4" style="color: #5C8374 !important;">
                            <i class="fas fa-gem me-3" style="color:black !important;"></i>MULTAQA
                        </h6>
                        <p class="text-center" style="color: white;">
                            We’re thrilled to have you here. Whether you're a talented freelancer looking to showcase
                            your skills or a
                            client seeking the perfect expert for your next project, you’ve come to the right place.


                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4" style="color: white !important;">
                        <!-- Links -->
                        <h6 class="text-uppercase text-center fw-bold mb-4">
                            Navigation Links
                        </h6>
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
                            <p>
                                <a href="#!" class="text-reset">Home</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">About</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Services</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Portfolio</a>
                            </p>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" style="color: white !important;">
                        <!-- Links -->
                        <h6 class="text-center `text-uppercase fw-bold mb-4">
                            Legal Information
                        </h6>
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
                            <p>
                                <a href="#!" class="text-reset">Privacy Policy</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Terms of service</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Cookie Policy</a>
                            </p>

                        </div>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center"
                        style="color: white !important;">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4 text-center">Contact</h6>
                        <div
                            class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
                            <p><i class="fas fa-home me-3"></i> Egypt</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                MULTAQA@gmail.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>

                        </div>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="color: white !important;">

        </div>
        <!-- Copyright -->
    </footer>
    <!-- FOOTER ENDS -->
</body>

</html>









<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTAQA</title>
    <link rel="icon" href="img/logo.jpeg">
    <link rel="stylesheet" href="css/messages.css">
</head>
<body>
    <div class="main">
        <h1>Your Messages</h1>
        
        <?php if ($message): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="table">
            <table>
                <tr>
                    <td><h3>Agency Name</h3></td>
                    <td><h3>Project Name</h3></td>
                    <td><h3>Project Hours</h3></td>
                    <td><h3>Messages</h3></td>
                    <td><h3>Action</h3></td>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><p><?php echo htmlspecialchars($row['client_name']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['project_name']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['hours']); ?></p></td>
                        <td><p><?php echo htmlspecialchars($row['client_name']) . " has offered you $" . number_format($row['total_price'], 2) . " dollars"; ?></p></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                <button type="submit" name="action" value="accept">Accept</button>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html> -->
