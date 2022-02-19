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
		<div class="site-branding">
			<?php
			the_custom_logo();
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
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<div class="grid-x grid-padding-x grid-margin-x top-nav">
				<div class="large-4 cell"></div>
				<div class="large-4 cell logo">
					<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/logo_final.png">
				</div>
				<div class="large-4 cell order-links">
					<a href=""><img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/search_icon.png"></a>&nbsp; &nbsp;
					<a href=""><img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/user.png"></a>&nbsp; &nbsp;
					<a href=""><img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/Cart.png"></a>
				</div>
        	</div>

			<div class="grid-x grid-padding-x grid-margin-x bottom-nav">
				<div class="large-4 cell"></div>
				<div class="large-4 cell menu-links">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hotcoffee' ); ?></button>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-primary',
							'menu_id'        => 'primary-menu',
						)
					);
				?>
				</div>
				<div class="large-4 cell"></div>
        	</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
