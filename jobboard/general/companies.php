<?php require '../config/config.php'; ?>
<?php require  '../includes/header.php'; ?>

<?php

$select = "SELECT * FROM users WHERE type='Company'";
$select_connect = mysqli_query($conn, $select);
$allcompanies = mysqli_fetch_assoc($select_connect);

?>


<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Companies</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Companies</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="site-section">
    <div class="container">
        <div class="row ">
            <?php  foreach($allcompanies as $company) : ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" style="height:200px ;" src="../users/user-images/<?php echo $company['img'] ; ?>" alt="<?php echo $company['img'] ; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $company['username'] ; ?></h5>
                        <p class="card-text"><?php echo substr($company['bio'], 0,50) ; ?></p>
                        <a target="_blank" href="../users/public-profile.php?id=<?php echo $company['id'] ?>" class="btn btn-primary">Go to Profile</a>
                    </div>
                </div>
                <br>
            </div>
           
            <?php endforeach ; ?>
        </div>
    </div>
</section>
    <?php require  '../includes/footer.php'; ?>