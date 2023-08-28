<?php

/**
 * The template for displaying single posts
 *
 * @package Drowan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php drowan_post_image_single(); ?>

	<div class="post-content">

		<header class="entry-header">

			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

			<?php drowan_entry_meta(); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">

			<?php the_content(); ?>

			<?php wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'drowan'),
				'after'  => '</div>',
			)); ?>

		</div><!-- .entry-content -->

		<?php do_action('drowan_author_bio'); ?>

	</div><!-- .post-content -->

	<footer class="entry-footer post-details">
		<?php drowan_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article>