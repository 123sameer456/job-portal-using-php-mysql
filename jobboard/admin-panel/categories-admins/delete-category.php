<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>


<?php

if(!isset($_SESSION['adminame'])){
    header("location : " . ADMINURL . "/admins/login-admins.php");
  }
  
if(isset($_GET['id'])){

    $id = $_GET['id'];
    $delete  =  "DELETE FROM categories WHERE id = '$id'";
    mysqli_query($conn , $delete);
    header("location :  " . ADMINURL . "/categories-admins/show-categories.php");


} else{
    header("location : http://localhost/jobboard/404.php");
}

?>


<?php  require "../layout/footer.php" ; ?>