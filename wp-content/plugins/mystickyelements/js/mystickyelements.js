var myfixed_disable_small = parseInt(mysticky_element.mysticky_disable_at_width_string);
var myfixed_click = mysticky_element.myfixed_click_string;

//alert (myfixed_click);

var mybodyWidth = parseInt(document.body.clientWidth);
//alert ( myfixed_disable_small, mysticky_active_on_height );

if (mybodyWidth >= myfixed_disable_small) {

	if (myfixed_click == 'hover') {
		
		
	jQuery(document).ready(function($){	
	
	
	
	/* mysticky blocks animation */
		$('.mysticky-block-left .mysticky-block-icon').hover(function(){
			$(this).parent().stop().animate({'left' : '0px'});
		});

		$('.mysticky-block-left .mysticky-block-content').mouseleave(function(){
			var x = $(this).parent().width();
			$(this).parent().stop().animate({'left': 0 - x});
		});

		$('.mysticky-block-right .mysticky-block-icon').hover(function(){
			$(this).parent().stop().animate({'right' : '0px'});
		});

		$('.mysticky-block-right .mysticky-block-content').mouseleave(function(e){
			var y = $(this).parent().width();
			$(this).parent().stop().animate({'right' : 0 - y});
		});
		

});	
			
		
	};
		
		if (myfixed_click == 'click') {
			
			
		jQuery(document).ready(function($){	
	
	
	/* mysticky blocks animation */
		$('.mysticky-block-left .mysticky-block-icon').click(function(){
			$(this).parent().stop().animate({'left' : '0px'});
		});

		$('.mysticky-block-left .mysticky-block-content').mouseleave(function(){
			var x = $(this).parent().width();
			$(this).parent().stop().animate({'left': 0 - x});
		});

		$('.mysticky-block-right .mysticky-block-icon').click(function(){
			$(this).parent().stop().animate({'right' : '0px'});
		});

		$('.mysticky-block-right .mysticky-block-content').mouseleave(function(e){
			var y = $(this).parent().width();
			$(this).parent().stop().animate({'right' : 0 - y});
		});

				

});			
			
	   };	  
/*	

// add myfixed and wrapfixed class to divs while scroll 
var origOffsetY = mysticky_active_on_height;
var hasScrollY = 'scrollY' in window;
function onScroll(e) {
	

var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
//	y >= origOffsetY  ? mysticky_element.classList.add('myfixed') : mysticky_element.classList.remove('myfixed');
//	y >= origOffsetY  ? wraper_element1.classList.add('fixedelements') : wraper_element1.classList.remove('fixedelements');
//	y >= origOffsetY  ? mysticky_element.style.width = mydivWidth : mysticky_element.style.width = mydivReset;
//	y >= origOffsetY  ? wrappermysticky.style.height = mydivHeight : wrappermysticky.style.height = mydivReset;
}

document.addEventListener('scroll', onScroll);*/


};