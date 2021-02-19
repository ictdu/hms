	<?php require APPROOT . '/views/inc/header.php'; ?>
	<?php require APPROOT . '/views/inc/sidebar.php'; ?>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Employees</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="/#">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Employees</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<div class="card-box mb-30">
						<div class="col-md-8 pd-20">
							<a href="<?php echo URLROOT; ?>/users/add_employee" role="button" class="btn btn-primary">+ Employee</a>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus">ID</th>
										<th class="datatable-nosort">Name</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($data['employees'] as $employee) : ?>
										<tr>
											<td><?php echo $employee->id; ?></td>
											<td><?php echo $employee->first_name . ' ' . $employee->last_name; ?></td>
											<td>
												<div class="dropdown">
													<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
														<i class="dw dw-more"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
														<a class="dropdown-item" href="<?php echo URLROOT . '/users/update_employee/' . $employee->id ?>"><i class="dw dw-edit2"></i> Update</a>
														<a class="dropdown-item" href="<?php echo URLROOT . '/users/remove_employee/' . $employee->id ?>"><i class="dw dw-delete-3"></i> Remove</a>
													</div>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
	<?php require APPROOT . '/views/inc/footer.php'; ?>