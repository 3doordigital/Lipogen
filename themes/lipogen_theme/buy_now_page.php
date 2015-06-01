<?php
/* 
Template Name: Buy Now
*/
?>
<?php get_header(); ?>
<div id="content" class="container fullwidth">
	<h1><span><?php the_title(); ?></span> <img class="shield" src="<?php bloginfo('stylesheet_directory'); ?>/images/shield.png" width="22" height="22" alt=""/></h1>
    <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		   } ?>
    <div class="row buy_now_page">
        <div class="col-md-10">
            <?php the_content(); ?>
            <a href="#" class="productlabellink" data-toggle="modal" data-target="#productLabel" ><img class="alignnone size-full wp-image-67" src="/wp-content/uploads/2014/11/Product-Info.jpg" alt="Product-Info" width="201" height="39"></a>
        </div>
        
        <div id="productcontainer" class="col-md-14 slidebar">
        <div>
                <?php 
                    for($i=1; $i<=3; $i++) { 
                        $product = new WC_Product($lipo_options['product-'.$i.'-link']);
                        $add_to_cart = do_shortcode('[add_to_cart_url id="'.$product->id.'"]');
                        //print_r($product);
                ?>
                <div class="productbox <?php if($i != 2) echo 'prodmatch'; ?> col-md-8 <?php if($i == 2) echo 'highlight' ; ?>">
                	<?php if($i == 2) { ?>
						<img class="most-popular" src="<?php bloginfo('stylesheet_directory'); ?>/images/popular.png" alt="Most Popular" width="63" height="63">
					<?php	}  ?>
                    <h2><?php echo $product->post->post_title; ?></h2>
                    <p class="price">$<?php echo $product->price; ?></p>
                    <p class="orange"><?php echo $lipo_options['product-'.$i.'-supply']; ?></p>
                    <?php echo get_the_post_thumbnail( $product->id, 'buy-now' ); ?> 
                    <p class="orange"><?php echo $lipo_options['product-'.$i.'-offer']; ?></p>
                    <p><?php echo $lipo_options['product-'.$i.'-capsules']; ?></p>
                    <?php if($lipo_options['product-'.$i.'-results'] != '') { ?>
                        <p><?php echo $lipo_options['product-'.$i.'-results']; ?></p>
                    <?php } ?>
                    <p class="moneyback"><span>Money Back Guarantee</span></p>
                    <a href="<?php echo $add_to_cart; ?>" class="btn btn-primary">Add To Basket</a>
                </div>
                <?php } ?>
        </div>
        <div class="clearfix"></div>	
        <div style="text-align:center; margin-top: 30px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/cc.png" alt=""/></div>
    </div>
    </div>
    <div class="row" id="reviewsList">
    	<div class="col-md-10" >
        	<h2>Reviews <button type="button" class="btn btn-default pull-right addReview" data-toggle="modal" data-target="#addReview">Submit Review</button></h2>
            <ul id="reviews">
            <?php
				$args = array ('post_type' => 'product', 'post_id' => 52);
				$comments = get_comments( $args );
				wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments);
			?>
            </ul>
            <!-- Large modal -->
            <!-- Button trigger modal -->

            <div class="modal fade" id="productLabel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <div class="modal-body">
                  	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/product-label.jpg" class="img-responsive" width="842" height="375" alt=""/> 
                  </div>
                </div>
              </div>
            </div>
            
        </div>
        <div class="col-md-14" >
        
        </div>
    </div>
</div>
<?php get_footer(); ?>
