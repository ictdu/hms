<div class="card-box col-md-8 mb-30">
    <div class="pb-20">
        <div class="col-md-8 pd-20">  
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
                        <td>
                            <?php if($room->status == 'available') : ?>
                                <div class="badge badge-success"><?php echo ucwords($room->status); ?></div>
                            <?php elseif($room->status == 'occupied') : ?>
                                <div class="badge badge-danger"><?php echo ucwords($room->status); ?></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="<?php echo URLROOT . '/rooms/update/' . $room->id; ?>"><i class="dw dw-edit2"></i> Update</a>
                                    <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</a>
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
                        <form action="<?php echo URLROOT . '/rooms/delete/' . $room->id; ?>" method="post">
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