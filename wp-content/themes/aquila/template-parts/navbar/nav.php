<?php

/**
 * Aquila Nav
 * 
 * @package Aquila
 */

$menu_class = \Aquila_Theme\Inc\Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('aquila-header-menu');
$header_menus = wp_get_nav_menu_items($header_menu_id);
?>
<header class="header ver-1">
	<div class="container">
		<div class="row">
			<nav class="navbar navbar-expand-lg">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
					<svg class="ham hamRotate ham1" viewBox="0 0 100 100">
						<path class="line top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
						<path class="line middle" d="m 30,50 h 40" />
						<path class="line bottom" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
					</svg>
				</button>
				<a class="navbar-brand align-items-center d-lg-flex d-none" href="index.html">
					<?php if (function_exists('the_custom_logo')) {
						the_custom_logo();
					} ?>

				</a>
				<div class="collapse navbar-collapse" id="mainMenu">

					<?php
					if (!empty($header_menus) && is_array($header_menus)) {
					?>



						<ul class="ml-auto navbar-nav">
							<?php
							foreach ($header_menus as $menu_item) {
								if (!$menu_item->menu_item_parent) {

									$child_menu_items = $menu_class->get_child_menu_items($header_menus, $menu_item->ID);
									$has_children = !empty($child_menu_items) && is_array($child_menu_items);
									$has_sub_menu_class = !empty($has_children) ? 'has-submenu' : '';

									if (!$has_children) {
							?>
										<li class="nav-item">
											<a class="nav-link" href="<?php echo esc_url($menu_item->url); ?>">
												<?php echo esc_html($menu_item->title); ?>
											</a>
										</li>
									<?php
									} else {
									?>
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<?php echo esc_html($menu_item->title); ?>
											</a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												<?php
												foreach ($child_menu_items as $child_menu_item) {
												?>
													<a class="dropdown-item" href="<?php echo esc_url($child_menu_item->url); ?>">
														<?php echo esc_html($child_menu_item->title); ?>
													</a>
												<?php
												}
												?>
											</div>
										</li>
									<?php
									}
									?>
							<?php
								}
							}
							?>

						</ul>
					<?php } ?>
				</div>
				<?php if (!is_user_logged_in()):?>
				<a href="/registration" class="ml-5 contact-button btn btn-sm btn-danger">Register</a>
				<a href="/login" class="ml-5 contact-button btn btn-sm btn-danger">Login</a>
				<?php else:?>
				<a href="<?php echo wp_logout_url( $redirect = '/login' ); ?>" class="ml-5 contact-button btn btn-sm btn-danger">Logout</a>

				<?php endif; ?>
					
					
				

			</nav>
		</div>
	</div>
</header>