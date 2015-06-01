<?php
	require_once('admin/admin-init.php');
	require_once('wp_bootstrap_navwalker.php');
	require_once('ajax/newsletter.php');
	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'footer', 'Footer Menu' );
	
	add_theme_support( 'woocommerce' );
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'page-top', 1024, 351, true ); //(cropped)
    add_image_size( 'buy-now', 125, 125, true ); //(not cropped)
	add_image_size( 'blog-top', 653, 200, true ); //(not cropped)
	add_image_size( 'blog-small', 198, 110, true ); //(not cropped)
	add_image_size( 'milestones', 240, 240, true ); //(not cropped)
	
    function modify_post_mime_types( $post_mime_types ) {

        // select the mime type, here: 'application/pdf'
        // then we define an array with the label values

        $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );

        // then we return the $post_mime_types variable
        return $post_mime_types;

    }
 
    // Add Filter Hook
    add_filter( 'post_mime_types', 'modify_post_mime_types' );
 
    
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'seowned' ),
		'id' => 'page_sidebar',
		'before_widget' => '<div class="sidebox">',
		'after_widget' => "</div>",
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'seowned' ),
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="sidebox">',
		'after_widget' => "</div>",
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Contact Sidebar', 'seowned' ),
		'id' => 'contact_sidebar',
		'before_widget' => '<div class="sidebox">',
		'after_widget' => "</div>",
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );

    register_sidebar( array(
        'name' => __( 'Order\'s "Thank You" page Sidebar', 'seowned' ),
        'id' => 'order_sidebar',
        'before_widget' => '<div class="sidebox">',
        'after_widget' => "</div>",
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
	
	function new_excerpt_more($more) {
       global $post;
	   return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Read more...</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	//attach our function to the wp_pagenavi filter
	add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
	function ik_pagination($html) {
		$out = '';
	  
		//wrap a's and span's in li's
		$out = str_replace("<div","",$html);
		$out = str_replace("class='wp-pagenavi'>","",$out);
		$out = str_replace("<a","<li><a",$out);
		$out = str_replace("</a>","</a></li>",$out);
		$out = str_replace("<span","<li><span",$out);  
		$out = str_replace("</span>","</span></li>",$out);
		$out = str_replace("</div>","",$out);
	  
		return '<ul class="pagination pagination-centered">'.$out.'</ul>';
	}
	
	add_action( 'wp_enqueue_scripts', 'enqueue_and_register_my_scripts' );

	function enqueue_and_register_my_scripts(){
		
		wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', '1.0');
		wp_enqueue_style( 'bootstrap_theme', get_stylesheet_directory_uri() . '/css/bootstrap-theme.min.css', '1.0');
		wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', '1.0');
		//wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.css', '1.0');
		
		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery'), '1.0', true );
        //wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.84856.js', array( 'jquery'), '1.0', true );
		wp_enqueue_script( 'images-loaded', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ));
		wp_enqueue_script( 'viewportchecker', get_stylesheet_directory_uri() . '/js/jquery.viewportchecker.js', array( 'jquery' ));
		wp_enqueue_script( 'masonry', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ));
		wp_enqueue_script( 'my-careers-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery', 'bootstrap-js', 'images-loaded'), '1.0', true );
		//wp_enqueue_script( 'parsley', 'https://umc.usearch.co.il/external/resources/js/parsley.js', array( 'jquery' ), '1.0' );
		//wp_enqueue_script( 'umcLeads', 'https://umc.usearch.co.il/external/resources/js/umcLeads.js', array( 'jquery' ), '1.0' );
		
wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );		

		//wp_enqueue_script( 'jquery' );
		
		wp_localize_script( 'my-careers-script', 'ajax_login_object', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => $_SERVER['REQUEST_URI'],
			'loadingmessage' => __('Signing in, please wait...')
		));
		
	}
	
	add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );

	function ajax_login(){
	
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );
	
		// Nonce is checked, get the POST data and sign user on
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;
	
		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
		} else {
			echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
		}
	
		die();
	}
	
	//add this to your functions.php

	add_action('wp_print_styles','lm_dequeue_header_styles');
	function lm_dequeue_header_styles()
	{wp_dequeue_style('yarppWidgetCss');}
	
	add_action('get_footer','lm_dequeue_footer_styles');
	function lm_dequeue_footer_styles()
	{wp_dequeue_style('yarppRelatedCss');}
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	
    
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 16 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_thumbnails', 14 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
	
	function my_theme_wrapper_start() {
	 ?>
     <div class="container">
          <div class="row">
            <div class="col-md-24">
              <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            } ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-24" id="content">
             <?php
            }
            
            function my_theme_wrapper_end() {
              ?>
          </div>
        </div>
        </div>
      <?php 
	}
	
	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

	function custom_override_checkout_fields( $fields ) {
	  unset($fields['billing']['billing_company']);
	  unset($fields['order']['order_comments']);
	  
	  unset($fields['shipping']['shipping_company']);
	  
	  
	  
	  $fields['billing']['billing_address_1']['label'] = 'Street Address';
	  $fields['billing']['billing_city']['label'] = 'City';
	  $fields['billing']['billing_city']['placeholder'] = 'City';
	  $fields['billing']['billing_postcode']['placeholder'] = 'Zip';
	  $fields['shipping']['shipping_address_2']['label'] = 'Address 2';
      $fields['billing']['billing_state']['required'] = true;
      $fields['shipping']['shipping_state']['required'] = true;
	  $fields['account']['account_password']['label'] = 'Password';
	  $fields['shipping']['shipping_address_1']['label'] = 'Street Address';
	  $fields['shipping']['shipping_city']['label'] = 'City';
	  $fields['shipping']['shipping_city']['placeholder'] = 'City';
	  $fields['shipping']['shipping_postcode']['placeholder'] = 'Zip';
	  
        $fields['shipping']['shipping_first_name'] = 
            array(
                'label'     => __('First Name', 'woocommerce'),
                'placeholder'   => _x('', 'placeholder', 'woocommerce'),
                'required'  => false,
                'class'     => array('shipping_first_name'),
                'clear'     => true
            );
        $fields['account']['account_newsletter'] = 
            array(
                'label'     => __('Newsletter Signup', 'woocommerce'),
                'placeholder'   => _x('', 'placeholder', 'woocommerce'),
                'required'  => false,
                'class'     => array('shipping_first_name'),
                'clear'     => true
            );
        $fields['shipping']['shipping_last_name'] = 
            array(
                'label'     => __('Last Name', 'woocommerce'),
                'placeholder'   => _x('', 'placeholder', 'woocommerce'),
                'required'  => false,
                'class'     => array('shipping_last_name'),
                'clear'     => true
            );
        
        
	  unset($fields['billing']['billing_address_2']);
	  unset($fields['billing']['billing_country']);
	  
	  unset($fields['shipping']['shipping_address_2']);
	  unset($fields['shipping']['shipping_country']);
	  
	  return $fields;
	}
	
	add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name",
		"billing_email", 
		"billing_phone",
        "billing_address_1", 
		"billing_city",
		"billing_state", 
        "billing_postcode", 
         
    );
	$order2 = array(
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_address_1", 
		"shipping_city", 
        "shipping_state", 
        "shipping_postcode", 
         
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }
	foreach($order2 as $field)
    {
        $ordered_fields2[$field] = $fields["shipping"][$field];
    }

    $fields["billing"] = $ordered_fields;
	$fields["shipping"] = $ordered_fields2;
    return $fields;

}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['state']['required'] = true;

     return $address_fields;
}

