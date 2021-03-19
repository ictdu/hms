<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<style>
			.watermarked {
				position: relative !important;
			}
			.watermarked:after {
				content: "" !important;
				display: block !important;
				width: 100% !important;
				height: 100% !important;
				position: absolute !important;
				top: 25% !important;
				left: 25% !important;
				z-index: 1000 !important;
				pointer-events: none !important;
				background-image: url("<?php echo URLROOT ;?>/vendors/images/logo.png") !important;
				background-position: 30px 30px !important;
				background-repeat: no-repeat !important;
				opacity: 0.05 !important;
			}
		</style>

		<title><?php echo 'Invoice #' . $data['invoice']->number . ' - ' . SITENAME; ?></title>
	</head>
<body>
<div class="container watermarked">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice #<?php echo $data['invoice']->number . ' (' . ucwords($data['invoice']->status) . ')'; ?></h2>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    				<?php echo $data['guest']->full_name; ?><br>
                  	<?php echo $data['guest']->address; ?><br>
                  	<?php echo $data['guest']->phone_number; ?><br>
                  	<?php echo $data['guest']->email; ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong></strong><br>
    					<h3><?php echo SITENAME; ?></h3>
    					#2647 Rizal Avenue, West Bajac Bajac<br>
						Olongapo City, Zambales<br>
						Tel. No. 2239031/6024985
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-12">
					<strong>Invoice Date:</strong><br>
					<?php echo date('Y-m-d', strtotime($data['invoice']->created_at)); ?><br><br>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-9">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Booking Details</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Room Type</strong></td>
									<td><strong>Room Number</strong></td>
        							<td><strong>Check-in Date</strong></td>
                           			<td><strong>Check-out Date</strong></td>
        							<td><strong>Rate / Day</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td><?php echo $data['category']->name; ?></td>
									<td><?php echo $data['guest']->room_number; ?></td>
    								<td><?php echo date('jS M Y', strtotime($data['guest']->check_in_date)); ?></td>
    								<td><?php echo date('jS M Y', strtotime($data['guest']->check_out_date)); ?></td>
                            		<td>PHP <?php echo $data['category']->rate; ?></td>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
       <div class="col-md-3">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title">
					<strong>Payable Amount</strong>
					</h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
							<?php if($data['invoice']->status == 'paid') : ?>	
									<h4><strong>Amount Paid</strong></h4>	
									<hr></hr>
									<span class="lead">PHP <?php echo round($data['invoice']->paid_amount, 2); ?></span>
									<br>
									<br>
									<h4><strong>Balance</strong></h4>
									<hr></hr>
									<span class="lead">PHP <?php echo round($data['invoice']->balance, 2); ?></span>
							<?php elseif($data['invoice']->status == 'partial') : ?>
                                    <h4><strong>Amount Paid</strong></h4>	
									<hr></hr>
									<span class="lead">PHP <?php echo round($data['invoice']->paid_amount, 2); ?></span>
									<br>
									<br>
									<h4><strong>Remaining Balance</strong></h4>	
									<hr></hr>
									<span class="lead">PHP <?php echo round($data['invoice']->balance, 2); ?></span>
							<?php else : ?>
									<h4><strong>Payable Amount</strong></h4>	
									<hr></hr>
									<span class="lead">PHP <?php echo round($data['invoice']->balance, 2); ?></span>
							<?php endif; ?>
    					</table>
						<?php if(($data['invoice']->discounted == false) && $data['invoice']->status == 'unpaid' || $data['invoice']->status == 'partial') : ?>
						<form action='<?php echo URLROOT . '/payments/invoice/' . $data['invoice']->number; ?>' method='post'>
							<div class="form-group">
								<label for="promo_code">Do you have a discount code?</label>
								<input type="text" class="form-control <?php echo (!empty($data['code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['code']; ?>" name="code" placeholder="Enter discount code here">
								<span id="error" class="text-danger"><?php echo $data['code_err'] ?></span>
							</div>
							<input type="submit" class="col-xs-12 btn btn-info" style="margin-bottom: 5px;" value="APPLY" id="apply">
						<?php endif; ?>
						<?php if($data['invoice']->status == 'unpaid' || $data['invoice']->status == 'partial') : ?>
							<a target="_blank" href="<?php echo URLROOT . '/payments/pay/' . $data['invoice']->number; ?>" class="col-xs-12 btn btn-warning">PROCEED TO PAYMENT</a>
						<?php endif; ?>
						</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

</body>
</html>