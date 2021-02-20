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
                                <h2 class="mb-10">Create Room Category</h2>
                                <p>Fill out the information below</p>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form action="<?php echo URLROOT; ?>/categories" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Super Deluxe I">
                                            <span class="invalid-feedback"><?php echo $data['name_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Rate Per Day</label>
                                            <input name="rate" type="text" class="form-control form-control-lg <?php echo (!empty($data['rate_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['rate']; ?>" placeholder="0.00">
                                            <span class="invalid-feedback"><?php echo $data['rate_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input name="capacity" type="text" class="form-control form-control-lg <?php echo (!empty($data['capacity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['capacity']; ?>" placeholder="1-2">
                                            <span class="invalid-feedback"><?php echo $data['capacity_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="category-image" accept="image/*" class="form-control-file form-control <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['image']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['image_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>"></textarea>
                                            <span class="invalid-feedback"><?php echo $data['description_err'] ?></span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>       
                            </form>
                        </div>
                    </div>
                    <?php require APPROOT . '/views/categories/displayCategories.php'; ?>
                </div>      
	<?php require APPROOT . '/views/inc/footer.php'; ?>