add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
	return $_SERVER["HTTP_REFERER"].'#reviews';
}

add_action( 'comment_post', 'custom_add_comment_rating' , 1 );
function custom_add_comment_rating( $comment_id ) {
	if ( isset( $_POST['comment-title'] ) ) {
		if ( ! $_POST['comment-title'] ) {
			return;
		}
		add_comment_meta( $comment_id, 'comment_title', $_POST['comment-title'], true );
	}
}



// SAVE COMMENT META
// only found this hook to process the POST
add_filter( 'comment_edit_redirect',  'save_comment_admin', 10, 2 );

// META BOX
add_action( 'add_meta_boxes', 'add_custom_box_admin', 0 );

/**
 * Save Custom Comment Field
 * This hook deals with the redirect after saving, we are only taking advantage of it
 */
function save_comment_admin( $location, $comment_id )
{
    // Not allowed, return regular value without updating meta
    if ( !wp_verify_nonce( $_POST['noncename_comment_admin'], plugin_basename( __FILE__ ) )
        && !isset( $_POST['meta_comment_field'] )
    )
        return $location;

    // Update meta
    update_comment_meta(
        $comment_id,
        'comment_title',
        sanitize_text_field( $_POST['comment_title'] )
    );

    // Return regular value after updating
    return $location;
}

