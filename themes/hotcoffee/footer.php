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
			<div class="large-1 cell footer-first-col">

			</div>
			<div class="large-2 cell footer-first-col">
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/logo_final.png">
				<p>100, Ontario Street, Ontario L1C1B1 <br>
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/phon_icon.png">  : 298-111-1111</p>
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/socila icons.png">
			</div>
			<div class="large-2 cell footer-second-col">
				<h4 class="footer-heading">Help & Information</h4>
				<ul class="footer-list">
					<li><a href="">About Us</a></li>
					<li><a href="">Privacy Policy</a></li>
					<li><a href="">Terms & Conditions</li></a>
					<li><a href="">Products Return</li></a>
					<li><a href="">Wholesale Policy</li></a>
				</ul>
			</div>
			
			<div class="large-2 cell footer-third-col">
				<h4 class="footer-heading">Help & Information</h4>
				<ul class="footer-list">
					<li><a href="">Return Policies</a></li>
					<li><a href="">Terms & Conditions</a></li>
					<li><a href="">Contact</li></a>
					<li><a href="">Accessories</li></a>
					<li><a href="">Store Locations</li></a>
				</ul>
			</div>

			<div class="large-2 cell footer-fourth-col">
				<h4 class="footer-heading">Popular Categories</h4>
				<ul class="footer-list">
					<li><a href="">Arabica</a></li>
					<li><a href="">Decaf</a></li>
					<li><a href="">Espresso</li></a>
					<li><a href="">Latte</li></a>
					<li><a href="">Cappuccino</li></a>
				</ul>
			</div>
			<div class="large-2 cell footer-fourth-col">
				<img src="http://hotchat.local/wp-content/themes/hotcoffee/assets/img/coffee-cup.png">
			</div>
        </div>

		<div class="grid-x grid-padding-x grid-margin-x">
			<div class="large-12 cell copy-rights">
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
