<?php get_header(); ?>
<div id="content" class="container">
	
    
    <h1>
    	<div class="row">
        	<div class="col-md-14 col-sm-24">
    			<span>
                    <?php
                        if( is_home() ) {
                    ?>
                        <?php echo get_the_title( get_option('page_for_posts', true) ); ?></span>
                    <?php } else { ?>
                        <?php single_cat_title( '', true ); ?>
                    <?php }?>
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
    <div class="row border">
        <div class="page_content col-md-15">
            <?php
				if(have_posts()):
					while(have_posts()):
						the_post();
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'archive' ) ); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail('blog-top', array('class' => 'img-responsive'));
                    } 
                ?>
                <div class="post-meta">
	                	<span><i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
	                	<span><i class="fa fa-user"></i> <?php the_author_posts_link(); ?> </span>
	                	<span><i class="fa fa-comment-o"></i>  <?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?> </span>
	                	<span><i class="fa fa-folder-open-o"></i> <?php the_category( ',' ); ?></span>
                </div>
                <?php the_excerpt(); ?>
            </article>
            <?php
					endwhile;
				else:
			?>
            
            <?php
				endif;
			?>
            <?php wp_pagenavi(); ?>
        </div>
        <div class="col-md-1"></div>
        
            <?php get_sidebar(); ?>
       
    </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>