/**
 * Add Comment meta box
 */
function add_custom_box_admin() {
    add_meta_box(
        'section_id_comment_admin',
        __( 'Topic/Subject: ' ),
        'inner_custom_box_comment_admin',
        'comment',
        'normal',
        'high'
    );
}

/**
 * Render meta box with Custom Field
 */
function inner_custom_box_comment_admin( $comment )
{
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_comment_admin' );

    $c_meta = get_comment_meta( $comment->comment_ID, 'comment_title', true );
    echo "<input type='text' id='comment_title' name='comment_title' value='",
    esc_attr( $c_meta ),
    "' size='25' />";
}



function tdd_in_cart($product_id) {
	global $woocommerce;
	$i = 0;
	$cart = $woocommerce->cart->get_cart();
	foreach($cart as $values ) {
		if( $product_id == $values['product_id'] ) {
			$i++;
		}
	}	
	if($i ==0) { 
			return false;
		} else {
			return true;
		}
}

class tim_buynow_widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			parent::__construct(
				'tim_product', // Base ID
				__('Buy Now Widget', 'text_domain'), // Name
				array( 'description' => __( 'Shows the buy now widget in the sidebar', 'text_domain' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			?>
            	<div class="row">
                	<div class="col-xs-9">
                    	<img class="buynow_img" src="<?php echo $instance['img_url']; ?>"  />
                    </div>
                    <div class="col-xs-15 buynow_text">
						<p><?php echo  $instance['text']; ?></p>
                   		<p><a href="/buy-now/" class="btn btn-primary">Buy Now</a></p>
                   </div>
                </div>
            <?php
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Try Lipogen PS Plus Today!', 'num' => 3 ) );
            $title = $instance['title'];
            $text = $instance['text'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('text'); ?>">Text: <textarea rows="5" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo attribute_escape($text); ?></textarea></label></p>
            <p><img class="tim_buy_now_img" height="100" width="100" src="<?php echo $instance['img_url']; ?>" style="border: solid 3px #f7f7f7; max-height: 100px; width: auto;" /></p>
            <p><label for="<?php echo $this->get_field_id('img_url'); ?>">Image URL: <input class="widefat tim_buy_now_img_url" type="text" name="<?php echo $this->get_field_name('img_url'); ?>" id="<?php echo $this->get_field_id('img_url'); ?>" value="<?php echo $instance['img_url']; ?>" /></label></p>
            <p><a href="#" class="button tim_image_insert insert-media add_media" title="Add Media">Add Media</a></p>
            
        <?php
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['text'] = $new_instance['text'];
			$instance['img_url'] = $new_instance['img_url'];
            return $instance;
		}
	}
	class tim_testimonial_widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			parent::__construct(
				'tim_testi', // Base ID
				__('Show Testimonial in Sidebar', 'text_domain'), // Name
				array( 'description' => __( 'Shows a testimonial in the sidebar', 'text_domain' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			echo '<h2>Success Stories</h2>';
			echo '<div class="row"><div class="col-md-24">';
			$my_query = new WP_Query( 'post_type=testimonials&posts_per_page=1&orderby=rand' ); 
			while ( $my_query->have_posts() ) : $my_query->the_post();
                    	echo '<a href="#" data-toggle="modal" data-target="#videolink" class="lnk-sidebar-testimonial">
                                <img class="videooverlay" src="http://lipogen.3doordigital.com/wp-content/themes/lipogen_theme/images/watch-now.png" width="120" height="82" alt="">
                                '.get_the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ).'</a>';
						?>
                        	<div class="modal fade" id="videolink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <div class="modal-body">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <?php the_field('testi_youtube'); ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php
					endwhile;
					echo '</div></div>';
					wp_reset_postdata();
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			echo '<p>This widget has no options.</p>';
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			// processes widget options to be saved
		}
	}
	
	class tim_newsletter_widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			parent::__construct(
				'tim_news', // Base ID
				__('Newsletter Signup', 'text_domain'), // Name
				array( 'description' => __( 'Shows the newsletter sign up widget in the sidebar', 'text_domain' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			?>
                	<form id="form" class="newsletter_signup" action="https://umc.usearch.co.il/index.php" method="post">
                    	<h2><?php echo $instance['title']; ?></h2>
                        <span class="fieldRowContainer">
                            <span class="fieldRow">
                        <div class="input-group">
                          <?php
                                if(isset($_GET['signedup'])) {
                            ?>
                            <input type="text" class="form-control " value="Thank you for signing up!" disabled>
                          <span class="input-group-btn" id="btnSubmit">
                            <button class="btn btn-primary success" type="submit"><i class="fa fa-check"></i></button>
                          </span>
                            <?php } else { ?>
                            <input type="text" class="input form-control" placeholder="<?php echo $instance['placeholder']; ?>" data-error-container="#alertBox" value="" name="fieldid[em003]" data-required="true" data-notblank="true" data-error-message="Email Address - שדה חובה" data-maxlength="120" data-type="email">
                          <span class="input-group-btn" id="btnSubmit">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-chevron-right"></i></button>
                          </span>
                            <?php } ?>
                        </div><!-- /input-group -->
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
                        <input type="hidden" name="redirect_success" id="redirect_success" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>?signedup" />
                    </form>
            <?php
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'RECIEVE YOUR FREE MEMORY IMPROVEMENT GUIDE:' ) );
            $title = $instance['title'];
            $placeholder = $instance['placeholder'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('text'); ?>">Placeholder: <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo attribute_escape($placeholder); ?>" /></label></p>
        <?php
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['placeholder'] = $new_instance['placeholder'];
            return $instance;
		}
	}
	
	class tim_address_widget extends WP_Widget {
	
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			parent::__construct(
				'tim_address', // Base ID
				__('Rich Address Widget', 'text_domain'), // Name
				array( 'description' => __( 'Shows the address in the sidebar using rich snippets', 'text_domain' ), ) // Args
			);
		}
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			?>
            	<div itemscope itemtype="http://schema.org/LocalBusiness" class="addressWidget">
                  <span itemprop="name"><?php echo $instance['company']; ?></span><br/>
                  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="streetAddress"><?php echo $instance['street']; ?></span><br/>
                    <span itemprop="addressLocality"><?php echo $instance['locality']; ?></span><br/>
                    <span itemprop="postalCode"><?php echo $instance['postcode']; ?></span><br/>
                  </div>
                </div>
                <div class="embed-responsive embed-responsive-4by3">
                	<?php echo $instance['gmap']; ?>
                </div>
            <?php
			echo $args['after_widget'];
		}
	
		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Address' ) );
            $title = $instance['title'];
            $company = $instance['company'];
			$street = $instance['street'];
			$locality = $instance['locality'];
			$postcode = $instance['postcode'];
			$gmap = $instance['gmap'];
			
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
            <hr/>
            <p><label for="<?php echo $this->get_field_id('company'); ?>">Company Name: <input class="widefat" id="<?php echo $this->get_field_id('company'); ?>" name="<?php echo $this->get_field_name('company'); ?>" type="text" value="<?php echo attribute_escape($company); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('street'); ?>">Street Address: <input class="widefat" id="<?php echo $this->get_field_id('street'); ?>" name="<?php echo $this->get_field_name('street'); ?>" type="text" value="<?php echo attribute_escape($street); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('locality'); ?>">Locality: <input class="widefat" id="<?php echo $this->get_field_id('locality'); ?>" name="<?php echo $this->get_field_name('locality'); ?>" type="text" value="<?php echo attribute_escape($locality); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('postcode'); ?>">Post Code: <input class="widefat" id="<?php echo $this->get_field_id('postcode'); ?>" name="<?php echo $this->get_field_name('postcode'); ?>" type="text" value="<?php echo attribute_escape($postcode); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('gmap'); ?>">Google Map: <textarea rows="6" class="widefat" id="<?php echo $this->get_field_id('gmap'); ?>" name="<?php echo $this->get_field_name('gmap'); ?>"><?php echo attribute_escape($gmap); ?></textarea></label></p>
        <?php
		}
	
		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['company'] = $new_instance['company'];
			$instance['street'] = $new_instance['street'];
			$instance['locality'] = $new_instance['locality'];
			$instance['postcode'] = $new_instance['postcode'];
			$instance['gmap'] = $new_instance['gmap'];
            return $instance;
		}
	}
	
	add_action( 'widgets_init', function(){
		 register_widget( 'tim_buynow_widget' );
		 register_widget( 'tim_testimonial_widget' );
		 register_widget( 'tim_newsletter_widget' );
		 register_widget( 'tim_address_widget' );
         //register_widget( 'tim_recent_posts' );
	});
	function my_enqueue($hook) {
		if ( 'widgets.php' != $hook ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'my_custom_script',  get_stylesheet_directory_uri().'/js/admin-js.js' );
	}
	
	add_action( 'admin_enqueue_scripts', 'my_enqueue' );
	
	add_action('the_post', 'sb_remove_woocommerce_disqus');
	remove_action('pre_comment_on_post', 'dsq_pre_comment_on_post');
	
	function sb_remove_woocommerce_disqus() {
		global $post, $wp_query;
		if (get_post_type() == 'page') { 
			remove_filter('comments_template', 'dsq_comments_template');
		}
	}		

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
 
