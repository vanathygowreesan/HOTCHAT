<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fresh_Coffee
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">

		<div class="grid-x grid-padding-x grid-margin-x top-nav">
			<div class="large-4 cell"></div>

			<div class="large-4 small-12 cell site-branding">
				<?php

				if (! empty (get_custom_logo())){
					the_custom_logo();

				}else{

					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$hotcoffee_description = get_bloginfo( 'description', 'display' );
					if ( $hotcoffee_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $hotcoffee_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php 
			
					endif; 
				}
						?>
			</div><!-- .site-branding -->

			<!-- order links -->
			<div class="order-links">
				<ul class="large-4 small-12 cell order-menu">
					<?php if (!empty (get_theme_mod('hotcoffee_login_url')) && !empty(get_theme_mod ('hotcoffee_login_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_login_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_login_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_login_icon'), array('30', '30'));
								echo get_theme_mod('hotcoffee_login_title');
							} else {
								echo get_theme_mod('hotcoffee_login_title');
							}
							?>
							</a>
						</li>

					<?php } ?>

					<?php if (!empty (get_theme_mod('hotcoffee_cart_url')) && !empty(get_theme_mod ('hotcoffee_cart_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_cart_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_cart_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_cart_icon'), array('30', '30'));
								echo get_theme_mod('hotcoffee_cart_title');
							} else {
								echo get_theme_mod('hotcoffee_cart_title');
							}
							?>
							</a>
						</li>

					<?php } ?>

				</ul>


				<?php

				/*
					if (has_nav_menu( 'menu-shop' )){
							wp_nav_menu(
								array(
									'theme_location' => 'menu-shop',
								)
							);
					}
				*/
				?> 
			</div>

		</div><!-- close top nav -->

		<nav id="site-navigation" class="main-navigation">
			<div class="grid-x grid-padding-x grid-margin-x bottom-nav">
				<div class="large-4 cell"></div>
				<div class="large-4 small-12 cell menu-links">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hotcoffee' ); ?></button>
					<?php
						if (has_nav_menu( 'menu-primary' )){
							wp_nav_menu(
								array(
									'theme_location' => 'menu-primary',
									'menu_id'        => 'primary-menu',
								)
							);
						}
					?>
				</div> <!-- Close primary menu -->

				<!-- Search bar -->
				<div class="large-4 cell">
					<form>
  						<input type="search" placeholder="Search...">
  						<button type="submit">
						  <?php if (!empty (get_theme_mod('hotcoffee_search_url')) && !empty(get_theme_mod ('hotcoffee_search_title'))){ ?>
						
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_search_url')); ?>">
							<?php
								if (!empty (get_theme_mod('hotcoffee_search_icon'))){
									echo wp_get_attachment_image (get_theme_mod('hotcoffee_search_icon'), array('30', '30'));
								} else {
									echo get_theme_mod('hotcoffee_search_title');
								}
							?>
							</a>

						<?php } ?>
						</button>
					</form>

					<?php
					/*
					if (has_nav_menu( 'menu-search' )){
						wp_nav_menu(
							array(
								'theme_location' => 'menu-search',
								'menu_id'        => 'search-menu',
							)
						);
					} */
					?>
				</div><!-- close Search bar -->
        	</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
