<?php  require "layout/header.php" ; ?>
<?php  require "../config/config.php" ; ?>
<?php

if(!isset($_SESSION['adminame'])){
  header("location : " . ADMINURL . "/admins/login-admins.php");
}
$jobs = "SELECT COUNT(*) AS count_jobs FROM jobs";
$job = mysqli_query($conn , $jobs);

$counjobs = mysqli_fetch_assoc($job);



$category = "SELECT COUNT(*) AS count_cats FROM categories";
$categories = mysqli_query($conn , $category);

$councategories = mysqli_fetch_assoc($categories);



$admin = "SELECT COUNT(*) AS count_admins FROM admins";
$admins = mysqli_query($conn , $admin);

$counadmins = mysqli_fetch_assoc($admins);

?>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
             
              <h5 class="card-title">Jobs</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of jobs: <?php echo $counjobs['count_jobs'] ; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $councategories['count_cats'] ; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $admins['count_admins'] ; ?></p>
              
            </div>
          </div>
        </div>
      </div>
    
<?php  require "layout/footer.php" ; ?>     