<?php
/*
Template Name: Testimonials
*/
?>
<?php get_header(); ?>
<div id="content" class="container fullwidth">
	<h1><span><?php the_title(); ?></span></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row">
        <div class="page_intro testi col-md-24">
            <?php the_field('page_intro'); ?>
        </div>
    </div>
    <div class="row margintop">
        <div class="page_content col-md-24" id="testimonials">
           <?php $my_query = new WP_Query( 'post_type=testimonials&posts_per_page=10' ); ?>
            <div class="row dv-testimonial-wrapper">
                <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                    <div class="testibox col-md-7 col-md-offset-1 col-xs-11 col-xs-offset-1">
                    <a href="#" data-toggle="modal" data-target="#videolink-<?php echo $post->ID; ?>" class="videolink"><img class="videooverlay" src="<?php bloginfo('stylesheet_directory'); ?>/images/watch-now.png" width="120" height="82" alt=""/>
                        <?php the_post_thumbnail( 'full', array('class' => 'img-responsive videolink') ); ?> </a>
                        <h2><?php the_title(); ?> - Success Story</h2>
                        <?php the_content(); ?>
                    </div>
                    <div class="modal fade" id="videolink-<?php echo $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <div class="modal-body center">
                          <div class="embed-responsive embed-responsive-16by9">
                            <?php the_field('testi_youtube'); ?>
                            </div>
                            <a href="<?php bloginfo('url'); ?>/buy-now/">
                                <img src="<?php bloginfo('stylesheet_directory'); ?>/images/modal-foot.png" width="373" height="94" alt=""/>
                            </a><br />
                             or <a href="<?php bloginfo('url'); ?>/testimonials/">See More Testimonials</a>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php endwhile; ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="testi-foot-content">
            <?php echo get_post_field('post_content', 16); ?>
        </div>
    </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>