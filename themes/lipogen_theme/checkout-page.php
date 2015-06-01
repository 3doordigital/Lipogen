<?php
/*
Template Name: Checkout Page
*/
?>
<?php get_header(); ?>
<div id="content" class="container">
	<h1>
    	<div class="row">
        	<div class="col-md-14 col-sm-24">
    			<span><?php the_title(); ?></span>
            </div>
            <div class="col-md-10 col-sm-24 social text-right">
    			<span class="twitter">
                    <?php dd_twitter_generate('Compact','twitter_username') ?>
                </span>
                <span class="google">
                    <?php dd_google1_generate('Compact (20px)') ?>
                </span>
                <span class="Facebook">
                    <?php dd_fbshare_generate('Compact') ?>
                </span>
                <span class="linkedin">
                	<?php dd_linkedin_generate('Compact') ?>
                </span>
            </div>
    	</div>
    </h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <?php if( get_field('page_intro') != '' ) { ?>
        <div class="row">
            <div class="page_intro <?php echo ( has_post_thumbnail() ? 'col-md-12' : 'col-md-24'); ?>">
                <?php the_field('page_intro'); ?>
            </div>
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="page_thumbnail col-md-12">
                    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="row margintop border">
        <div class="page_content col-md-15">
            <?php the_content(); ?>
        </div>
        <div class="col-md-1"></div>
        
            <?php get_sidebar(); ?>
       
    </div>
</div>
<?php get_footer(); ?>