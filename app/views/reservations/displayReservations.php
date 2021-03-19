<div class="card-box col-md-8 mb-30">
    <div class="pb-20">
        <div class="col-md-8 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus">Reservation Number</th>
                    <th class="table-plus">Room Number</th>
                    <th class="datatable-nosort">Guest Name</th>
                    <th class="datatable-nosort">Check-in</th>
                    <th class="datatable-nosort">Check-out</th>
                    <th class="datatable-nosort">Status</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['reservations'] as $reservation) : ?>
                <tr>
                    <td><?php echo $reservation->id; ?></td>
                    <td><?php echo $reservation->room_number; ?></td>
                    <td><?php echo $reservation->full_name; ?></td>
                    <td><?php echo $reservation->check_in_date; ?></td>
                    <td><?php echo $reservation->check_out_date; ?></td>
                    <td>
                        <?php
                            echo ucwords($reservation->status);
                        ?>
<!--                    --><?php //if($reservation->status  == 'confirmed') : ?>
<!--                        <span class="badge badge-success">--><?php //echo ucwords($reservation->status); ?><!--</span>-->
<!--                    --><?php //elseif($reservation->status == 'on hold') : ?>
<!--                        <span class="badge badge-secondary">--><?php //echo ucwords($reservation->status); ?><!--</span>-->
<!--                    --><?php //elseif($reservation->status  == 'guaranteed') : ?>
<!--                        asdf-->
<!--                        <span class="badge badge-info">--><?php //echo ucwords($reservation->status); ?><!--</span>-->
<!--                    --><?php //endif; ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <?php 
                                    $today = $today = date("Y-m-d");
                                    if($today >= $reservation->check_in_date AND $today <= $reservation->check_out_date) {
                                        echo '<a class='."dropdown-item href=" . URLROOT . '/reservations/update/' . $reservation->id . '><i class="dw dw-checked"></i> Check-in</a>';
                                    }
                                ?>
                                <a class="dropdown-item" href="<?php echo URLROOT . '/payments/invoice/' .  $reservation->invoice_number; ?>" target="_blank"><i class="dw dw-invoice"></i> View Invoice</a>
                                <a class="dropdown-item" href="<?php echo URLROOT . '/reservations/details/' . $reservation->id; ?>"><i class="dw dw-edit2"></i> Details</a>
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
                    <form action="<?php echo URLROOT . '/reservations/delete/' . $reservation->id; ?>" method="post">
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