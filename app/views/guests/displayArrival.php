<div class="card-box col-md-12 mb-30">
    <div class="pb-20">
        <div class="col-md-12 pd-20">  
        </div>
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Guest Number</th>
                    <th class="datatable-nosort">Check-in Date</th>
                    <th class="datatable-nosort">Check-out Date</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data['guests'] as $guest) : ?>
                <tr>
                    <td><?php echo $guest->id; ?></td>
                    <td><?php echo $guest->check_in_date; ?></td>
                    <td><?php echo $guest->check_out_date; ?></td>
                    <td></td>
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