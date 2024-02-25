<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); 

if (!$con) {
    die('error in db' . mysqli_error($con));
}

// Variables to store form data
$team_id = $team_name = $team_email = $team_con1 = $team_con2 = $team_image = $team_dob = $team_doj = $team_address = $team_desc = $team_status = '';


// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_team = "SELECT * FROM pr_team WHERE pr_team_id = $id";
    $run = $con->query($select_team);
    if ($run->num_rows > 0) {
        $row                    = $run->fetch_assoc();
        $team_id                = $row['pr_team_id'];
        $team_name              = $row['pr_team_name'];
        $team_email             = $row['pr_team_email'];
        $team_con1              = $row['pr_team_con_1'];
        $team_con2              = $row['pr_team_con_2'];
        $team_dob               = $row['pr_team_dob'];
        $team_doj               = $row['pr_team_doj'];
        $team_address           = $row['pr_team_address'];
        $team_desc              = $row['pr_team_desc'];
        $team_status            = $row['pr_team_status'];
    }
}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the old image path before updating the record
    $oldImagePathQuery = "SELECT pr_team_image FROM pr_team WHERE pr_team_id = $team_id";
    $oldImagePathResult = mysqli_query($con, $oldImagePathQuery);

    if ($oldImagePathResult && $oldImageRow = mysqli_fetch_assoc($oldImagePathResult)) {
        $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . $oldImageRow['pr_team_image'];

        // Check if a new image is uploaded
        if (!empty($_FILES['pr_team_image']['name'])) {
            $uploadDir = 'uploads/';
            $uploadedFile = $uploadDir . basename($_FILES['pr_team_image']['name']);

            if (move_uploaded_file($_FILES['pr_team_image']['tmp_name'], $uploadedFile)) {
                // File upload successful
                $team_image = $uploadedFile;

                // Check if the old file exists and delete it
                if ($oldImagePath && is_file($oldImagePath)) {
                    if (unlink($oldImagePath)) {
                        echo "Old image deleted successfully.";
                    } else {
                        echo "Failed to delete old image.";
                    }
                } else {
                    echo "Old image path does not exist or is not a file.";
                }
            } else {
                // File upload failed
                echo "Error uploading file";
            }
        } else {
            // No new image uploaded, use the existing one
            $team_image = $oldImageRow['pr_team_image'];
        }

        // Retrieve other form fields
        $team_name              = $_POST['pr_team_name'];
        $team_email             = $_POST['pr_team_email'];
        $team_con1              = $_POST['pr_team_con_1'];
        $team_con2              = $_POST['pr_team_con_2'];
        $team_dob               = $_POST['pr_team_dob'];
        $team_doj               = $_POST['pr_team_doj'];
        $team_address           = $_POST['pr_team_address'];
        $team_desc              = $_POST['pr_team_desc'];
        $team_status            = $_POST['pr_team_status'];

        // Update data in the database
        $update_team = "UPDATE pr_team SET 
                                    pr_team_name    = '$team_name', 
                                    pr_team_email   = '$team_email', 
                                    pr_team_con_1   = '$team_con1', 
                                    pr_team_con_2   = '$team_con2', 
                                    pr_team_image   = '$team_image', 
                                    pr_team_dob     = '$team_dob',
                                    pr_team_doj     = '$team_doj',
                                    pr_team_address = '$team_address',
                                    pr_team_desc    = '$team_desc',
                                    pr_team_status  = '$team_status'
                                WHERE pr_team_id    = '$team_id'";

        // Execute the SQL query
        if (mysqli_query($con, $update_team)) {
            echo '<script>alert("User Registered Successfully");</script>';
            header('location: team_insert.php');
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "Error fetching old image path.";
    }
}

?>



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
    <input type="hidden" name="pr_team_id" value="<?php echo $team_id; ?>">
      <div class="form-row">
        <label for="pr_team_name">Team Name</label>
        <input type="text" name="pr_team_name" id="pr_team_name" placeholder="Enter Team Name" value="<?php echo $team_name; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_email">Team Email</label>
        <input type="email" name="pr_team_email" id="pr_team_email" placeholder="Enter Team Email" value="<?php echo $team_email; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_con_1">Team Con1</label>
        <input type="text" name="pr_team_con_1" id="pr_team_con_1" placeholder="Enter Con 1" value="<?php echo $team_con1; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_con_2">Team Con2</label>
        <input type="text" name="pr_team_con_2" id="pr_team_con_2" placeholder="Enter Con 2" value="<?php echo $team_con2; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_dob">Team DOB</label>
        <input type="text" name="pr_team_dob" id="pr_team_dob" placeholder="Enter Team DOB" value="<?php echo $team_dob; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_doj">Team DOJ</label>
        <input type="text" name="pr_team_doj" id="pr_team_doj" placeholder="Enter Team DOJ" value="<?php echo $team_doj; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_address">Team Address</label>
        <input type="text" name="pr_team_address" id="pr_team_address" placeholder="Enter Team Address" value="<?php echo $team_address; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_desc">Team Desc</label>
        <input type="text" name="pr_team_desc" id="pr_team_desc" placeholder="Enter Team Description" value="<?php echo $team_desc; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_status">Team Status</label>
        <input type="number" name="pr_team_status" id="pr_team_status" placeholder="Enter Team Status" value="<?php echo $team_status; ?>">
      </div>

      <div class="buttonSubmit">
        <input type="submit" name="update" value="Update">
      </div>
    </div>
  
  </body>
</html>