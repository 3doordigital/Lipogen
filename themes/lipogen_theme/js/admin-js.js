var image_field;
jQuery(function($){
  $(document).on('click', '.tim_image_insert', function(evt){
    image_field = $(this).siblings('.img');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });
  wp.media.editor.send.attachment = function(props, attachment){
        $('.tim_buy_now_img_url').val(attachment.url);
        $('.tim_buy_now_img').attr('src',attachment.url).css('display','block');
  }
});