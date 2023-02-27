<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>


<?php

if(!isset($_SESSION['adminame'])){
    header("location : " . ADMINURL . "/admins/login-admins.php");
  }
  
if(isset($_GET['id'])){

    $id = $_GET['id'];
    $delete  =  "DELETE FROM jobs WHERE id = '$id'";
    mysqli_query($conn , $delete);
    header("location :  " . ADMINURL . "/jobs-admins/show-jobs.php");


} else{
    header("location : http://localhost/jobboard/404.php");
}

?>


<?php  require "../layout/footer.php" ; ?>