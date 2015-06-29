<?php 
	global $lipo_options;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(''); ?></title>

<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700|Open+Sans:400,600,300,700,800' rel='stylesheet' type='text/css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>

<script type="text/javascript" language="javascript">
var protocol = document.location.protocol;
if (protocol.indexOf('http') != 0) {protocol = 'http:';}
document.write ('<script type="text/javascript" src="' + protocol + '//live.sekindo.com/live/livePixel.php?id=37"></scr'+'ipt>');
</script>

<?php if( is_front_page() ) : ?>
<script>var $ = jQuery.noConflict();</script>
<script src="https://umc.usearch.co.il/external/resources/js/parsley.js"></script>
<script id="umcJs" src="https://umc.usearch.co.il/external/resources/js/umcLeads.js"></script>
<?php endif; ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php if( is_page('checkout') ) : ?>
<script type="text/javascript" language="javascript">
(function () {
var sNew = document.createElement("script");
sNew.async = true;
var protocol = document.location.protocol;
if (protocol.indexOf('http') != 0) {protocol = 'http:';}
sNew.src = protocol + '//' + 'live.sekindo.com/live/livePixel.php?id=782';
var s0 = document.getElementsByTagName('script')[0];
s0.parentNode.insertBefore(sNew, s0);
})();
</script>
<?php endif; ?>

<?php if( is_order_received_page() ) : ?>
<!-- Facebook Conversion Code for Purchases -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/sdk.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6024613339801', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6024613339801&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

<script type="text/javascript" language="javascript">
(function () {
var sNew = document.createElement("script");
sNew.async = true;
var protocol = document.location.protocol;
if (protocol.indexOf('http') != 0) {protocol = 'http:';}
sNew.src = protocol + '//' + 'live.sekindo.com/live/livePixel.php?id=783';
var s0 = document.getElementsByTagName('script')[0];
s0.parentNode.insertBefore(sNew, s0);
})();

</script>

<script type="text/javascript">
document.write(unescape("%3Cscript src='http://live.sekindo.com/live/liveLead.php?id1=15470&p=[PHONE]&n=[NAME]&e=[EMAIL]&t=[SYNC]' type='text/javascript'%3E%3C/script%3E"));
</script>
<?php endif; ?>



<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-42056731-1', 'auto');
ga('send', 'pageview');

</script>

<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '299963476824448']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);

</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=299963476824448&amp;ev=PixelInitialized" /></noscript>

<style media="screen">
	#masthead div.dv-banner-background {
		background-image: url(<?php echo $lipo_options['home_main_image']['url']; ?>);
	}
</style>
</head>
<body <?php echo body_class(); ?>>
<section id="topbar" class="container-fluid">
	<div class="container">
    	<div class="row">
            <div class="col-md-12 col-xs-24 topleft">
                <div id="topphone" class="pull-left"><i class="fa fa-phone"></i> 
                <?php
                    global $lipo_options;
                    echo $lipo_options['tel_number'];
                ?></div>
                <div id="topsocial" class="pull-left">
                    <?php if (!empty($lipo_options['social_youtube']) && trim(preg_replace('/^(http:\/\/)|(https:\/\/)/', '', $lipo_options['social_youtube'])) !== '') { ?>
                        <a href="<?php echo $lipo_options['social_youtube']; ?>" target="_blank" rel="nofollow" title="Youtube"><i class="fa fa-youtube"></i></a>
                    <?php }
                    if (!empty($lipo_options['social_twitter']) && trim(preg_replace('/^(http:\/\/)|(https:\/\/)/', '', $lipo_options['social_twitter'])) !== '') { ?>
                        <a href="<?php echo $lipo_options['social_twitter']; ?>" target="_blank" rel="nofollow" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <?php }
                    if (!empty($lipo_options['social_facebook']) && trim(preg_replace('/^(http:\/\/)|(https:\/\/)/', '', $lipo_options['social_facebook'])) !== '') { ?>
                        <a href="<?php echo $lipo_options['social_facebook']; ?>" target="_blank" rel="nofollow" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <?php }
                    if (!empty($lipo_options['social_googleplus']) && trim(preg_replace('/^(http:\/\/)|(https:\/\/)/', '', $lipo_options['social_googleplus'])) !== '') { ?>
                        <a href="<?php echo $lipo_options['social_googleplus']; ?>" target="_blank" rel="nofollow" title="Google+"><i class="fa fa-google-plus"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12 col-xs-24 topright">
                <div class="row">
                    <a href="/cart/" class="head-btn col-md-6 col-xs-12" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart"></i> <?php global $woocommerce; echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> (<?php echo $woocommerce->cart->get_cart_total(); ?>)</a>
                    <?php if ( is_user_logged_in() ) { ?>
                        <a class="head-btn col-md-6 col-xs-12" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
                    <?php } else { ?>
                        <a class="head-btn col-md-6 col-xs-12" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login or Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<header id="header" class="container">
<div>
    <div class="col-md-4 dv-logo">
        <div id="logo">
            <a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" width="141" height="62" alt=""/></a>
            <div class="navbar-header pull-right">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
        </div>
    </div>
    <div class="col-md-20 dv-menu">
        <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->


        <!-- Collect the nav links, forms, and other content for toggling -->
            <?php if ( function_exists('wp_nav_menu') ) { wp_nav_menu( array(
                    'menu'              => 'primary',
                    'theme_location'    => 'primary',
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse bs-navbar-collapse2',
                    'container_id'      => 'bs-navbar-collapse2',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                ); } ?>
        </nav>
    </div>
</div>
</header>