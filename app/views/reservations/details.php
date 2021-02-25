    <?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-120px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Reservations</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item"><a href="">Reservations</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View</li>
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
                                <h2 class="mb-10">Reservation Details</h2>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Room Number</label>
                                            <input name="room_number" type="text" class="form-control form-control-lg" value="<?php echo $data['guest']->room_number; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Checked-in By</label>
                                            <input name="checked_in_by" type="text" class="form-control form-control-lg" value="<?php echo $data['guest']->checked_in_by; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Full Name</label>
                                            <input name="full_name" type="text" class="form-control form-control-lg" value="<?php echo $data['guest']->full_name; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
                                            <input name="address" type="text" class="form-control form-control-lg" value="<?php echo $data['guest']->address; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number</label>
                                            <input name="phone_number" type="text" class="form-control form-control-lg" value="<?php echo $data['guest']->phone_number; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input name="email" type="email" class="form-control form-control-lg" value="<?php echo $data['guest']->email; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check In</label>
                                            <input name="check_in_date" class="form-control date-picker" value="<?php echo $data['guest']->check_in_date; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Check Out</label>
                                            <input name="check_out_date" class="form-control date-picker" value="<?php echo $data['guest']->check_out_date; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Notes</label>
                                            <textarea name="notes" class="form-control" value="<?php echo $data['guest']->notes; ?>" disabled></textarea>
                                        </div>
                                    </div>
                                </div>    
                            </form>
                        </div>  
                    </div>
                    <?php require APPROOT . '/views/reservations/displayReservations.php'; ?>
                </div>         
	<?php require APPROOT . '/views/inc/footer.php'; ?>