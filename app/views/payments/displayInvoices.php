<div class="card-box col-md-12 mb-30">
    <div class="pb-20">
        <div class="col-md-12 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Invoice Date</th>
                    <th class="table-plus">Invoice Number</th>
                    <th class="datatable-nosort">Guest</th>
                    <th class="datatable-nosort">Room Number</th>
                    <th class="datatable-nosort">Balance</th>
                    <th class="datatable-nosort">Status</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo date('Y-m-d', strtotime($data['date'])); ?></td>
                    <td><?php echo $data['number']; ?></td>
                    <td><?php echo $data['guest']; ?></td>
                    <td><?php echo $data['room_number']; ?></td>
                    <td>PHP<?php echo $data['balance']; ?></td>
                    <td>
                    <?php if($data['status'] == 'paid') : ?>
                        <span class="badge badge-success"><?php echo ucwords($data['status']); ?></span>
                    <?php elseif($data['status'] == 'unpaid') : ?>
                        <span class="badge badge-secondary"><?php echo ucwords($data['status']); ?></span>
                    <?php endif; ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="<?php echo URLROOT . '/payments/invoices/' . $data['number']; ?>"><i class="dw dw-edit2"></i> Details</a>
                                <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Confirmation modal -->
    <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <form action="<?php echo URLROOT . '/reservations/delete/' . $invoice->id; ?>" method="post">
                        <h4 class="padding-top-30 mb-30 weight-500">Guest Details</h4>

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