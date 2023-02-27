<?php require "../layout/header.php"; ?>
<?php require "../../config/config.php"; ?>





<?php
if(isset($_SESSION['adminname'])){
  echo "<script>window.location.replace('http://localhost/jobboard/admin-panel');</script>" ;
}

if(isset($_REQUEST['submit'])){

  if(empty($_REQUEST['email']) OR empty($_REQUEST['password']) ){
   
        echo "<script>alert('some fields are  missing');</script>" ;
  } else{

            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $login = "SELECT * FROM admins WHERE email = '$email' ";
            $result = mysqli_query($conn , $login);
            $row = mysqli_fetch_assoc($result);
            
            
            if($row >0){
                if($password == $row['mypassword'] &&   $email == $row['email']){
                      $_SESSION['adminname'] = $row['adminname'];
                     
                      $_SESSION['email'] = $row['email'];
                  
                      
                     echo "<script>window.location.replace('http://localhost/jobboard/admin-panel');</script>" ;
                       
            } else{
              echo "<script>alert('password are not match ');</script>" ;
            }
          } else {
            echo "<script>alert('password are match ');</script>" ;
          }

  } 
}
?>





<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mt-5">Login</h5>
        <form method="POST" class="p-auto" action="login-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

          </div>


          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


        </form>

      </div>
    </div>
  </div>
</div>

<?php require "../layout/footer.php"; ?>