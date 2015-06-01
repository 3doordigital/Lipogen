<?php get_header(); ?>
<div id="content" class="container">
	<h1><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row border">
        <div class="page_content col-md-15">
            <?php
				if(have_posts()):
					while(have_posts()):
						the_post();
			?>
            <article id="poststart post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail('blog-top', array('class' => 'img-responsive'));
                    } 
                ?>
                <div class="post-meta row">
                	<div class="col-xs-6">
	                	<i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?>
                    </div>
                    <div class="col-xs-6">
	                	<i class="fa fa-user"></i> <?php the_author_posts_link(); ?> 
                    </div>
                    <div class="col-xs-6">
	                	<i class="fa fa-comment-o"></i>  <?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?> 
                    </div>
                    <div class="col-xs-6">
	                	<i class="fa fa-folder-open-o"></i> <?php the_category( ',' ); ?>
                    </div>
                </div>
                <?php the_content(); ?>
            </article>
            <?php comments_template(); ?> 
            <?php
					endwhile;
				else:
			?>
            
            <?php
				endif;
			?>
        </div>
        <div class="col-md-1"></div>
        
            <?php get_sidebar(); ?>
       
    </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>