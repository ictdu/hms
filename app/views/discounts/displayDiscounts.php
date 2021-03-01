    <div class="card-box col-md-8 mb-30">
    <div class="pb-20">
        <div class="col-md-8 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus">ID</th>
                    <th class="datatable-nosort">Type</th>
                    <th class="datatable-nosort">Code</th>
                    <th class="datatable-nosort">Discount (%)</th>
                    <th class="datatable-nosort">No. Of Usage</th>
                    <th class="datatable-nosort">Status</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)) : ?>
                <?php foreach($data['discounts'] as $discount) : ?>
                <tr>
                    <td><?php echo $discount->id; ?></td>
                    <td><?php echo $discount->type; ?></td>
                    <td><?php echo $discount->code; ?></td>
                    <td><?php echo $discount->discount; ?>%</td>
                    <td><?php echo $discount->number_of_usage; ?></td>
                    <?php if($discount->status == 'active') : ?>
                        <td><span class="badge badge-success"><?php echo ucwords($discount->status); ?></span></td>
                    <?php elseif($discount->status == 'inactive') : ?>
                        <td> <span class="badge badge-danger"><?php echo ucwords($discount->status); ?></span></td>
                    <?php endif; ?>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <?php if($discount->status == 'active') : ?>
                                <a class="dropdown-item" href="<?php echo URLROOT . '/discounts/inactive/' . $discount->id; ?>"><i class="dw dw-edit2"></i> Set as Inactive</a>
                            <?php elseif($discount->status == 'inactive') : ?>
                                <a class="dropdown-item" href="<?php echo URLROOT . '/discounts/active/' . $discount->id; ?>"><i class="dw dw-edit2"></i> Set as Active</a>
                            <?php endif; ?>
                                <a data-toggle="modal" href="" data-target="#confirmation-modal" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Confirmation modal -->
    <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <form action="<?php echo URLROOT . '/discounts/delete/' . $discount->id; ?>" method="post">
                        <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to do this?</h4>

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