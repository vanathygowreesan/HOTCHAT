<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fresh_Coffee
 */

get_header();
?>

	<main id="primary" class="site-main">

	<div class="grid-container">
		<div class="grid-x grid-padding-x grid-margin-x">
			<div class="cell large-12 medium-12 small-12 ">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'hotcoffee' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'hotcoffee' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
			?>
			</div>

			<div class="cell large-2 medium-2"></div>

			<div class="cell large-8 medium-8 small-12 ">
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			<div>
		</div>
	</div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
