<div class="card-box pd-20 mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?php echo URLROOT ?>/vendors/images/banner-img.png" alt="">
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10">
                Welcome to your dashboard <span class="weight-600 font-15 text-blue"><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?></span>
            </h4>
            <p class="font-18 max-width-600">Current Time: 
            <?php 
                date_default_timezone_set ('Asia/Hong_Kong');
                echo date('l, F d Y (h:i a)'); 
            ?>
            </p>
        </div>
    </div>
</div>