<div class="card-box col-md-12 mb-30">
    <div class="col-md-12 pd-20 text-right">
        <a href="<?php echo URLROOT ?>/guests/departures" class="btn btn-info">All</a>
        <a href="<?php echo URLROOT ?>/guests/departures_today" class="btn btn-info">Today</a>
        <a href="<?php echo URLROOT ?>/guests/departures_week" class="btn btn-info">Week</a>
        <a href="<?php echo URLROOT ?>/guests/departures_month" class="btn btn-info">Month</a>
    </div>
    <div class="pb-20">
        <div class="col-md-12 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Guest Number</th>
                    <th class="datatable-nosort">Guest Name</th>
                    <th class="datatable-nosort">Room Number</th>
                    <th class="datatable-nosort">Check-in Date</th>
                    <th class="datatable-nosort">Check-out Date</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data)) : ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['full_name']; ?></td>
                        <td><?php echo $data['room_number']; ?></td>
                        <td><?php echo $data['check_in_date']; ?></td>
                        <td><?php echo $data['check_out_date']; ?></td>
                        <td><a data-toggle="modal" href="" data-target="#confirmation-modal" class="btn btn-info" role="button">Checkout</td>
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
                    <form action="<?php echo URLROOT . '/guests/checkout/' . $data['room_number']; ?>" method="post">
                        <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to continue?</h4>
                        <div class="padding-bottom-30 row" style="margin: 0 auto;">
                            <div class="col-6">
                                <input role="button" type="button" value="Cancel" class="btn btn-secondary btn-block" data-dismiss="modal">
                            </div>
                            <div class="col-6">
                                <input role="button" type="submit" value="Confirm" class="btn btn-info btn-block">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>