<?php
/**
 * The template for displaying Title Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-regional
 */

get_header(); ?>

<?php
  $taxonomy_type = 'regions';
  $posts = get_categories('taxonomy=' . $taxonomy_type . '&type=brands');
  $terms = get_terms($taxonomy_type, array());
  ?>

<?php
$the_slug = 'brands';
$args=array(
  'name' => $the_slug,
  'post_type' => 'page',
  'post_status' => 'publish',
   'orderby' => 'menu_order',
  'numberposts' => 1
);
$my_posts = get_posts($args);

?>  
  <section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="titles-page-hero kenburns hero-height">
        <div class="container">
        <div class= "hero-page-title"><h1><?php echo post_type_archive_title(); ?></h1></div>
      </div>
  </div>

<?php if( have_brands_description() ): ?>
  <div class="page-contents">
    <div class="container">
        <p><?php the_brands_description(); ?></p>
    </div><!-- .tmr__wrapper  -->
  </div>
<?php endif; ?>

<div class="container-fluid region-selector">
<div class=" container">
  <div class="tab_expand tabicon">
    <div class="tabs-arrow-down"></div>
    <div class='region-tab-container'>
      <h2>Select your region</h2>
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

<div class="container">
<?php foreach( $terms as $term ): ?>
    <?php
      $post_array = get_posts(array(
        'post_type' => 'brands',
        'taxonomy' => $term->taxonomy,
        'term' => $term->slug,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'nopaging' => true
      ));
    ?>
<div id="<?php echo $term->slug; ?>" class='tab-container'>
  <h2><?php echo $term->name; ?></h2>
 <ul class='etabs'>
        <?php foreach( $post_array as $post ): ?><li class='tab'><a href="#<?php the_slug() ?>"><?php the_title(); ?></a></li><?php endforeach;?>
 </ul>
 <div class='panel-container'>
<?php
      $single_post_args = array(
        'post_type' => 'brands',
        'taxonomy' => $term->taxonomy,
        'term' => $term->slug,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'nopaging' => false
      );
      $single_post = get_posts( $single_post_args );
      //print_r( $single_post );
      foreach( $single_post as $post ):
      setup_postdata($post);
      //print_r($single);
        get_template_part( 'content-brands' );
      endforeach;
    ?>
    <?php wp_reset_postdata(); ?>
</div>
</div>
<?php endforeach; ?>
   </div><!-- .tmr__wrapper  -->
    </main><!-- #main -->
  </section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>