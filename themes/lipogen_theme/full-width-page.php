<?php
/* 
Template Name: Full Width Page
*/
?>
<?php get_header(); ?>
<div id="content" class="container fullwidth">
	<h1><span><?php the_title(); ?></span> <?php if( is_page('checkout') ) { ?><img class="shield" src="<?php bloginfo('stylesheet_directory'); ?>/images/shield.png" width="22" height="22" alt=""/><?php } ?></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row">
        <div class="page_intro col-md-12">
            <?php the_field('page_intro'); ?>
        </div>
        <div class="page_thumbnail col-md-12">
            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
        </div>
    </div>
    <div class="row margintop">
        <div class="page_content col-md-24">
            <?php the_content(); ?>
        </div>
        
       
    </div>
</div>
<?php get_footer(); ?>