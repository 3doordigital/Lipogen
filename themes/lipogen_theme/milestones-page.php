<?php
/*
Template Name: Milestones
*/
?><?php get_header(); ?>
<div id="content" class="container fullwidth">
	<h1><span><?php the_title(); ?></span></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
        <div class="page_content col-md-24">
        	<div class="mile_intro">
            	<?php the_field('mile_intro'); ?>
            </div>
            <?php
			$i = 0;
			// check if the repeater field has rows of data
			if( have_rows('milestones') ):
				$rows = get_field('milestones');
				$rows = count($rows);
				echo '<div class="container">';
				// loop through the rows of data
				$n = 0;
				while ( have_rows('milestones') ) : the_row();
				?>
					<div class="row milerow <?php echo ($n ==0 ? 'first' : ''); ?> <?php echo ($n == $rows-1 ? 'last' : ''); ?>">
                    	<div class="col-md-10 col-xs-<?php echo ($i == 0) ? '24' : '17'; ?>">
                        	<?php 
                            	if($i==1) {
							?>
                            	<div class="dots left"></div>
                                <div class="mile_image left"><?php echo wp_get_attachment_image(get_sub_field('mile_image'), 'milestones', false,  array('class' => 'img-circle')); ?></div>
                                <div class="mile_text left">
                                    <div class="textwrap">
                                	   <p><?php the_sub_field('mile_text'); ?></p>
                                        <p><a href="<?php the_sub_field('mile_link'); ?>">Read More <i class="fa fa-chevron-right"></i></a></p>
                                    </div>
                                </div>
							<?php			
								}
							?>
                        </div>
                        <div class="col-md-4 col-xs-7"><table width="100%" height="100%"><tr><td valign="middle"><div class="mile_year"><?php the_sub_field('mile_year'); ?></div></td></tr></table></div>
                        <div class="col-md-10 col-xs-17">
                        	<?php 
                            	if($i==0) {
							?>
                            	<div class="dots right"></div>
                            	<div class="mile_image right"><?php echo wp_get_attachment_image(get_sub_field('mile_image'), 'milestones', false,  array('class' => 'img-circle')); ?></div>
                                <div class="mile_text right">
                                    <div class="textwrap">
                                	    <p><?php the_sub_field('mile_text'); ?></p>
                                        <p><a href="<?php the_sub_field('mile_link'); ?>">Read More <i class="fa fa-chevron-right"></i></a></p>
                                    </div>
                                </div>
							<?php		
								}
							?>
                        </div>
                    </div>
				<?php	
                    $i++;
					$n++;
					if($i == 2) $i = 0;	
				endwhile;
				echo '</div>';
			else :
			
				// no rows found
			
			endif;
			
			?>
        </div>
</div>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>