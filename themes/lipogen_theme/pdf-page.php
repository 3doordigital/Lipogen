<?php
/* 
Template Name: PDF Page
*/
?>
<html>
<body style="padding: 0; margin: 0;">
<?php
    $split = split('/',$_SERVER["REQUEST_URI"]);
    $pdf = $split[2];
    //$attachment_page = wp_get_attachment_url($pdf); 
    $pdfpage = get_page_by_title( $pdf, 'OBJECT', 'attachment' );
    echo '<pre>'.print_r($pdfpage, true).'</pre>';
?>
<iframe style="width: 100%; height: 100%; overflow: hidden;" src="<?php echo $attachment_page; ?>" frameBorder="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>