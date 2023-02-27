<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>

<?php
if(!isset($_SESSION['adminame'])){
  header("location : " . ADMINURL . "/admins/login-admins.php");
}

if(isset($_POST['submit'])){
  if(empty($_POST['name'])){
    echo "<script>alert('input are missing');</script>";
  } else {
    $name = $_POST['name'];
    $insert = "INSERT INTO categories (name) VALUES ('$name')";
    mysqli_query($conn , $insert);

header("location : ". ADMINURL. "/categories-admins/show-categories.php");

  }
}

?>


       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php" >
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>

      <?php  require "../layout/footer.php" ; ?>