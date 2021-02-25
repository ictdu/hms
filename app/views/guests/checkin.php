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
                                        <li class="breadcrumb-item"><a href="">Guests</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Check In</li>
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
                            <form action="<?php echo URLROOT; ?>/guests/checkin" method="post">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Room Number</label>
                                            <input name="room_number" type="text" class="form-control form-control-lg <?php echo (!empty($data['room_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['room_number']; ?>" placeholder="101">
                                            <span class="invalid-feedback"><?php echo $data['room_number_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Checked-in By</label>
                                            <input name="checked_in_by" type="text" class="form-control form-control-lg <?php echo (!empty($data['checked_in_by_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['user_name']; ?>" placeholder="" disabled>
                                            <span class="invalid-feedback"><?php echo $data['checked_in_by_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Full Name</label>
                                            <input name="full_name" type="text" class="form-control form-control-lg <?php echo (!empty($data['full_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['full_name']; ?>" placeholder="Juan Dela Cruz">
                                            <span class="invalid-feedback"><?php echo $data['full_name_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
                                            <input name="address" type="text" class="form-control form-control-lg <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>" placeholder="#123 Maharlika Village, Angeles City, Pampanga">
                                            <span class="invalid-feedback"><?php echo $data['address_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number</label>
                                            <input name="phone_number" type="text" class="form-control form-control-lg <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>" placeholder="+63123456789">
                                            <span class="invalid-feedback"><?php echo $data['phone_number_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input name="email" type="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="guest@email.com">
                                            <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check In</label>
                                            <input name="check_in_date" class="form-control date-picker <?php echo (!empty($data['check_in_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['check_in_date']; ?>" placeholder="DD / MM / YYYY">
                                            <span class="invalid-feedback"><?php echo $data['check_in_date_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check Out</label>
                                            <input name="check_out_date" class="form-control date-picker <?php echo (!empty($data['check_out_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['check_out_date']; ?>" placeholder="DD / MM / YYYY">
                                            <span class="invalid-feedback"><?php echo $data['check_out_date_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Notes</label>
                                            <textarea name="notes" class="form-control <?php echo (!empty($data['notes_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['notes']; ?>"></textarea>
                                            <span class="invalid-feedback"><?php echo $data['notes_err'] ?></span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>       
                            </form>
                        </div>  
                    </div>
                    <?php require APPROOT . '/views/guests/inc/displayAvailableRooms.php'; ?>
                </div>         
	<?php require APPROOT . '/views/inc/footer.php'; ?>