/* JS Document */

/******************************

[Table of Contents]


1. Set Header Active
2. Init Home Slider
3. Init Scrolling
4. Init Isotope
5. Init Testimonials Slider


******************************/

$(document).ready(function()
{
	"use strict";

	
	
	initHomeSlider();
	initIsotope();
	initTestimonialsSlider();
	initScrolling();


	/* 

	1. Set Header Active

	*/

	

	/* 

	2. Init Home Slider

	*/

	function initHomeSlider()
	{
		if($('.home_slider').length)
		{
			var homeSlider = $('.home_slider');
			homeSlider.owlCarousel(
			{
				items:1,
				autoplay:false,
				loop:true,
				nav:false,
				dots:false,
				smartSpeed:1200
			});
		}
	}

	/* 

	3. Init Scrolling

	*/

	function initScrolling()
	{
		if($('.home_page_nav ul li a').length)
		{
			var links = $('.home_page_nav ul li a');
	    	links.each(function()
	    	{
	    		var ele = $(this);
	    		var target = ele.data('scroll-to');
	    		ele.on('click', function(e)
	    		{
	    			e.preventDefault();
	    			$(window).scrollTo(target, 1500, {offset: -90, easing: 'easeInOutQuart'});
	    		});
	    	});
		}	
	}

	/* 

	4. Init Isotope

	*/

	function initIsotope()
	{
		if($('.item_grid').length)
		{
			var grid = $('.item_grid').isotope({
				itemSelector: '.item',
	            getSortData:
	            {
	            	price: function(itemElement)
	            	{
	            		var priceEle = $(itemElement).find('.destination_price').text().replace( 'From $', '' );
	            		return parseFloat(priceEle);
	            	},
	            	name: '.destination_title a'
	            },
	            animationOptions:
	            {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	        });
		}
	}

	/* 

	5. Init Testimonials Slider

	*/

	function initTestimonialsSlider()
	{
		if($('.testimonials_slider').length)
		{
			var testSlider = $('.testimonials_slider');
			testSlider.owlCarousel(
			{
				animateOut: 'fadeOut',
    			animateIn: 'flipInX',
				items:1,
				autoplay:true,
				loop:true,
				smartSpeed:1200,
				dots:false,
				nav:false
			});
		}
	}

	
});