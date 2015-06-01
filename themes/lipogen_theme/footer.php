<!-- Modal -->
<?php
    global $user_identity;
?>
<div class="modal fade review" id="addReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Lipogen PS Plus Review</h4>
            </div>
            <div class="modal-body">
                <div id="review_form_wrapper">
                    <div id="review_form" class="form-horizontal">
                        <?php
                        $commenter = wp_get_current_commenter();

                        $comment_form = array(
                            'title_reply'          => __( '', 'woocommerce' ),
                            'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
                            'comment_notes_before' => '',
                            'comment_notes_after'  => '',
                            'fields'               => array(
                                'author' => '<div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="author" class="col-md-9">' . __( 'Full Name:', 'woocommerce' ) . ' <span class="required">*</span></label>
                                                        <div class="col-md-15">
                                                            <input id="author" class="form-control" name="author" placeholder="Full Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
                                                        </div>
                                                    </div>',
                                'email'  => '<div class="form-group col-md-12">
                                                    <label class="col-md-6" for="email">' . __( 'Email:', 'woocommerce' ) . ' <span class="required">*</span></label>
                                                    <div class="col-md-15">
                                                        <input id="email" placeholder="Email Address" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
                                                        </div>
                                                    </div>
                                                </div>',
                            ),
                            'label_submit'  => __( 'Submit', 'woocommerce' ),
                            'logged_in_as'  => '<div class="row">
                                                        <div class="form-group loggedinas col-md-12 col-xs-24">
                                                            <label class="col-md-9 col-xs-6" >' . sprintf( __( 'Logged in as</label>
                                                            <div class="col-md-15 col-xs-18 login-info">
                                                                <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '
                                                            </div>
                                                        </div>
                                                    </div>',
                            'comment_field' => ''
                        );
                        $comment_form['comment_field'] = '<div class="row">
                                                                <div class="form-group stars col-md-12">
                                                                    <label class="col-md-9" for="review-title">' . __( 'Review Title:', 'woocommerce' ) . ' <span class="required">*</span></label>
                                                                    <div class="col-md-15">
                                                                        <input class="form-control" placeholder="Enter a short summary of your review" id="comment-title" name="comment-title"  aria-required="true" />
                                                                    </div>
                                                                </div>';

                        if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                            $comment_form['comment_field'] .= '<div class="form-group stars col-md-12">
                                                                        <label class="col-md-6" for="review-title">' . __( 'Rating:', 'woocommerce' ) . '</label>
                                                                        <div class="col-md-15">
                                                                            <span>
                                                                                <a class="star-1" rel="1" href="#"><span class="fa fa-star-o"></span></a>
                                                                                <a class="star-2" rel="2" href="#"><span class="fa fa-star-o"></span></a>
                                                                                <a class="star-3" rel="3" href="#"><span class="fa fa-star-o"></span></a>
                                                                                <a class="star-4" rel="4" href="#"><span class="fa fa-star-o"></span></a>
                                                                                <a class="star-5" rel="5" href="#"><span class="fa fa-star-o"></span></a>
                                                                            </span>
                                                                        </div>
                                                                    </div>';
                            $comment_form['comment_field'] .= '<input name="rating" id="rating" type="hidden" value="0"></div>';
                        }

                        $comment_form['comment_field'] .= '<div class="row reviewbox">
                                                                    <div class="col-md-5 col-xs-12">
                                                                        <label for="comment">' . __( 'Your Review:', 'woocommerce' ) . ' <span class="required">*</span></label>
                                                                        <img src="'. get_bloginfo('stylesheet_directory').'/images/review-form-img.jpg" class="img-review" alt=""/>
                                                                    </div>
                                                                    <div class="col-md-19 col-xs-12">
                                                                        <textarea placeholder="Enter your review here" id="comment" class="form-control" name="comment" cols="45" rows="12" aria-required="true"></textarea>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>';

                        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ), 52 );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer">
<nav class="navbar navbar-default" id="footernav"  role="navigation">
  <div class="container-fluid" id="footerbar">
  	<div class="container">
    <div class="row">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-footer">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Copyright Lipogen PS. All Rights Reserved</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <?php if ( function_exists('wp_nav_menu') ) { wp_nav_menu( array(
                'menu'              => 'footer',
                'theme_location'    => 'footer',
                'container'         => 'div',
				//'depth'				=> 1,
                'container_class'   => 'collapse navbar-collapse bs-navbar-collapse2',
        		'container_id'      => 'bs-navbar-footer',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            ); } ?>
  </div><!-- /.container-fluid -->
  </div>
  </div>
</nav>
<section id="legal" class="container-fluid">
	<div class="container">
    <div class="row">
    <div class="col-xs-21 col-sm-22">
	  <?php
      	global $lipo_options;
		echo wpautop($lipo_options['footer_text']);
	  ?>
     </div>
      <div class="col-xs-2 backtotop">
      	<a href="#topbar"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/scroll-top.png" width="37" height="38" alt=""/></a>
      </div>
	</div>
    </div>
</section>
</div>
<?php wp_footer(); ?>
<?php if( is_front_page() ) : ?>
<script type="text/javascript">
            //Function to handle errors
            function displayError(elem){
                var errorMsg = "";
                $(elem + ' li').each(function(index){
                    errorMsg += $(this).text() + "\n";
                })
                alert(errorMsg);
            };
            jQuery(function($) {
				$("#form").parsley({inputs:"input, textarea, select",excluded:"input[type=hidden]",successClass:"input_success",errorClass:"input_error",validateIfUnchanged:true,listeners:{onFormSubmit:function(e,t){if(!e){displayError("#alertBox")}else{$formid=t.target.id;$($formid+" button[type=submit], #form input[type=submit]").attr("disabled",true)}}}});
			});

	$("#form").on("submit", function(e){
	e.preventDefault();
	var data = $(this).serialize();
	data.action = 'newsletter-register';
	$.post("wp-admin/admin-ajax.php", data, function(data, status, jqXHR){ 
		console.log(data);
		var registerSuccessURL = $("input[name=redirect_success]").val();
		window.location.replace(registerSuccessURL);
		}
	);
});
        </script>
<?php endif; ?>

<?php if( is_order_received_page() ) : ?>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 927911112;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "uYSVCNCEkwoQyJm7ugM";
var google_conversion_value = 1.00;
var google_conversion_currency = "USD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/927911112/?value=1.00&amp;currency_code=USD&amp;label=uYSVCNCEkwoQyJm7ugM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endif; ?>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 927911112;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/927911112/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>