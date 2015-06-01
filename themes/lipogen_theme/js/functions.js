var mobile = false;
jQuery(window).resize(function() {
    resizeBanner();
    resizeBuyBanner();
    resizeMilestones();
});
jQuery(document).ready(function($) {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $('body').addClass('mobile');
        mobile = true;
    }

    $('.navbar-collapse li.dropdown').off('click').on('click', function(e) {
        var isShow = false;
        if(!$(this).hasClass('hover')) { isShow = true; }
        $('.navbar-collapse .dropdown.hover').removeClass('hover');
        if(isShow) { $(this).addClass('hover'); }
    });

	function matchHeight(classname,padding) {
        var maxh = 0;
        var height = 0;
        $(classname).each(function () {
            if($(this).html().trim() !== '') {
                $(this).height('auto');
                height = $(this).height();
                if (maxh < height) {
                    maxh = height;
                }
            }
        });

        $(classname).each(function () {
            if($(this).html().trim() !== '') {
                $(this).height(maxh + padding);
            }
        });
        return true;
    }
    imagesLoaded( '.match', function() {
        matchHeight('.match',30);
            $('#boxes .match').each(function(i) {
            $(this).css('visibility', 'visible').hide().fadeIn(2000);
        });
    });
    imagesLoaded( '.matchheight', function() {
        matchHeight('.matchheight',30);
    });
    imagesLoaded( '.prodmatch', function() {
        matchHeight('.prodmatch',45);
    });

    imagesLoaded( '.cartmatch', function() {
        matchHeight('.cartmatch',0);
    });
    if(/*!mobile && */jQuery(window).width() > 535) {
        imagesLoaded( '.milerow>div', function() {
            matchHeight('.milerow>div',0);
        });
        $('.mile_text').each(function() {
            var thisheight = $(this).outerHeight(true) - 15;
            $(this).height('auto');
            $(this).height(thisheight).css('top', '0').css('bottom', '0');
        });
    }
    /*$('.milerow').each(function(i) {
        $(this).delay(800 * i).css('visibility', 'visible').hide().fadeIn(1100);
    });*/

    resizeBuyBanner();

    $('li.lnk-submit-story > a').on('click', function(e) {
        e.preventDefault();
        $('div.modal#addReview').modal('show');
        $('div[id="bs-navbar-collapse2"], div[id="bs-navbar-footer"]').removeClass('in');
    });

    resizeBanner();
    resizeMilestones();

	$('.stars a').hover(
		function(e) {
			//$('.stars a').html('<span class="fa fa-star-o"></span>');
			var rating = parseInt($(this).attr('rel'));
			switch(rating) {
				case 1 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star-o"></span>');
					$('.star-3').html('<span class="fa fa-star-o"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 2 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star-o"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 3 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 4 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 5 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star"></span>');
					$('.star-5').html('<span class="fa fa-star"></span>');
					break;
			}
			$('#rating').val(rating);
		}, function(e) {
			//$('.stars a').html('<span class="fa fa-star-o"></span>');
		}
	);
	$('.stars a').click(function(event) {
		event.preventDefault();
		$('.stars a').html('<span class="fa fa-star-o"></span>');
		//$(this).html('<span class="fa fa-star"></span>');
		var rating = parseInt($(this).attr('rel'));
		//console.log(rating);
		switch(rating) {
			case 1 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star-o"></span>');
					$('.star-3').html('<span class="fa fa-star-o"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 2 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star-o"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 3 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star-o"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 4 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star"></span>');
					$('.star-5').html('<span class="fa fa-star-o"></span>');
					break;
				case 5 :
					$('.star-1').html('<span class="fa fa-star"></span>');
					$('.star-2').html('<span class="fa fa-star"></span>');
					$('.star-3').html('<span class="fa fa-star"></span>');
					$('.star-4').html('<span class="fa fa-star"></span>');
					$('.star-5').html('<span class="fa fa-star"></span>');
					break;
		}

		$('#rating').val(rating);
	});


	$('#homenews').submit(function(event) {
		event.preventDefault();
		var data = $(this).serialize();
		$.post('/wp-content/themes/lipogen_theme/ajax/newsletter.php', data, function(a,b,c) {
			if(a.code == 2) {
				$('#homenews').html(a.text);
			} else {
				$('#homenews').append('<div class="small-alert" role="alert">'+a.text+'</div>');
				$('.small-alert').fadeIn(800).delay(5000).fadeOut(800, function() { $(this).remove(); });
			}
		}, 'json' );
	});

	jQuery('.milerow').addClass("hideme").viewportChecker({
        classToAdd: 'showme animated fadeIn',
        offset: 50,
		repeat: false,
		callbackFunction: function(elem, action){},
		scrollHorizontal: false
    });

    imagesLoaded( '.testibox', function() {
        if(matchHeight('.testibox',0)) {
            $('.testibox').css('visibility', 'visible');
            jQuery('.testibox').addClass("hideme").viewportChecker({
                classToAdd: 'showme animated fadeIn',
                classToRemove: 'hideme',
                offset: 50,
                repeat: false,
                callbackFunction: function(elem, action){},
                scrollHorizontal: false
            });
            /*$('#testimonials').masonry({
                //gutter: 15,
                gutter: ($(window).width() > 1000) ? 15 : ($(window).width() > 768) ? 5 : ($(window).width() > 668) ? 7 : ($(window).width() > 438) ? 10 : 5,
                itemSelector: '.testibox'
            });*/
       }
    });

    imagesLoaded( '.scroll_load', function() {
        jQuery('.scroll_load').addClass("hideme").viewportChecker({
            classToAdd: 'showme animated fadeIn',
            classToRemove: 'hideme',
            offset: 100,
            repeat: false,
            callbackFunction: function(elem, action){},
            scrollHorizontal: false
        });
    });

    $('#videolink').on('hidden.bs.modal', function (e) {
        var video = $("#videolink iframe").attr("src");
        $("#videolink iframe").attr("src","");
        $("#videolink iframe").attr("src",video);
    });

    $('#mbgmodal').on('hidden.bs.modal', function (e) {
        var video = $("#mbgmodal iframe").attr("src");
        $("#mbgmodal iframe").attr("src","");
        $("#mbgmodal iframe").attr("src",video);
    });

    $('form#ajaxlogin').on('submit', function(e){
        $('form#ajaxlogin p.status').show().html(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#ajaxlogin #username').val(),
                'password': $('form#ajaxlogin #password').val(),
                'security': $('form#ajaxlogin #security').val() },
            success: function(data){
                $('form#ajaxlogin p.status').html(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

    var menu = $('#header');
    var origOffsetY = menu.offset().top + 39;

    function scroll() {
        if(!mobile) {
            if ($(window).scrollTop() >= origOffsetY) {
                if ($('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout') || $('body').hasClass('page-template-buy_now_page-php')) {
                } else {
                    $('#header').addClass('sticky');
                    $('#header>div').addClass('container');
                    $('#topbar').addClass('menu-padding');
                }
            } else {
                if ($('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout') || $('body').hasClass('page-template-buy_now_page-php')) {
                } else {
                    $('#header').removeClass('sticky');
                    $('#header>div').removeClass('container');
                    $('#topbar').removeClass('menu-padding');
                }
            }
        }
    }
    document.onscroll = scroll;

	function centerModal() {
		$(this).css('display', 'block');
		var $dialog = $(this).find(".modal-dialog");
		var offset = ($(window).height() - $dialog.height()) / 2;
		// Center modal vertically in window
        offset = (offset < 0) ? 15 : offset;
		$dialog.css("margin-top", offset);
	}

	$('.modal').on('show.bs.modal', centerModal);
	$(window).on("resize", function () {
		$('.modal:visible').each(centerModal);
	});

	$('.updatecart').hover(function() {
		$('.updatecart span.fa').addClass('fa-spin');
	}, function() {
		$('.updatecart span.fa').removeClass('fa-spin');
	});

});
jQuery('[data-toggle="popover"]').popover();

function resizeBanner() {
    var banner = jQuery('section#masthead');
    if (banner !== undefined && banner !== null){
        var form_height = 0;
        var form = banner.find('form#form');
        if (form !== undefined && form !== null) {
            var height = form.css('height');
            if (height !== undefined && height !== null) {
                form_height = parseInt(height.replace('px', ''), 10);
            }
        }
        var calc_height = (banner.width() / (1062 / 441));
        var margins = 0;
        if(jQuery(window).width() < 785) {
            margins = 100;
            jQuery('#mastheaddetail p').css('margin-top', (calc_height + 2) + 'px');
        } else {
            jQuery('#mastheaddetail p').css('margin-top', '0');
        }
        banner.css('height', (calc_height + form_height - 1 + margins) + 'px');
    }
}

function resizeBuyBanner() {
    if(!mobile && jQuery(window).width() > 980) {
        var delay = 800, animationSpeed = 1100;
        jQuery('.productbox').addClass('hiddenForAnimation').each(function(i){
            jQuery(this).delay(delay * i).fadeIn(animationSpeed, function(){
            }).delay(200, function(event) {
                var offset = jQuery('#productcontainer').offset();
                var height = jQuery('#productcontainer').outerHeight(true);
                height = 510;
                var footer = jQuery('#footer').outerHeight(true);
                var bottom = offset.top + height;
                var offset2 = jQuery('#footer').offset();
                var liveoffset = jQuery('#productcontainer').offset();
                var abspos = offset2.top-height;
                jQuery(window).scroll(function () {
                    jQuery('#productcontainer.slidebar').removeClass('fixedbottom').css({top: ''});
                    liveoffset = $('#productcontainer').offset();
                    bottom = liveoffset.top + height;

                    var scrollTop = jQuery(window).scrollTop() + 30;
                    if (offset.top < scrollTop) {
                        jQuery('#productcontainer.slidebar').addClass('fixed');
                    } else {
                        jQuery('#productcontainer.slidebar').removeClass('fixed');
                    }
                    if (bottom >= offset2.top) {
                        jQuery('#productcontainer.slidebar').addClass('fixedbottom').css({top: abspos});
                    } else {
                        jQuery('#productcontainer.slidebar').removeClass('fixedbottom').css({top: ''});
                    }
                    //console.log('Bottom: '+bottom+' Offset2: '+offset2.top+' Height: '+height+' Liveoffset: '+liveoffset.top+' abspos: '+abspos+'Footer: '+footer);
                });
            });
        });
    }
}

function resizeMilestones() {
    if(mobile && jQuery(window).width() < 535) {
        var rows = jQuery('.row.milerow');
        if(rows !== undefined && rows !== null) {
            jQuery.each(rows, function (k, v) {
                var item = jQuery(v).find('div.col-xs-7');
                if(item !== undefined && item !== null) {
                    var h = (jQuery(v).height() - jQuery(item).height()) / 2;
                    jQuery(item).css('margin-top', h + 'px');
                }
            });
        }
    }
}