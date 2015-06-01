<?php get_header(); ?>
<section id="masthead" class="container">
    <div class="dv-banner-background">
        <div class="col-md-10 col-md-offset-11" id="mastheaddetail">
            <h1><?php echo $lipo_options['home_product_text']; ?></h1>
            <h2><?php echo $lipo_options['home_product_sub']; ?></h2>
            <p><a href="<?php echo get_permalink($lipo_options['home_product_buy']); ?>" class="btn btn-primary">Buy Now</a></p>
            <p><a href="<?php echo get_permalink($lipo_options['home_product_learn']); ?>" class="btn btn-default">Learn More</a></p>
        </div>
        <div class="home_prod">
            <img src="<?php echo $lipo_options['home_product_image']['url']; ?>" width="<?php echo $lipo_options['home_product_image']['width']; ?>" height="<?php echo $lipo_options['home_product_image']['height']; ?>" alt=""/>
        </div>
        <div id="homeform">
            <form id="form" class="homeform" action="" method="post">
                <span class="fieldRowContainer">
                    RECEIVE YOUR <i>FREE</i> MEMORY IMPROVEMENT GUIDE:
                    <span class="fieldRow">
                        <?php
                            if(isset($_GET['signedup'])) {
                        ?>
                            <input class="input" type="text" value="Thank you for signing up!" disabled />
                            <span class="fieldRowContainer">
                                <span id="btnSubmit">
                                    <input type="submit" class="btn btn-default success" value="Success!" />
                                </span>
                            </span>
                        <?php } else { ?>
                            <input class="input" placeholder="Enter your Email Address" type="text" data-error-container="#alertBox" value="" name="news_email" data-required="true" data-notblank="true" data-error-message="Email Address - obligatory data" data-maxlength="120" data-type="email" />
                        <span class="fieldRowContainer">
                    <span id="btnSubmit">
                        <input type="submit" class="btn btn-default" value="Free Signup" />
                    </span>
                </span>
                        <?php } ?>
                    </span>
                </span>
                <input type="hidden" name="clid" value="526" />
                <input type="hidden" name="lID" value="143" />

                <input type="hidden" name="object" value="mastercampaingleadspost" />
                <input type="hidden" name="reqSource" value="" />
                <input type="hidden" name="backurl" id="backurl" value="" />
                <input type="hidden" name="params" id="params" value="" />
                <input type="hidden" name="params_ga" id="params_ga" value="" />
                <input type="hidden" name="jsOn" id="jsOn" value="false" />
                <!--################### END DON NOT CHANGE ##############################################################-->

                <!-- ANY STRING TO BE RECORDED -->
                <input type="hidden" name="extra_1" id="" value="" />
                <!-- FULL URL FOR REDIRECTING THE USER AFTER A SUCCESS SUBMIT -->
                <input type="hidden" name="redirect_success" id="redirect_success" value="http://lipogen.3doordigital.com/?signedup" />
            </form>
        </div>
    </div>
</section>
<section id="boxes" class="container scroll_load">
<div class="row">
	<div class="col-sm-6 col-xs-24 match">
   		<img src="<?php echo $lipo_options['home_1_image']['url']; ?>" width="<?php echo $lipo_options['home_1_image']['width']; ?>" height="<?php echo $lipo_options['home_1_image']['height']; ?>" class="img-responsive" alt=""/>
        <h2><?php echo $lipo_options['home_1_header']; ?></h2>
        <p><?php echo $lipo_options['home_1_text']; ?></p>
        <p><a href="<?php echo $lipo_options['home_1_link']; ?>" class="btn btn-default">Learn More</a></p>
    </div>
    <div class="col-sm-6 col-xs-24 match">
   		<img src="<?php echo $lipo_options['home_2_image']['url']; ?>" width="<?php echo $lipo_options['home_2_image']['width']; ?>" height="<?php echo $lipo_options['home_2_image']['height']; ?>" class="img-responsive" alt=""/>
        <h2><?php echo $lipo_options['home_2_header']; ?></h2>
        <p><?php echo $lipo_options['home_2_text']; ?></p>
        <p><a href="<?php echo $lipo_options['home_2_link']; ?>" class="btn btn-default">Learn More</a></p>
    </div>
    <div class="col-sm-6 col-xs-24 match">
   		<img src="<?php echo $lipo_options['home_3_image']['url']; ?>" width="<?php echo $lipo_options['home_3_image']['width']; ?>" height="<?php echo $lipo_options['home_3_image']['height']; ?>" class="img-responsive" alt=""/>
        <h2><?php echo $lipo_options['home_3_header']; ?></h2>
        <p><?php echo $lipo_options['home_3_text']; ?></p>
        <p><a href="<?php echo $lipo_options['home_3_link']; ?>" class="btn btn-default">Read More</a></p>
    </div>
    <?php $my_query = new WP_Query( 'post_type=testimonials&posts_per_page=1&orderby=rand' ); ?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
    <div class="col-sm-6 col-xs-24 last match">
   		<div>
        	
            	<a href="#" data-toggle="modal" data-target="#videolink" class="videolink lnk-frontpage-testimonial">
                    <img class="videooverlay" src="<?php bloginfo('stylesheet_directory'); ?>/images/watch-now.png" width="120" height="82" alt=""/>
            	    <?php the_post_thumbnail( 'full', array('class' => 'img-responsive videolink') ); ?>
                </a>
                <h2><?php echo $lipo_options['home_4_header']; ?></h2>
                <?php echo the_content();?>
                <p><a href="#" data-toggle="modal" data-target="#videolink" class="btn btn-default">Watch Video</a></p>
                
               
        	<!--<img src="<?php echo $lipo_options['home_4_image']['url']; ?>" width="<?php echo $lipo_options['home_4_image']['width']; ?>" height="<?php echo $lipo_options['home_4_image']['height']; ?>" class="img-responsive" alt=""/>
        	<h2><?php echo $lipo_options['home_4_header']; ?></h2>
        	<p><?php echo $lipo_options['home_4_text']; ?></p>
            <p><a href="<?php echo get_permalink($lipo_options['home_4_link']); ?>" class="btn btn-default">Watch Video</a></p>
