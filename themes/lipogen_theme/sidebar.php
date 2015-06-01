<div class="page_sidebar col-md-7 col-md-offset-1">
<?php
	if( is_home() || is_single() || is_archive() )
	{
		dynamic_sidebar('blog_sidebar'); 
	} elseif( is_page('contact-us') ) {
		dynamic_sidebar('contact_sidebar'); 
	} elseif( is_page('checkout') ) {
        dynamic_sidebar('order_sidebar');
    } elseif( is_page() && !is_page('contact-us') && !is_page('order-received')) {
		dynamic_sidebar('page_sidebar'); 
	}
?>
</div>