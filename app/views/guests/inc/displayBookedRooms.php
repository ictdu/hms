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
                    <td><span class="badge badge-secondary"><?php echo ucwords($room->status); ?></span></td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="<?php echo URLROOT . '/guests/room/' . $room->number; ?>"><i class="dw dw-newspaper"></i> Booking Details</a>
                                <a class="dropdown-item" href=""><i class="dw dw-edit2"></i> Update Details</a>
                                <a class="dropdown-item" href="<?php echo URLROOT . '/invoices/v/' . $room->number; ?>"><i class="dw dw-invoice"></i> View Invoice</a>
                                <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Check Out</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>