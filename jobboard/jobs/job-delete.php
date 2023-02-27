<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if(isset($_SESSION['type']) AND $_SESSION['type'] !== "Company" ) {
    echo "<script>window.location.replace('http://localhost/jobboard');</script>";
  }
    

if(isset($_GET['id'])){


    $id = $_GET['id'];

    $delete = "DELECT FROM jobs WHERE id = $id";
    mysqli_query($conn,$delete);

    
echo "<script>window.location.replace('http://localhost/jobboard');</script>" ;
}else{
    echo "404";
}

?>
<?php require "../includes/footer.php"; ?>