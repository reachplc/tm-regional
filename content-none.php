<?php
/**
 * The template part for displaying a message that posts
 * cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-regional
 */
?>

<section class="no-results not-found">
  <header>
    <h1 class="page-title"><?php _e( 'oops!', 'tm-regional' ); ?></h1>
  </header><!-- .page-header -->

  <div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

      <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tm-regional' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

    <?php elseif ( is_search() ) : ?>

      <h1><?php _e( '0 results found', 'tm-regional' ); ?></h1>
		<?php get_search_form(); ?>

    <?php else : ?>

      <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tm-regional' ); ?></p>
		<?php get_search_form(); ?>

    <?php endif; ?>
  </div><!-- .page-content -->
</section><!-- .no-results -->
