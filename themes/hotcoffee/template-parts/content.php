<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fresh_Coffee
 */

?>

<div class="grid-x grid-padding-x grid-margin-x">
	<div class="large-12 small-12 cell">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	
	</header><!-- .entry-header --> 

	<?php hotcoffee_post_thumbnail(); ?>

	<div class="entry-content">
		<?php

		if (! is_singular('product')){
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		}
		
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				hotcoffee_posted_on();
				hotcoffee_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'hotcoffee' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hotcoffee' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	</div>
</div>


	<footer class="entry-footer">
		<?php hotcoffee_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
