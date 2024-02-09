<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");
if (!$con) {
    die('error in con' . mysqli_error($con));
}

$id = $_GET['id'];

// Fetch the image path before deleting the record
$imagePathQuery = "SELECT pr_team_image FROM pr_team WHERE pr_team_id = $id";
$imagePathResult = mysqli_query($con, $imagePathQuery);

if ($imagePathResult && $imagePathRow = mysqli_fetch_assoc($imagePathResult)) {
    $imagePath = $imagePathRow['pr_team_image'];

    // If the file path doesn't start with 'uploads/', prepend it
    if (!preg_match('/^uploads\//', $imagePath)) {
        $imagePath = 'uploads/' . $imagePath;
    }

    // Check if the file exists and delete it
    if (is_file($imagePath)) {
        unlink($imagePath);
    }
}

$delete_team = "DELETE FROM pr_team WHERE pr_team_id = $id";

if (mysqli_query($con, $delete_team)) {
    echo '<script>alert("Team Deleted Successfully");</script>';
    header('location: team_insert.php');
} else {
    echo mysqli_error($con);
}
?>
