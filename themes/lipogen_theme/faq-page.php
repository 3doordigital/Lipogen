<?php
/*
Template Name: FAQ 
*/
?>
<?php get_header(); ?>
<div id="content post-<?php the_ID(); ?>" <?php post_class(array('container')); ?>>
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
    
    <div class="row margintop">
        <div class="page_content col-md-15">
        <div class="page_intro ">
            <?php the_field('page_intro'); ?>
        </div>
            <?php the_content(); ?>
            
            <h2 id="product">Product Questions</h2>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
						//$tags = get_terms('faq-tag', array('fields'=>'ids') );
						$args = array(
							'post_type' => 'faq',
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'posts_per_page' => 10,
							'tax_query' => array(
								array(
									'taxonomy' => 'faq-type',
									'field' => 'slug',
									'terms' => 'product-questions',
									'operator' => 'IN'
								)
							)
						);
						$loop = new WP_Query($args);
						// The Loop
						//print_r($loop);
						$i = 1;
						while( $loop->have_posts() ) : 
						$loop->the_post();
					?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" class="<?php echo ($i == 1 ? '' : 'collapsed'); ?> accordion-toggle" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                              <?php the_title(); ?> 
                            </a>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo ($i == 1 ? 'in' : ''); ?>" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                           <?php the_content();?>
                          </div>
                        </div>
                      </div>
                    <?php
						$i++;
						endwhile; // end of the loop. 
						wp_reset_postdata();
					?>
                      
                    </div>
                    
                    <h2 id="purchase">Purchase Questions</h2>
            <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                    <?php
						//$tags = get_terms('faq-tag', array('fields'=>'ids') );
						$args = array(
							'post_type' => 'faq',
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'posts_per_page' => 10,
							'tax_query' => array(
								array(
									'taxonomy' => 'faq-type',
									'field' => 'slug',
									'terms' => 'purchase-questions',
									'operator' => 'IN'
								)
							)
						);
						$loop = new WP_Query($args);
						// The Loop
						//print_r($loop);
						$i = 1;
						while( $loop->have_posts() ) : 
						$loop->the_post();
					?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading2<?php echo $i; ?>">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed accordion-toggle" data-parent="#accordion2" href="#collapse2<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                              <?php the_title(); ?> 
                            </a>
                          </h4>
                        </div>
                        <div id="collapse2<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                           <?php the_content();?>
                          </div>
                        </div>
                      </div>
                    <?php
						$i++;
						endwhile; // end of the loop. 
						wp_reset_postdata();
					?>
                      
                    </div>
                    
        </div>
        <div class="col-md-1"></div>
        
            <?php get_sidebar(); ?>
       
    </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>