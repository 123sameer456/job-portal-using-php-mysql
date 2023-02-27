<?php require  "config/config.php"; ?>
<?php require  "includes/header.php"; ?>

<?php

if(isset($_POST['submit'])){

    // echo "submitted";

    if(empty($_POST['job-title']) OR empty($_POST['job-region']) OR empty($_POST['job-type'])){
      header("location : " . APPURL . "");
    } else {

        $job_title = $_POST['job-title'];
        $job_region = $_POST['job-region'];
        $job_type = $_POST['job-type'];

        $ins = "INSERT INTO searches (keyword) VALUES ('$job_title')";
        $insert  = mysqli_query($conn, $ins);
        $search = "SELECT * FROM jobs WHERE job_title  LIKE '%$job_title%' AND 
        job_region LIKE '%$job_region%' AND job_type LIKE '%$job_type%' AND status = 1 ";


        $search_r = mysqli_query($conn , $search);
        $searchres = mysqli_fetch_assoc($search_r); 
    }


} else {
    header("location : " . APPURL . "");
}


?>

  <!-- HOME -->
  <section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php  echo APPURL ;?>/images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Search Results for</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php  echo APPURL ;?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Search</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="site-section">
      <div class="container">

        <ul class="job-listings mb-5">
                <?php  if(count($searchres) > 0 ) : ?>
          <?php  foreach($searchres as $one_job) : ?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="<?php echo APPURL ;  ?>/jobs/job-single.php?id= <?php echo $one_job['id'];  ?>"></a>
            <div class="job-listing-logo">
              <img src="users/user-images/<?php echo $one_job['image'] ; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $one_job['job_title'] ;  ?></h2>
                <strong><?php  echo $one_job['username'] ; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php  echo  $one_job['job_region'] ; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($one_job['job_type'] == 'Part Time'){echo 'danger';}else{echo 'success';} ?>"><?php  echo  $one_job['job_type'] ; ?></span>
              </div>
            </div>
            
          </li>

            <br>
              <?php  endforeach ; ?>
              <?php else : ?>
                <div class="alert alert-danger bg-danger text-white">there are no seaches on this job yet</div>
                  <?php endif ; ?>
                        </ul>
                        </div>
</section>
<?php require  "includes/footer.php"; ?>
