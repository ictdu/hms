<div class="card-box col-md-8 mb-30">
    <div class="pb-20">
        <div class="col-md-8 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus">ID</th>
                    <th class="datatable-nosort">Name</th>
                    <th class="datatable-nosort">Rate</th>
                    <th class="datatable-nosort">Capacity</th>
                    <th class="datatable-nosort">Description</th>
                    <th class="datatable-nosort">Image</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['categories'] as $category) : ?>
                    <tr>
                        <td><?php echo $category->id; ?></td>
                        <td><?php echo $category->name; ?></td>
                        <td><?php echo $category->rate; ?></td>
                        <td><?php echo $category->capacity; ?></td>
                        <td><?php echo $category->description; ?></td>
                        <td><a href="<?php echo URLROOT . '/images/uploads/' . $category->image; ?>">View</a></td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="<?php echo URLROOT . '/categories/update/' . $category->id; ?>"><i class="dw dw-edit2"></i> Update</a>
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
                        <form action="<?php echo URLROOT . '/categories/delete/' . $category->id; ?>" method="post">
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