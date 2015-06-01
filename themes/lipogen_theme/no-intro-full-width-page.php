<?php
/* 
Template Name: No Intro Full Width Page
*/
?>
<?php get_header(); ?>
<div id="content" class="container">
	<h1><span><?php the_title(); ?></span> <?php if( is_page('cart') ) { ?><img class="shield" src="<?php bloginfo('stylesheet_directory'); ?>/images/shield.png" width="22" height="22" alt=""/><?php } ?></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row">
        <div class="page_content col-md-24">
            <?php the_content(); ?>
        </div>
        
       
    </div>
</div>
<?php get_footer(); ?>