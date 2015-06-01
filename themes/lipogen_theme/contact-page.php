<?php
/*
Template Name: Contact 
*/
?>
<?php get_header(); ?>
<div id="content post-<?php the_ID(); ?>" <?php post_class(array('container')); ?>>
	<h1><span><?php the_title(); ?></span></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row margintop">
        <div class="page_content col-md-15">
        <div class="page_intro">
            <?php the_field('page_intro'); ?>
        </div>
        	<hr>
            <?php the_content(); ?>
            <hr>
            <h2>Get In Touch</h2>
            <?php echo do_shortcode('[contact-form-7 id="151"]'); ?>
        </div>
        <div class="col-md-1"></div>
        
            <?php get_sidebar(); ?>
       
    </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>