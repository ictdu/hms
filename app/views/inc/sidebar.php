<div class="left-side-bar">
		<div class="brand-logo">
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
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
						<ul class="submenu">
							<li><a href="#">Submenu 1</a></li>
							<li><a href="#">Submenu 2</a></li>
						</ul>
					</li>
					<?php if(isAdmin()) : ?>
						<li>
							<a href="<?php echo URLROOT; ?>/users" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-chat3"></span><span class="mtext">Employees</span>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>