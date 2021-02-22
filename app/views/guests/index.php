<?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-120px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Guests</h4>
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
                    <div class="card-box col-md-12 mb-30">
                        <div class="pb-20">
                            <div class="col-md-12 pd-20">  
                            </div>
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus">Room Number</th>
                                        <th class="datatable-nosort">Category</th>
                                        <th class="datatable-nosort">Status</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data['rooms'] as $room) : ?>
                                    <tr>
                                        <td><?php echo $room->number; ?></td>
                                        <td><?php echo $room->category; ?></td>
                                        <td><span class="badge badge-secondary"><?php echo ucwords($room->status); ?></span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="<?php echo URLROOT . '/rooms/checkout/' . $room->id; ?>"><i class="dw dw-edit2"></i> Guest Details</a>
                                                    <a class="dropdown-item" href="<?php echo URLROOT . '/rooms/checkout/' . $room->id; ?>"><i class="dw dw-edit2"></i> Update Details</a>
                                                    <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Check Out</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Confirmation modal -->
                        <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center font-18">
                                        <form action="" method="post">
                                            <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to continue?</h4>
                                            <div class="padding-bottom-30 row" style="margin: 0 auto;">
                                                <div class="col-6">
                                                    <input role="button" type="button" value="No." class="btn btn-secondary btn-block" data-dismiss="modal">
                                                </div>
                                                <div class="col-6">
                                                    <input role="button" type="submit" value="Yes, delete it." class="btn btn-danger btn-block">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
	<?php require APPROOT . '/views/inc/footer.php'; ?>