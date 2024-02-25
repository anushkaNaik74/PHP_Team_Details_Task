<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");
if (!$con) {
    die('error in con' . mysqli_error($con));
}

$id = $_GET['id'];



$delete_team = "DELETE FROM pr_team WHERE pr_team_id = $id";

if (mysqli_query($con, $delete_team)) {
    echo '<script>alert("Team Deleted Successfully");</script>';
    header('location: team_insert.php');
} else {
    echo mysqli_error($con);
}
?>
