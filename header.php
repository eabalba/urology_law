<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<?php wp_head(); ?>

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</head>

<body <?php body_class(); ?>>
	<span role="navigation" aria-label="Skip to content">
		<a class="skip-to-content"  href="#main">
		  Skip to content
		</a>
	</span>
	<header>
		<div class="header-main">
			<div class="header-container">
				<div class="header-inner header-inner-left">
					<?php 
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						}
					?>
				</div>
				<div class="header-inner header-inner-right">
					<div class="burger">
						<div class="strip burger-strip-5">
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
						<nav role="navigation" aria-label="Main Menu" class="header-menu">
							<?php wp_nav_menu( array( 
								'theme_location' => 'main-menu', 
								'container' => '',
								'link_after' => '<svg class="button-arrow" xmlns="http://www.w3.org/2000/svg" width="9.914" height="9.913" viewBox="0 0 9.914 9.913">
									<g id="Group_25" data-name="Group 25" transform="translate(-1134.77 718.703) rotate(-45)">
									<path id="Path_28" data-name="Path 28" d="M-17795.164-23149.789v8h8" transform="translate(5097.541 -28645.58) rotate(-135)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
									<path id="Path_29" data-name="Path 29" d="M-17784.227-23144.789h-12.812" transform="translate(19101.133 23446)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
									</g>
								</svg>'
							) ); ?>
						</nav>
				</div>
				
			</div>
		</div>
	</header>

