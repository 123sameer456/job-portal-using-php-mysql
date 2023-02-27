<?php require  "../includes/header.php" ; ?>
<?php  require  "../config/config.php" ; ?>

<?php

if(isset($_GET['job_id']) AND isset($_GET['worker_id']) AND isset($_GET['status']) ){
$job_id = $_GET['job_id'];
$worker_id = $_GET['worker_id'];

$insert = "INSERT INTO saved_jobs (job_id , worker_id) VALUES ('$job_id','$worker_id')";
mysqli_query($conn,$insert);

header("location : ".APPURL."/jobs/job-single.php?id=".$job_id."");
} else {
    $delete = "DELETE FROM saved_jobs WHERE id = '$job_id' AND worker_id = '$worker_id'";
    mysqli_query($conn,$delete);
    header("location : ".APPURL."/jobs/job-single.php?id=".$job_id."");
}   

?>
<?php require  "../includes/footer.php" ; ?>
