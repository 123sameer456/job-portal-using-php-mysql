<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>


<?php

if(!isset($_SESSION['adminame'])){
    header("location : " . ADMINURL . "/admins/login-admins.php");
  }
  
if(isset($_GET['id']) AND isset($_GET['status'])){

    $id = $_GET['id'];
    $status =$_GET['status'] ;

    if($status == 1){
        $update  =  "UPDATE jobs SET status= 0 WHERE id = '$id'";
        mysqli_query($conn , $update);
        header("location :  " . ADMINURL . "/jobs-admins/show-jobs.php");
    

    } else {
        $update  =  "UPDATE jobs SET status= 1 WHERE id = '$id'";
        mysqli_query($conn , $update);
        header("location :  " . ADMINURL . "/jobs-admins/show-jobs.php");
    
    }
   

} else{
    header("location : http://localhost/jobboard/404.php");
}

?>


<?php  require "../layout/footer.php" ; ?>