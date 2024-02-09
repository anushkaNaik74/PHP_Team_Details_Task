<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team</title>
    <link rel="stylesheet" href="../Styles/team_insert.css">
  </head>
  <body>
  <form method="post" enctype="multipart/form-data">
    <div class="wrapper">
      <div class="form-row">
        <label for="pr_team_name">Team Name</label>
        <input type="text" name="pr_team_name" id="pr_team_name" placeholder="Enter Team Name">
      </div>

      <div class="form-row">
        <label for="pr_team_email">Team Email</label>
        <input type="email" name="pr_team_email" id="pr_team_email" placeholder="Enter Team Email">
      </div>

      <div class="form-row">
        <label for="pr_team_con_1">Team Con1</label>
        <input type="text" name="pr_team_con_1" id="pr_team_con_1" placeholder="Enter Con 1">
      </div>

      <div class="form-row">
        <label for="pr_team_con_2">Team Con2</label>
        <input type="text" name="pr_team_con_2" id="pr_team_con_2" placeholder="Enter Con 2">
      </div>

      <div class="form-row">
        <label for="pr_team_image">Team Image</label>
        <input type="file" name="pr_team_image" id="pr_team_image" >
      </div>

      <div class="form-row">
        <label for="pr_team_dob">Team DOB</label>
        <input type="text" name="pr_team_dob" id="pr_team_dob" placeholder="Enter Team DOB">
      </div>

      <div class="form-row">
        <label for="pr_team_doj">Team DOJ</label>
        <input type="text" name="pr_team_doj" id="pr_team_doj" placeholder="Enter Team DOJ">
      </div>

      <div class="form-row">
        <label for="pr_team_address">Team Address</label>
        <input type="text" name="pr_team_address" id="pr_team_address" placeholder="Enter Team Address">
      </div>

      <div class="form-row">
        <label for="pr_team_desc">Team Desc</label>
        <input type="text" name="pr_team_desc" id="pr_team_desc" placeholder="Enter Team Description">
      </div>

      <div class="form-row">
        <label for="pr_team_status">Team Status</label>
        <input type="number" name="pr_team_status" id="pr_team_status" placeholder="Enter Team Status">
      </div>

      <div class="buttonSubmit">
        <input type="submit" name="submit" value="Submit">
      </div>
    </div>
    <h3>Team Skill Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Team Name</th>
      <th>Team Email</th>
      <th>Team Con1</th>
      <th>Team Con2</th>
      <th>Team Image</th>
      <th>Team DOB</th>
      <th>Team DOJ</th>
      <th>Team Address</th>
      <th>Team Desc</th>
      <th>Team Status</th>
      <th>Operations</th>
    </tr>

    <?php
      $i = 1;
      $select_all_team_query = "SELECT * FROM pr_team";
      $select_all_team_query_sql = mysqli_query($con, $select_all_team_query);
      $count_select_all_team_query = mysqli_num_rows($select_all_team_query_sql);

      if($count_select_all_team_query  > 0){
        while ($row = $select_all_team_query_sql -> fetch_assoc()) {
          $id = $row['pr_team_id'];
    ?>

    <tr>
      <td><?php echo $i++ ?></td>
      <td><?php echo $row['pr_team_name']?></td>
      <td><?php echo $row['pr_team_email']?></td>
      <td><?php echo $row['pr_team_con_1']?></td>
      <td><?php echo $row['pr_team_con_2']?></td>
      <td><?php echo $row['pr_team_image']?></td>
      <td><?php echo $row['pr_team_dob']?></td>
      <td><?php echo $row['pr_team_doj']?></td>
      <td><?php echo $row['pr_team_address']?></td>
      <td><?php echo $row['pr_team_desc']?></td>
      <td><?php echo $row['pr_team_status']?></td>
      <td class="operations">
        <a href="team_update.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
        <a href="team_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
      </td>
    </tr>

    <?php 
        }
      }
    ?>
  </table>

  
  </body>
</html>


<?php

    // Variables to store form data
    $team_name = $team_email = $team_con1 = $team_con2 = $team_image = $team_dob = $team_doj = $team_address = $team_desc = $team_status = '';


    if(isset($_POST['submit'])){

        $team_name              = $_POST['pr_team_name'];
        $team_email             = $_POST['pr_team_email'];
        $team_con1              = $_POST['pr_team_con_1'];
        $team_con2             = $_POST['pr_team_con_2'];
        $team_dob               = $_POST['pr_team_dob'];
        $team_doj               = $_POST['pr_team_doj'];
        $team_address           = $_POST['pr_team_address'];
        $team_desc              = $_POST['pr_team_desc'];
        $team_status            = $_POST['pr_team_status'];


        // File upload handling
            $uploadDir = 'uploads/'; 

        // Check if the directory exists, create it if not
        if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        }
        $uploadedFile = $uploadDir . basename($_FILES['pr_team_image']['name']);

        if (move_uploaded_file($_FILES['pr_team_image']['tmp_name'], $uploadedFile)) {

        // File upload successful, now you can insert data into the database
        $team_image = $_FILES['pr_team_image']['name'];

            // Read the contents of the image file
            $imageData = file_get_contents($uploadedFile);
            $imageData = mysqli_real_escape_string($con, $imageData);

        // Insert data into the database
        $insert_team_query = "INSERT INTO pr_team (
                                pr_team_name, 
                                pr_team_email, 
                                pr_team_con_1, 
                                pr_team_con_2, 
                                pr_team_image,
                                pr_team_dob, 
                                pr_team_doj, 
                                pr_team_address, 
                                pr_team_desc,
                                pr_team_status
                                
                            ) VALUES (
                                '$team_name', 
                                '$team_email', 
                                '$team_con1', 
                                '$team_con2', 
                                '$team_image',
                                '$team_dob',
                                '$team_doj',
                                '$team_address',
                                '$team_desc',
                                '$team_status'
                            )";

        // Execute the SQL query

        if (mysqli_query($con, $insert_team_query)) {
            echo'<script>alert("Team Registered Successfully");</script>';
            header('location: team_insert.php');
        } else {
            echo "Error: " . $insert_team_query . "<br>" . mysqli_error($con);
        }
        } else {
        // File upload failed
        echo "Error uploading file";
        }
        
    }
?>

