    <?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-120px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Discounts</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item"><a href="">Discounts</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create Discount</li>
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
                                <h2 class="mb-10">Create Discount</h2>
                                <span>Fill out the information below</span>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form action="<?php echo URLROOT; ?>/discounts" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Discount Type</label>
                                            <select name="type" class="custom-select <?php echo (!empty($data['type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['type']; ?>">
                                                <option value="" selected="">Choose...</option>
                                                <option value="Gift Certificate">Gift Certificate</option>
                                                <option value="Discount Coupon">Discount Coupon</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <span class="invalid-feedback"><?php echo $data['type_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Discount Code</label>
                                            <input name="code" type="text" class="form-control form-control-lg <?php echo (!empty($data['code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['code']; ?>" value="">
                                            <span class="invalid-feedback"><?php echo $data['code_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Amount (%)</label>
                                            <input name="discount" type="number" class="form-control form-control-lg <?php echo (!empty($data['discount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['discount']; ?>" value="">
                                            <span class="invalid-feedback"><?php echo $data['discount_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">No. Of Usage</label>
                                            <input name="number_of_usage" type="number" class="form-control form-control-lg <?php echo (!empty($data['number_of_usage_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['number_of_usage']; ?>" value="">
                                            <span class="invalid-feedback"><?php echo $data['number_of_usage_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <input name="status" type="text" class="form-control form-control-lg <?php echo (!empty($data['status_err'])) ? 'is-invalid' : ''; ?>" placeholder="Active" disabled>
                                            <span class="invalid-feedback"><?php echo $data['status_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>  
                            </form>
                        </div>  
                    </div>
                    <?php require APPROOT . '/views/discounts/displayDiscounts.php'; ?>
                </div>         
	<?php require APPROOT . '/views/inc/footer.php'; ?>