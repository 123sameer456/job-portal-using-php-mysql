<?php require  "../includes/header.php" ; ?>
<?php  require  "../config/config.php" ; ?>


<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];

// getting single job info
  $select = "SELECT * FROM jobs WHERE id = '$id'";
  $result = mysqli_query($conn,$result);
  $row_single = mysqli_fetch_assoc($result);

// getting related jobs
  $rel_row = $row_single['job_category'] ;
  $related_job ="SELECT * FROM jobs WHERE job_category = $rel_row AND status = 1 AND id != '$id'  ";
  $related_result = mysqli_query($conn,$related_job);
  $related_row = mysqli_fetch_assoc($related_result);

  // getting the count of related jobs
  $count_job ="SELECT COUNT(*) as job_count FROM jobs WHERE job_category = $rel_row AND status = 1 AND id != '$id'  ";
  $count_result = mysqli_query($conn,$count_job);
  $count_row = mysqli_fetch_assoc($count_result);

 
} else {
  header("location :" . APPURL .  "/404.php");
}
// submitting application
if(isset($_POST['submit_application'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $cv = $_POST['cv'];
  $worker_id = $_POST['worker_id'];
  $job_id = $_POST['job_id'];
  $job_title = $_POST['job_title'];
  $company_id = $_POST['company_id'];

  $insert = "INSERT INTO job_applications (username , email ,cv ,worker_id,job_id,job_title,company_id)
  VALUES ('$username','$email','$cv','$worker_id','$job_id',' $job_title','$company_id')";

  mysqli_query($conn , $insert);

  echo "<script>alert('application sent successfully');</script>" ;
  // header("location :" .APPURL . "jobs/jobs-single/php?=id" . $id . "");
}




if(isset($_SESSION['id'])){

// checking for worker application
  $checking_for_application = "SELECT * FROM job_applications WHERE worker_id = '$_SESSION[id]' AND job_id = '$id'";
  $checking_for_application_result = mysqli_query($conn, $checking_for_application);
  
  
  // checking for save jobs
  $check = "SELECT * FROM save_jobs WHERE worker_id =  '$_SESSION[id]' AND job_id = '$id' ";
  $checking_for_saved_jobs = mysqli_query($conn,$check) ;
  
}

// categories

$categories = "SELECT * FROM categories";
$category = mysqli_query($conn , $categories);
$allcategories = mysqli_fetch_assoc($category);
?>
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $row_single['job_title'];?></h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo APPURL ; ?>">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $row_single['job_title'];?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img style="width:100px ; height:100px ; margin-bottom:10px;" src="../users/user-images/<?php echo $row_single['company_image']; ?>" alt="Image">
              </div>
              <div>
                <h2><?php echo $row_single['job_title'] ;?></h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?php echo $row_single['company_name']; ?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?php echo $row_single['job_region']; ?></span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?php echo $row_single['job_type']; ?></span></span>
                </div>
              </div>
            </div>
          </div>
    
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="../images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
              <p> <?php echo $row_single['job_description']; ?> </p>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php echo $row_single['responsibilities']; ?></span></li>
                </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php echo $row_single['education_experience']; ?></span></li>
                 </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php echo $row_single['other_benefits']; ?></span></li>
                </ul>
            </div>
            <?php  if(isset($_SESSION['username'])) : ?>
              <?php  if(isset($_SESSION['type']) AND $_SESSION['type'] == 'Worker') : ?>
                     <div class="row mb-5">
       

                     <?php  if(mysqli_num_rows($checking_for_saved_jobs) == 0) : ?>
                          <div class="col-6">
                            <a href="save-job.php?job_id=<?php echo $id; ?>&worker_id=<?php echo $_SESSION['id']; ?>&status=save"  class="btn btn-block btn-light btn-md"><i class="icon-heart"></i>Save Job</a>
                          </div>
                        <?php  else : ?>
                          <div class="col-6">
                            <a href="save-job.php?job_id=<?php echo $id; ?>&worker_id=<?php echo $_SESSION['id']; ?>&status=delete"  class="btn btn-block btn-light btn-md"><i class="icon-heart text-danger"></i>Saved Job</a>
                          </div>
                          <?php  endif ; ?>

              <?php  if(mysqli_num_rows($checking_for_application_result) == 0) : ?>
              <form  action="job-single.php?id=<?php echo $id ; ?>" method="post">
            
                      <!--job details-->
                    
                      <div class="form-group">
                        <input type="hidden" value="<?php  echo $_SESSION['username'] ; ?>" name="username" class="form-control" id="" placeholder="username">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php  echo $_SESSION['email'] ; ?>" name="email" class="form-control" id="" placeholder="email">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php  echo $_SESSION['cv'] ; ?>" name="cv" class="form-control" id="" placeholder="cv">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php  echo $_SESSION['id'] ; ?>" name="cv" class="form-control" id="" placeholder="worker_id">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php  echo $id ; ?>" name="job_id" class="form-control" id="" placeholder="job_id">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php echo $row_single['job_title'] ; ?>" name="job_title" class="form-control" id="" placeholder="job_title">
                      </div>

                      <div class="form-group">
                        <input type="hidden" value="<?php echo $row_single['company_id'] ; ?>" name="company_id" class="form-control" id="" placeholder="company_id">
                      </div>
                      <div class="col-6">
                <button name="submit_application" style="padding:13px 157px; margin-top:-17px ;" type="submit" class="btn btn-inline btn-primary btn-md">Apply Now</button>
                        </div>

              </form>
              <?php  else : ?>
                <div class="col-6">
                <h4  class="d-inline">You Applied For This Job</h4>
                        </div>

                        <?php  endif ; ?>

             
            </div>
            <?php  endif ; ?>
                <?php else : ?>
                  <h2>login so you can apply for this  job</h2>
                <?php endif ; ?>
            <?php  if(isset($_SESSION['username'])) : ?>
              <?php  if(isset($_SESSION['type']) AND $_SESSION['type'] == 'Company') : ?>
                <?php  if(isset($_SESSION['id']) AND $_SESSION['id'] == $row_single['company_id']) : ?>
            <div class="row mb-5">
              <div class="col-6">
                <a href="<?php echo APPURL ; ?>/jobs/job-update.php?id=<?php echo $row['id'] ;?>" class="btn btn-block btn-light btn-md">Update</a>
                <!--add text-danger to it to make it read-->
              </div>
              <div class="col-6">
                <a style="margin-left:300px ;" href="<?php echo APPURL ; ?>/jobs/job-delete.php?id=<?php echo $row['id'] ;?>" class="btn btn-block btn-danger btn-md">Delete</a>
              </div>
            </div>
                <?php  endif ; ?>
              <?php  endif ; ?>
            <?php  endif ; ?>

          </div>
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Published on:</strong> <?php echo date('M' ,strtotime($row_single['created_at'])) . ',' . date('d' ,strtotime($row_single['created_at'])) . ',' . date('Y' ,strtotime($row_single['created_at'])) ; ?></li>
                <li class="mb-2"><strong class="text-black">Vacancy:</strong> <?php echo $row_single['vaccancy']; ?></li>
                <li class="mb-2"><strong class="text-black">Employment Status:</strong> <?php echo $row_single['job_type']; ?></li>
                <li class="mb-2"><strong class="text-black">Experience:</strong> <?php echo $row_single['experience']; ?></li>
                <li class="mb-2"><strong class="text-black">Job Location:</strong> <?php echo $row_single['job_region']; ?></li>
                <li class="mb-2"><strong class="text-black">Salary:</strong> <?php echo $row_single['salary']; ?></li>
                <li class="mb-2"><strong class="text-black">Gender:</strong> <?php echo $row_single['gender']; ?></li>
                <li class="mb-2"><strong class="text-black">Application Deadline:</strong> <?php echo date('M' ,strtotime($row_single['application_deadline'])) . ',' . date('d' ,strtotime($row_single['application_deadline'])) . ',' . date('Y' ,strtotime($row_single['application_deadline'])) ; ?></li>
                <li class="mb-2"><strong class="text-black">Job Category</strong> <?php echo ucfirst($row_single['category']) ; ?></li>
            
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
              <div class="px-3">
                <a href="https://www.facebook.com/sharer.php?u=<?php echo $row_single['job_title'] ; ?>&url=<?php echo APPURL ; ?>/jobs/job-single.php?id=<?php echo $row_single['id'] ;?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                <a href="https://twitter.com/share?text=<?php echo $row_single['job_title'] ; ?>&url=<?php echo APPURL ; ?>/jobs/job-single.php?id=<?php echo $row_single['id'] ;?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
              </div>
            </div>

            
            <div class="bg-light p-3 border rounded mb-4 mt-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Categories</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <?php  foreach($allcategories as $category) : ?>
                <a target="_blank" style="text-decoration : none ;" href="<?php echo APPURL ; ?>/categories/show-jobs.php?name=<?php $category['name']; ?>" > <li class="mb-2"><?php echo ucfirst($category['name']); ?></li> </a>
                <?php endforeach ; ?>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2"><?php echo $count_row['job_count'] ; ?> Related Jobs</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          <?php  foreach($related_row as $r_row) : ?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="<?php echo APPURL ; ?>/jobs/job-single.php?=id=<?php echo $r_row['id'] ; ?>"></a>
            <div class="job-listing-logo">
              <img src="../users/user-images/<?php echo $r_row['company_image'] ; ?>" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $r_row['job_title'] ;  ?></h2>
                <strong><?php echo $r_row['company_name'] ; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $r_row['job_region'] ; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($r_row['job_type'] == 'Part Time'){echo 'danger';}else{echo 'success';} ?>"><?php echo $r_row['job_type'] ; ?></span>
              </div>
            </div>
            
          </li>
          <br>
          <?php endforeach ?>
          

          
        </ul>

     

      </div>
    </section>
    

 
    
    <?php require  "../includes/footer.php" ; ?>