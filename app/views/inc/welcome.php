<div class="card-box pd-20 mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?php echo URLROOT ?>/vendors/images/banner-img.png" alt="">
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                Welcome to your dashboard <div class="weight-600 font-30 text-blue"><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?></div>
            </h4>
            <p class="font-18 max-width-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde hic non repellendus debitis iure, doloremque assumenda.</p>
        </div>
    </div>
</div>