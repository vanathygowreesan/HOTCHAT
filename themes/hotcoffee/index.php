<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fresh_Coffee
 */

get_header();
?>

	<main id="primary" class="site-main">
	<div class="grid-container">
		<div class="grid-x grid-padding-x grid-margin-x">
			<div class="large-12 medium-12 small-12 cell">
			<?php
			// Conditional tags to check the posts
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
				 	* Include the Post-Type-specific template for the content.
				 	* If you want to override this in a child theme, then include a file
				 	* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 	*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
			</div>

			<!-- display side bar right-->
			<div class="cell large-4 medium-4 small-12">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	</main><!-- close main -->

<?php
//get_sidebar();
get_footer();
