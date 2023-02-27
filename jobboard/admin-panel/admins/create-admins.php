<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>



<?php
if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.replace('http://localhost/jobboard/admin-panel');</script>" ;
}

if(isset($_REQUEST['submit'])){

  if(empty($_REQUEST['adminname'])  OR empty($_REQUEST['email']) OR
      empty($_REQUEST['password']) ){
   
        echo "<script>alert('some fields are  missing');</script>" ;
  } else{
        $adminname = $_REQUEST['adminname'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
         
                $insert = "INSERT INTO admins (adminname , email , mypassword )
                VALUES ('$adminname' , '$email' , '$password') " ;
             mysqli_query($conn , $insert);
               
               
             }

        

}

?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" >
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>

      <?php  require "../layout/footer.php" ; ?>