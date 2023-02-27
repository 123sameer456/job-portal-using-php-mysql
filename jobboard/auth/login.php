<?php require '../config/config.php' ; ?>
<?php require  '../includes/header.php' ; ?>



 <?php
if(isset($_SESSION['username'])){
  echo "<script>window.location.replace('http://localhost/jobboard');</script>" ;
}

if(isset($_REQUEST['submit'])){

  if(empty($_REQUEST['email']) OR empty($_REQUEST['password']) ){
   
        echo "<script>alert('some fields are  missing');</script>" ;
  } else{

            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $login = "SELECT * FROM users WHERE email = '$email' ";
            $result = mysqli_query($conn , $login);
            $row = mysqli_fetch_assoc($result);
            
            
            if($row >0){
                if($password == $row['mypassword'] &&   $email == $row['email']){
                      $_SESSION['username'] = $row['username'];
                      $_SESSION['id'] = $row['id'] ;
                      $_SESSION['type'] = $row['type'];
                      $_SESSION['email'] = $row['email'];
                      $_SESSION['image'] = $row['img'];
                      $_SESSION['cv'] = $row['cv'];
                      


                      // header("location : https://www.google.com");
                     echo "<script>window.location.replace('http://localhost/jobboard');</script>" ;
                      
            } else{
              echo "<script>alert('password are not match ');</script>" ;
            }
          } else {
            echo "<script>alert('password are match ');</script>" ;
          }

  } 
}
?>





    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php  echo APPURL ;?>/images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Log In</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php  echo APPURL ;?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
      
          <div class="col-md-12">
            <form action="login.php" method="POST" class="p-4 border rounded">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Email</label>
                  <input type="text" name="email" id="fname" class="form-control" placeholder="Email address">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Password</label>
                  <input type="password" name="password" id="fname" class="form-control" placeholder="Password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Log In" class="btn px-4 btn-primary text-white">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
    
    <?php require  '../includes/footer.php' ; ?>