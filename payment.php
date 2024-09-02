<?php
require 'connection.php';

$freelancer_id = '';
$freelancer_name = '';
$freelancer_price_per_hour = 0; 
$project_result = null;
$success_message = '';

$freelancer_id=$_SESSION['free'];


if (!empty($_SESSION['free'])) {
    // $freelancer_id = $_GET['freelancer_id'];
    // $freelancer_id=$_SESSION['free'];
    $_SESSION['free']=$freelancer_id;



    $freelancer_query = "SELECT freelancer_name, `price/hour`, graduate FROM freelancer WHERE freelancer_id = '$freelancer_id'";
    $freelancer_result = mysqli_query($connect, $freelancer_query);

    if ($freelancer_result) {
        $freelancer_row = mysqli_fetch_assoc($freelancer_result);
        $freelancer_name = $freelancer_row['freelancer_name'];
        $freelancer_price_per_hour = $freelancer_row['price/hour']; 
        $graduate_status = $freelancer_row['graduate']; 

        if ($graduate_status == "under_graduate") {
            $freelancer_price_per_hour *= 0.8; 
        }

    } else {
        $success_message = "Error retrieving freelancer details: " . mysqli_error($connect);
    }

    if (isset($_SESSION['client_id'])) {
        $client_id = $_SESSION['client_id'];

        $project_query = "SELECT project_id, project_name, hours FROM project WHERE client_id = '$client_id'";
        $project_result = mysqli_query($connect, $project_query);

        if (!$project_result) {
            $success_message = "Error retrieving projects: " . mysqli_error($connect);
        }
    } else {
        $success_message = "Client not logged in.";
    }
} else {
    $success_message = "Invalid freelancer ID.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $freelancer_id = $_POST['freelancer_id'];
    $project_id = $_POST['project_id'];
    $status = "pending";

    $insert_query = "INSERT INTO `request from client` (status, `from`, `to`, project_id) 
                    VALUES ('$status',' $client_id', '$freelancer_id', '$project_id')";

    if (mysqli_query($connect, $insert_query)) {
        $success_message = "Project assigned successfully!";
    } else {
        $success_message = "Error: " . $insert_query . "<br>" . mysqli_error($connect);
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
    <link rel="icon" href="img/logo.jfif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
       function updateTotalAmount() {
    var select = document.getElementById('project');
    var selectedOption = select.options[select.selectedIndex];
    var hours = selectedOption.getAttribute('data-hours');
    var priceperhour = <?php echo json_encode($freelancer_price_per_hour); ?>; 
    var promoCode = document.getElementById('promo_code').value.trim(); 
    if (promoCode == "1223") {
        priceperhour *= 0.8;
    }

    if (hours) {
        var totalAmount = hours * priceperhour;
        var message = "If the freelancer <?php echo htmlspecialchars($freelancer_name); ?> accepts your request, it will be transferred $" + totalAmount.toFixed(2) + " to their account.";
        document.getElementById('amount_message').innerText = message;
    } else {
        document.getElementById('amount_message').innerText = 'Please select a project to see the amount.';
    }
}

    </script>
    <!-- CSS LINK  -->
     <link rel="stylesheet" href="css/payment.css">
</head>
<body>

<?php if ($success_message): ?>
    <div class="message">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<nav id="NAV" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scrolled">
    <div class="container">
        <img src="img/image.png" alt="">
        <a class="navbar-brand" href="#">MULTAQA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-4">
                    <a class="nav-link active" aria-current="page" href="landing.php">Landing</a>
                </li>
                <li class="nav-item mx-4">
                    <a class="nav-link" href="agancy.profile.php">Profile</a>
                </li>
                <li class="nav-item mx-4">
                    <a class="nav-link" href="allfreelancers2.php">Freelancers</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="title">
    <p>Payment</p>
</div>
<div class="main-container">
    <div class="headers">
        <div class="formdiv">
            <form action="payment.php?freelancer_id=<?php echo htmlspecialchars($freelancer_id); ?>" method="POST">
                <h2>Assign Project to <?php echo htmlspecialchars($freelancer_name); ?></h2>
                <input type="hidden" class="input-box" name="freelancer_id" value="<?php echo htmlspecialchars($freelancer_id); ?>">
                <br>

                <label for="freelancer_name">Freelancer Name:</label>
                <input type="text" class="input-box" name="freelancer_name" value="<?php echo htmlspecialchars($freelancer_name); ?>" readonly>
                <br>

                <label for="project">Select Project:</label>
                <select id="project" name="project_id" onchange="updateTotalAmount()">
                    <option value="">Select a project</option>
                    <?php while ($project = mysqli_fetch_assoc($project_result)) { ?>
                        <option value="<?php echo htmlspecialchars($project['project_id']); ?>" data-hours="<?php echo htmlspecialchars($project['hours']); ?>">
                            <?php echo htmlspecialchars($project['project_name']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br>

                <label for="promo_code">Promo Code:</label>
                <input type="text" id="promo_code" class="input-box" placeholder="Enter Promo Code" onchange="updateTotalAmount()">
                <br>

                <label for="Credit Card">Credit Card:</label>
                <input class="input-box" type="number" placeholder="Enter Your Credit Card" id="CC" required>
                <br>

                <div id="amount_message" class="message">
                    Please select a project to see the amount.
                </div>
                <br>

<button class="cssbuttons-io" name="btn">
          <span>assign</span>
      </button>            </form>
        </div>
    </div>
    <div class="form-img">
        <img src="img/Cash Payment-bro.png" alt="">
    </div>
</div>



















<footer class="text-center text-lg-start bg-body-tertiary text-muted" style="width: 100%; background-color: transparent !important; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.047) !important; left: 13.79%; bottom: -70%;">
    <!-- <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <div>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-facebook-f" style="color: white !important"></i>
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
    </section> -->
     <!-- start footer -->
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
              We’re thrilled to have you here. Whether you're a talented freelancer looking to showcase your skills or a
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
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center" style="color: white !important;">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-center">Contact</h6>
            <div class="footerLinks d-flex flex-md-column justify-content-center align-items-center flex-sm-row">
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

  <!-- end footer -->