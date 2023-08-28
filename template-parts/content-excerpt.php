<?php

/**
 * The template for displaying articles in the loop with post excerpts
 *
 * @package Drowan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php drowan_post_image_archives(); ?>

	<div class="post-content">

		<header class="entry-header">

			<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

			<?php drowan_entry_meta(); ?>

		</header><!-- .entry-header -->

		<div class="entry-content entry-excerpt clearfix">
			<?php the_excerpt(); ?>
			<?php drowan_more_link(); ?>
		</div><!-- .entry-content -->

	</div>

	<footer class="entry-footer post-details">
		<?php drowan_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article>