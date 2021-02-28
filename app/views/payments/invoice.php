<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice #<?php echo $data['invoice']->number; ?></h2>
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
    					<h3>Hotel Managemeng System</h3>
    					1234 Main
    					Apt. 4B
    					Angeles City PH 2009
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Invoice Status:</strong>
                   <?php if($data['invoice']->status == 'unpaid') : ?>
                     <?php echo ucwords($data['invoice']->status); ?>
                     <a href="#" alt="">(Proceed to payment)</a>
                  <?php else : ?>
    					   <?php echo ucwords($data['invoice']->status); ?>
                  <?php endif; ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Invoice Date:</strong><br>
    					<?php echo date('Y-m-d', strtotime($data['invoice']->created_at)); ?><br><br>
    				</address>
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
        							<td class="text-center"><strong>Check-in Date</strong></td>
                           <td class="text-center"><strong>Check-out Date</strong></td>
        							<td class="text-right"><strong>Rate / Day</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td><?php echo $data['category']->name; ?></td>
    								<td class="text-center"><?php echo date('jS M Y', strtotime($data['guest']->check_in_date)); ?></td>
    								<td class="text-center"><?php echo date('jS M Y', strtotime($data['guest']->check_out_date)); ?></td>
                            <td class="text-right">PHP <?php echo $data['category']->rate; ?></td>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
       <div class="col-md-3">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Payable Amount</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                        <tr>
        							<td><strong>Amount Due</strong></td>
                        </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td>PHP <?php echo $data['invoice']->balance; ?></td>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>