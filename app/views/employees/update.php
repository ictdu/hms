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
                                        <li class="breadcrumb-item"><a href="">Employees</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Update Employee</li>
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
                                <h2 class="mb-10">Update Employee Form</h2>
                                <p>Fill out the information below</p>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form action="<?php echo URLROOT; ?>/employees/update/<?php echo $data['id']; ?>" method="post">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="first_name" type="text" class="form-control form-control-lg <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>" placeholder="Enter employee first name">
                                            <span class="invalid-feedback"><?php echo $data['first_name_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="last_name" type="text" class="form-control form-control-lg <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>" placeholder="Enter employee last name">
                                            <span class="invalid-feedback"><?php echo $data['last_name_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                    <label>Gender</label>
                                        <div class="form-group">
                                            <select name="gender" class="custom-select col-md-12 <?php echo (!empty($data['gender_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['gender']; ?>">
                                                <option value="" selected="">Select...</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            <span class="invalid-feedback"><?php echo $data['gender_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input name="username" type="text" class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>" placeholder="Choose a username">
                                            <span class="invalid-feedback"><?php echo $data['username_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input name="password" type="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" placeholder="Choose a password">
                                            <span class="invalid-feedback"><?php echo $data['password_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input name="password_confirmation" type="password" class="form-control form-control-lg <?php echo (!empty($data['password_confirmation_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password_confirmation']; ?>" placeholder="Repeat your password">
                                            <span class="invalid-feedback"><?php echo $data['password_confirmation_err'] ?></span>
                                        </div>
                                    </div>
                                </div>  
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>       
                            </form>
                        </div>
                    </div>
                    <?php require APPROOT . '/views/employees/displayEmployees.php'; ?>
                </div>
	<?php require APPROOT . '/views/inc/footer.php'; ?>