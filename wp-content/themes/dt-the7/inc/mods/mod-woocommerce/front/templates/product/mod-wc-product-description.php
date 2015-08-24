<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

<?php if ( presscore_get_config()->get( 'show_titles' ) && get_the_title() ) : ?>

	<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

<?php endif; ?>

<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>