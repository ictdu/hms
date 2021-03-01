<div class="card-box col-md-12 mb-30">
    <div class="col-md-12 pd-20 text-right">
        <a href="<?php echo URLROOT ?>/sales/index" class="btn btn-info">All</a>
        <a href="<?php echo URLROOT ?>/sales/today" class="btn btn-info">Today</a>
        <a href="<?php echo URLROOT ?>/sales/week" class="btn btn-info">Week</a>
        <a href="<?php echo URLROOT ?>/sales/month" class="btn btn-info">Month</a>
    </div>
    <div class="pb-20">
        <div class="col-md-12 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Invoice Date</th>
                    <th class="table-plus">Invoice Number</th>
                    <th class="datatable-nosort">Amount</th>
                    <th class="datatable-nosort">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)) : ?>
                <tr>
                    <td><?php echo date('Y-m-d', strtotime($data['date'])); ?></td>
                    <td><?php echo $data['number']; ?></td>
                    <td>PHP <?php echo $data['balance']; ?></td>
                    <td>
                    <?php if($data['status'] == 'paid') : ?>
                        <span class="badge badge-success"><?php echo ucwords($data['status']); ?></span>
                    <?php elseif($data['status'] == 'unpaid') : ?>
                        <span class="badge badge-secondary"><?php echo ucwords($data['status']); ?></span>
                    <?php endif; ?>
                    </td>
                   <!-- <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href=" <?php // echo URLROOT . '/payments/invoices/' . $data['number']; ?>"><i class="dw dw-edit2"></i> Details</a>
                                <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                        </div>
                    </td> -->
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Confirmation modal -->
    <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <form action="<?php echo URLROOT . '/reservations/delete/' . $invoice->id; ?>" method="post">
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