    <?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-120px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Employees</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item"><a href="">Categories</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create Category</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>  
                </div>
                <?php require APPROOT . '/views/inc/welcome.php'; ?>
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <div class="card-box pd-20">
                            <div class="title mb-20">
                                <h2 class="mb-10">Guest Check-In</h2>
                                <p>Fill out the information below</p>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form action="<?php echo URLROOT; ?>/categories" method="post" enctype="multipart/form-data">
                            <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Room Number</label>
                                            <input name="capacity" type="text" class="form-control form-control-lg " value="" placeholder="101">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Checked-in By</label>
                                            <input name="capacity" type="text" class="form-control form-control-lg " value="<?php echo $_SESSION['user_name']; ?>" placeholder="" disabled>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Full Name</label>
                                            <input name="name" type="text" class="form-control form-control-lg" value="" placeholder="Juan Dela Cruz">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
                                            <input name="name" type="text" class="form-control form-control-lg" value="" placeholder="#123 Maharlika Village, Angeles City, Pampanga">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number</label>
                                            <input name="capacity" type="text" class="form-control form-control-lg " value="" placeholder="+63123456789">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input name="capacity" type="text" class="form-control form-control-lg " value="" placeholder="guest@email.com">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check In</label>
                                            <input class="form-control date-picker" placeholder="01 January 2021" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check Out</label>
                                            <input class="form-control date-picker" placeholder="31 December 2021" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Notes</label>
                                            <textarea name="description" class="form-control" value=""></textarea>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>       
                            </form>
                        </div>
                    </div>
                    <?php require APPROOT . '/views/guests/displayAvailableRooms.php'; ?>
                </div>      
	<?php require APPROOT . '/views/inc/footer.php'; ?>