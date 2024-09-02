<?php
include('connection.php');
// $client_id=$_SESSION['client_id'];
// $client_id = 1 ;
// $select= "SELECT *FROM `client` WHERE  `client_id` = $client_id ";
// $run_select= mysqli_query($connect,$select);
// $fetch=mysqli_fetch_assoc($run_select);
$join="SELECT * FROM `client`";
// --  JOIN 
// -- `project` ON `project`.`client_id` = `client`.`client_id` 
// -- WHERE `client`.`client_id`=$client_id 

$run_join = mysqli_query($connect, $join);
// $project_name=$fetch['project_name'];
// $name=$fetch['client_name'];


    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php   foreach($run_join as $data) { ?>
        <div class="card1">
        

            <p>company name : <?php echo $data['client_name'];?></p>
            <p>company name : <?php echo $data['country'];?></p>
            
            <a href="companyprojects2.php?id=<?php echo $data ['client_id']?>">company projects</a>
        
            </div> 
            <?php } ?>

    
</body>
</html>