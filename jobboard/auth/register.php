<?php require '../config/config.php' ; ?>
<?php require  '../includes/header.php' ; ?>
<?php
if(isset($_SESSION['username'])){
  echo "<script>window.location.replace('http://localhost/jobboard');</script>" ;
}

if(isset($_REQUEST['submit'])){

  if(empty($_REQUEST['username'])  OR empty($_REQUEST['email']) OR
      empty($_REQUEST['password']) OR empty($_REQUEST['repassword'])){
   
        echo "<script>alert('some fields are  missing');</script>" ;
  } else{
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $repassword = $_REQUEST['repassword'];
        $img = 'logo.PNG' ;
        $type = $_REQUEST['type'];

        if($password == $repassword){

            if(strlen($email) > 20 OR strlen($username) > 15){
              echo "<script>alert('email and username  should be smaller than 15 characters');</script>" ;
            } else {


              $validate = "SELECT *  FROM users where email = '$email' OR username = '$username' " ;
              $validate_result = mysqli_query($conn , $validate);
              
              if(mysqli_num_rows($validate_result) > 0){
                echo "<script>alert('email or username  are already taken');</script>";
              } else {
                
                $insert = "INSERT INTO users (username , email , mypassword , img , type)
                VALUES ('$username' , '$email' , '$password' , '$img' , '$type') " ;
             if(mysqli_query($conn , $insert)){
               header("location:  ../auth/login.php") ;
               echo "<script>window.location.replace('../auth/login.php');</script>" ;
               // echo "fe";
             }
             else{
               echo "wrong";
             }
              }
              }
           
            
                    
                    
          }else{
            echo "<script>alert('password are not match');</script> " ;
          }
  }

}

?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Register</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php  echo APPURL ; ?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Register</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5">
            <form action="register.php" method="POST" class="p-4 border rounded">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Username</label>
                  <input type="text" id="fname" name="username" class="form-control" placeholder="Username">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" name="email" id="fname" class="form-control" placeholder="Email address">
                </div>
              </div>
              <div class="form-group">
                <label for="job-type">User Type</label>
                <select name="type" class="selectpicker border rounded" id="user-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select User Type">
                  <option>Worker</option>
                  <option>Company</option>
                </select>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Password</label>
                  <input type="password" name="password" id="fname" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Re-Type Password</label>
                  <input type="password" name="repassword" id="fname" class="form-control" placeholder="Re-type Password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Sign Up" class="btn px-4 btn-primary text-white">
                </div>
              </div>

            </form>
          </div>
      
        </div>
      </div>
    </section>
    
    <?php require  '../includes/footer.php' ; ?>