function my_custom_checkout_field_update_order_meta( $order_id ) {
    update_post_meta( $order_id, '_account_continuity', sanitize_text_field( $_POST['account_continuity'] ) );
    update_post_meta( $order_id, '_account_newsletter', sanitize_text_field( $_POST['account_newsletter'] ) );
} 

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    $cont = get_post_meta( $order->id, '_account_continuity', true );
    echo '<p><strong>'.__('Continutiy Program?').':</strong> ';
    echo ($cont == 1 ? 'Yes' : 'No');
    echo '</p>';
    $news = get_post_meta( $order->id, '_account_newsletter', true );
    echo '<p><strong>'.__('Newsletter?').':</strong> ';
    echo ($news == 1 ? 'Yes' : 'No');
    echo '</p>';
} 
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
function remove_empty_lines( $content ){

  // replace empty lines
  $content = str_replace("     ", " ", $content);

  return $content;
}
add_filter('content_save_pre', 'remove_empty_lines', 10, 1);

function bk_title_order_received( $title, $id ) {
	if ( is_order_received_page() && get_the_ID() === $id ) {
		$title = "Order Received Successfully";
	}

	return $title;
}

add_filter( 'the_title', 'bk_title_order_received', 10, 2 );

function continuity_checkbox_checkout() {
    echo '<div style="margin-left: 40px;" class="checkbox checkbox-primary">
    <input type="checkbox" id="checkbox1" name="account_continuity" value="1">
    <label for="checkbox1">
        Join the Lipogen PS Plus Continuity Program <a href="#" data-toggle="modal" data-target="#continuity_modal"><i class="fa fa-question-circle"></i></a>
    </label>
  </div>
<div class="modal fade" id="continuity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Our Continuity Program</h4>
      </div>
      <div class="modal-body">
          <p>You can now join our continuity program by the selecting the checkbox before completing your purchase.</p>
          <p>Just before your initial supply runs out we’ll send you a 1-month supply of Lipogen PS Plus. Each month thereafter you’ll automatically receive another 1- month supply of Lipogen PS Plus. It will be charged to the same card you use today.</p>
          <p>If you’re not satisfied, you can cancel at anytime by calling our toll-free customer service center at 1-888-748-6955.</p>
      </div>
      
    </div>
  </div>
</div>';
}
add_action( 'woocommerce_review_order_after_payment', 'continuity_checkbox_checkout' );