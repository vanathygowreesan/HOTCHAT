<?php
/**
 * Template Name: Sidebar Right
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fresh_Coffee
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<div class="grid-x grid-margin-x grid-margin-y">
			<?php
			while ( have_posts() ) :
				the_post();

				//echo'this is the sidebar right';
			?>

				<div class="cell large-8 medium-8 small-12">
					<?php
					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>

				<div class="cell large-4 medium-4 small-12">
					<?php get_sidebar(); ?>
				</div>

				<?php
				endwhile; // End of the loop.
				?>	
		
			</div>

		</div>

		

	</main><!-- #main -->

<?php
get_footer();
