<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fresh_Coffee
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="grid-x grid-padding-x grid-margin-x top-footer-wrapper">
			
			<div class="large-3 cell footer-first-col">
				<div class="site-branding">
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

				<p>100, Ontario Street, Ontario L1C1B1 <br>
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/phon_icon.png">  : 298-111-1111</p>
				<ul class="social-media-menu">
					<?php if (!empty (get_theme_mod('hotcoffee_facebook_url')) && !empty(get_theme_mod ('hotcoffee_facebook_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_facebook_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_facebook_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_facebook_icon'), array('40', '40'));
							} else {
								echo get_theme_mod('hotcoffee_facebook_title');
							}
							?>
							</a>
						</li>

					<?php } ?>

					<?php if (!empty (get_theme_mod('hotcoffee_twitter_url')) && !empty(get_theme_mod ('hotcoffee_twitter_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_twitter_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_twitter_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_twitter_icon'), array('40', '40'));
							} else {
								echo get_theme_mod('hotcoffee_twitter_title');
							}
							?>
							</a>
						</li>
					<?php } ?>

					<?php if (!empty (get_theme_mod('hotcoffee_whatsapp_url')) && !empty(get_theme_mod ('hotcoffee_whatsapp_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_whatsapp_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_whatsapp_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_whatsapp_icon'), array('40', '40'));
							} else {
								echo get_theme_mod('hotcoffee_whatsapp_title');
							}
							?>
							</a>
						</li>
					<?php } ?>

					<?php if (!empty (get_theme_mod('hotcoffee_instagram_url')) && !empty(get_theme_mod ('hotcoffee_instagram_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_instagram_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_instagram_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_instagram_icon'), array('40', '40'));
							} else {
								echo get_theme_mod('hotcoffee_instagram_title');
							}
							?>
							</a>
						</li>
					<?php } ?>

					<?php if (!empty (get_theme_mod('hotcoffee_youtube_url')) && !empty(get_theme_mod ('hotcoffee_youtube_title'))){ ?>
						<li>
							<a href="<?php echo esc_url (get_theme_mod('hotcoffee_youtube_url')); ?>">
							<?php
							if (!empty (get_theme_mod('hotcoffee_youtube_icon'))){
								echo wp_get_attachment_image (get_theme_mod('hotcoffee_youtube_icon'), array('40', '40'));
							} else {
								echo get_theme_mod('hotcoffee_youtube_title');
							}
							?>
							</a>
						</li>
					<?php } ?>
				</ul> <!-- close social media ul -->

				<?php
				/*if (has_nav_menu( 'menu-social' )){
					wp_nav_menu(
						array(
							'theme_location' => 'menu-social',
						)
					);
				} */
				?>
			</div>

			<!-- footer 2nd column dynamic content -->
			<div class="large-2 cell footer-second-col">
				<h4 class="footer-heading">Useful Information</h4>
				<ul class="footer-list">
					<li>
						<?php
						if (has_nav_menu( 'menu-footer1' )){
							wp_nav_menu(
								array(
									'theme_location' => 'menu-footer1',
								)
							);
						}
						?>
					</li>
				</ul>
			</div>

	
			<!-- footer 3rd column dynamic content -->
			<div class="large-2 cell footer-third-col">
				<h4 class="footer-heading">Contact Information</h4>
				
				<ul class="footer-list">
					<li>
						<?php
						if (has_nav_menu( 'menu-footer2' )){
							wp_nav_menu(
								array(
									'theme_location' => 'menu-footer2',
								)
							);
						}
						?>
					</li>
				</ul>
			</div>

			<!-- footer 4th column dynamic content -->
			<div class="large-2 cell footer-fourth-col">
				<h4 class="footer-heading">Popular Categories</h4>
				<ul class="footer-list">
					<li>
						<?php
						if (has_nav_menu( 'menu-footer3' )){
							wp_nav_menu(
								array(
									'theme_location' => 'menu-footer3',
								)
							);
						}
						?>
					</li>
				</ul>
			</div>

			<div class="large-3 cell footer-fifth-col">
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/coffee-cup.png">
			</div>
        </div>

		<div class="grid-x grid-padding-x grid-margin-x">
			<div class="large-12 small-12 cell copy-rights">
				<p>Copyright © Hot Chat . All rights reserved.</p>
			</div>
        </div>
      
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hotcoffee' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'hotcoffee' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'hotcoffee' ), 'hotcoffee', '<a href="https://vanathygowreesan.ca">Vanathy Gowreesan</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
