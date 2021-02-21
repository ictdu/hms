    <?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-120px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Rooms</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item"><a href="">Rooms / Category</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create Room</li>
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
                                <h2 class="mb-10">Create Room</h2>
                                <p>Fill out the information below</p>
                                <span><?php flash('feedback'); ?></span>
                            </div>
                            <form action="<?php echo URLROOT; ?>/rooms" method="post">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Room Number</label>
                                            <input name="number" id="number" type="text" class="form-control form-control-lg  <?php echo (!empty($data['number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['number']; ?>" placeholder="123">
                                            <span class="invalid-feedback"><?php echo $data['number_err'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <label>Category</label>
                                        <div class="form-group">
                                            <select name="category" id="category" class="custom-select col-md-12 <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>">
                                                <option value="" selected="">Select...</option>
                                                <?php foreach($data['categories'] as $category) : ?>
                                                    <?php echo '<option data-rate="' . $category->rate . '"' . 'data-capacity="' . $category->capacity . '"'. 'data-description="' . $category->description . '"' . 'data-status="Available"' . 'value="' . $category->name .'">' . $category->name . '</option>'; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="invalid-feedback"><?php echo $data['category_err'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Rate Per Day</label>
                                            <input name="rate" id="rate" type="text" class="form-control form-control-lg" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input name="capacity" id="capacity" type="text" class="form-control form-control-lg" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input name="status" id="status" type="text" class="form-control form-control-lg" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="description" class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                </div> 
                                <div class="text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit"> 
                                </div>       
                            </form>
                        </div>
                    </div>
                    <?php require APPROOT . '/views/rooms/displayRooms.php'; ?>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script>
                    $('#category').change(function() {
                        $('#rate').val($(this).find('option:selected').data('rate'))
                        $('#capacity').val($(this).find('option:selected').data('capacity'))
                        $('#description').val($(this).find('option:selected').data('description'))
                        $('#status').val($(this).find('option:selected').data('status'))
                    })
                </script>
	<?php require APPROOT . '/views/inc/footer.php'; ?>