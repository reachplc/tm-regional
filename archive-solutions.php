<?php
/**
 * The template for displaying Product Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-regional
 */

$post_type = get_post_type();
$taxonomy_type = 'mediums';
$posts = get_categories( 'taxonomy=' . $taxonomy_type . '&type=' . $post_type );
$terms = get_terms( $taxonomy_type, array() );

get_header(); ?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="products-page-hero kenburns hero-height">
          <div class="container">
          <div class= "hero-page-title"><h1><?php echo post_type_archive_title(); ?></h1></div>
        </div>
        </div>
<?php if( have_solutions_description() ): ?>
<div class="page-contents">
      <div class="container">     
  <p><?php the_solutions_description(); ?></p>
  </div><!-- .tmr__wrapper  -->
</div>
<?php endif; ?>
    <div class="container-fluid region-selector">
<div class=" container">
   <div class="tab_expand tabicon">
    <div class="tabs-arrow-down"></div>
<div class='region-tab-container'>
  <h2>Select your media</h2>
      <ul class='tabs-menu etabs'>
      <?php foreach( $terms as $term ): ?>
        <li class='tab'><a href="#<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
      <?php endforeach;?>
      <?php /* End sections loop */ ?>
      </ul>
  </div>
</div>
</div>

</div>
<?php /* Start the Loop for regions */ ?>
<?php foreach( $terms as $term ): ?>
<div id="titles-main">
  <div class="container">
  <section>
  <?php /* Start the Loop for posts within regions */ ?>

<?php
  $post_array = get_posts( array(
    'post_type' => $post_type,
    'taxonomy' => $term->taxonomy,
    'term' => $term->slug,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'nopaging' => true
  ) );
?>

<div id="<?php echo $term->slug; ?>"  class='tab-container'>
  <h2><?php echo $term->name; ?></h2>
<?php /* Start sections loop */ ?>
<ul class='etabs'>
<?php foreach( $post_array as $post ): ?>
  <?php setup_postdata($post); ?>
  <li class='tab'><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></li>
  <?php wp_reset_postdata(); ?>
<?php endforeach;?>
</ul>

<?php /* End sections loop */ ?>


<?php
      $single_post_args = array(
        'posts_per_page' => 9999,
        'post_type' => $post_type,
        'taxonomy' => $term->taxonomy,
        'term' => $term->slug,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'nopaging' => false
      );

      $single_post = get_posts( $single_post_args );
      foreach( $single_post as $post ):
        setup_postdata( $post );
        get_template_part( 'content-' . $post_type );
        wp_reset_postdata();
      endforeach;?>
    </div>
  </section>
  </div><!-- .tmr__wrapper  -->
</div><!-- #titles-main -->
<?php endforeach; ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
