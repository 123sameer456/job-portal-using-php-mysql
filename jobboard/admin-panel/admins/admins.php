<?php  require "../layout/header.php" ; ?>
<?php  require "../../config/config.php" ; ?>

<?php
if(!isset($_SESSION['adminame'])){
  header("location : " . ADMINURL . "/admins/login-admins.php");
}

$select = "SELECT * FROM admins";
$select_conn = mysqli_query($conn , $select);
$admins = mysqli_fetch_assoc($select_conn);


?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL ; ?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  foreach($admins as $admin) : ?>
                  <tr>

                    <th scope="row"><?php echo $admin['id'] ; ?></th>
                    <td><?php echo $admin['adminname'] ; ?></td>
                    <td><?php echo $admin['email'] ; ?></td>
                   
                  </tr>
                 <?php endforeach ; ?>
                   
                 
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


      <?php  require "../layout/footer.php" ; ?>