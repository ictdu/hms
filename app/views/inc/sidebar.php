<div class="left-side-bar">
		<div class="brand-logo mb-30 mt-30">
			<a href="#">
				<img src="<?php echo URLROOT; ?>/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="<?php echo URLROOT; ?>/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="<?php echo URLROOT; ?>/users/dashboard/" class="dropdown-toggle no-arrow">
							<span class="micon fi-home"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					<?php if(isAdmin()) : ?>
						<li>
							<a href="<?php echo URLROOT; ?>/employees/" class="dropdown-toggle no-arrow">
								<i class="micon fi-torsos-male-female"></i><span class="mtext">Employees</span>
							</a>
						</li>
					<?php endif; ?>
					<li>
						<a href="<?php echo URLROOT; ?>/rooms/" class="dropdown-toggle no-arrow">
							<span class="micon fi-list"></span><span class="mtext">Rooms</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URLROOT; ?>/guests/" class="dropdown-toggle no-arrow">
							<span class="micon fi-torsos-all"></span><span class="mtext">Guests</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URLROOT; ?>/reservations/" class="dropdown-toggle no-arrow">
							<span class="micon fi-calendar"></span><span class="mtext">Reservations</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URLROOT; ?>/sales/" class="dropdown-toggle no-arrow">
							<span class="micon fi-clipboard-notes"></span><span class="mtext">Sales Report</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URLROOT; ?>/vouchers/" class="dropdown-toggle no-arrow">
							<span class="micon  fi-pricetag-multiple"></span><span class="mtext">Discounts</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>