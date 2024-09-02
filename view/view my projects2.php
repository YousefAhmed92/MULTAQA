<?php
include('connection.php');

// Retrieve project details for the logged-in freelancer
$freelancer_id = 3 ; // Assume freelancer ID is stored in session

// Query to get project details where the freelancer is a member
$query = "SELECT * FROM `projectmembers` JOIN `project` ON `projectmembers`.`project_id` = `project`.project_id 
          JOIN `category` ON `projectmembers` . `category` = `category` . `cat_id`
            WHERE `projectmembers`.`member_id` = '$freelancer_id'"; 

$result = mysqli_query($connect, $query);

// Close the database connection
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- WEBSITE NAME -->
    <title>MULTAQA</title>
    <!-- WEBSITE LOGO -->
    <link rel="icon" href="img/logo.jfif" />
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/view my projects.css">
</head>

<body>
    <div class="main">
        <div class="title">
            <h1>MY PROJECTS</h1>
        </div>

        <div class="body">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="card">
            <h2>Project Name:</h2>
            <td><p><?php echo htmlspecialchars($row['project_name']); ?></p></td>
            <br>
            <h2>Description:</h2>
            <td><p><?php echo htmlspecialchars($row['descriptionP']); ?></p></td>
                
                <br>
                <h2>project category:</h2>
                <td><p><?php echo htmlspecialchars($row['cat_name']); ?></p></td>
                <a href="team.project.details.php?project_id=<?php echo $row['project_id']?>"><span class="read">Read More Details</span></a>
                <div class="input-container">
                <label for="file" class="input-label"> Upload File:
                </label>
                <input type="file" id="file" class="input file-input">
                </div>
            </div>
            <?php } ?>

            <!-- <div class="card">
            <h2>Project Name</h2>
            <p>cars website</p>
                <br>

                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>

                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div> -->
            <!-- <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div>
            <div class="card">
                <h2>Freelancer Name</h2>
                <p>ziad sherif</p>
                <br>
                <h2>Hours</h2>
                <p>8 Hours</p>
                <br>
                <h2>Project Name</h2>
                <p>cars website</p>
                <br>
                <h2>Description</h2>
                <p class="dscription">i need some one to design me a website about the cars and i need him to know about
                    the css and javascript and html</p>
                <br>
                <a href=""><span>Read More Details</span></a>
            </div> -->
        </div>
    </div>
</body>

</html>