-->        </div>
    </div>
     <div class="modal fade" id="videolink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <div class="modal-body center">
                  <div class="embed-responsive embed-responsive-16by9">
                  	<?php the_field('testi_youtube'); ?>
                    </div>
                    <a href="<?php bloginfo('url'); ?>/buy-now/">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/modal-foot.png" width="373" height="94" alt=""/>
                    </a>
                    
					 or <a href="<?php bloginfo('url'); ?>/testimonials/">See More Testimonials</a>
                  </div>
                </div>
              </div>
            </div>
            
            <?php endwhile; ?>
    </div>
</section>
<div class="modal fade" id="mbgmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <div class="modal-body center">
                  <div class="embed-responsive embed-responsive-16by9">
                  	     <iframe class="embed-responsive-item" width="640" height="480" src="//www.youtube.com/embed/G_F7caEv-F8?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <a href="<?php bloginfo('url'); ?>/buy-now/">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/modal-foot.png" width="373" height="94" alt=""/>
                    </a>
                  </div>
                </div>
              </div>
            </div>
<section id="homeproductarea" class="container scroll_load">
    
  <div class="row">
  	<div class="col-xs-24">
    	<hr>
    </div>
      <a href="#" class="mbg" data-toggle="modal" data-target="#mbgmodal"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/mbg.png" alt=""/></a>
        <div class="col-sm-6 col-xs-24 pic"><img src="<?php echo $lipo_options['homepage_product_image']['url']; ?>" alt=""/></div>
        <div class="col-sm-18 col-xs-24 detail">
        	<h1><?php echo $lipo_options['homepage_product_header']; ?></h1>
            <h2><?php echo $lipo_options['homepage_product_subheader']; ?></h2>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-xs-6"><img src="<?php echo $lipo_options['home_list_1_media']['url']; ?>" alt=""/></div>
                    <div class="col-xs-18">
                    	<h3><?php echo $lipo_options['home_list_1_header']; ?></h3>
                        <h4><?php echo $lipo_options['home_list_1_text']; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-xs-6"><img src="<?php echo $lipo_options['home_list_2_media']['url']; ?>" alt=""/></div>
                    <div class="col-xs-18">
                    	<h3><?php echo $lipo_options['home_list_2_header']; ?></h3>
                        <h4><?php echo $lipo_options['home_list_2_text']; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-xs-6"><img src="<?php echo $lipo_options['home_list_3_media']['url']; ?>" alt=""/></div>
                    <div class="col-xs-18">
                    	<h3><?php echo $lipo_options['home_list_3_header']; ?></h3>
                        <h4><?php echo $lipo_options['home_list_3_text']; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-xs-6"><img src="<?php echo $lipo_options['home_list_4_media']['url']; ?>" alt=""/></div>
                    <div class="col-xs-18">
                    	<h3><?php echo $lipo_options['home_list_4_header']; ?></h3>
                        <h4><?php echo $lipo_options['home_list_4_text']; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('buy_now_footer_section'); ?>
<?php get_footer(); ?>