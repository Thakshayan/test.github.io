/* JS Document */

/******************************

[Table of Contents]


1. Set Header Active

2. Set Background

3. Init Milestones


******************************/

$(document).ready(function()
{
	"use strict";

	var ctrl = new ScrollMagic.Controller();
	initMilestones();

	/* 

	1. Set Header Active

	*/

	function setHeaderClass(){
		var activer = document.getElementById("about");
		activer.className += "active";
		
	}
	setHeaderClass();



	/* 

	2. Set Background

	*/
	
	function setHeaderBackgroundImage(){
		var backImage = document.getElementById("header_background");
		backImage.innerHTML = '<div class="background_image" style="background-image:url(images/About.jpg);"></div>'; 
	}

	setHeaderBackgroundImage();



	/*

	3. Initialize Milestones

	*/

	function initMilestones()
	{
		if($('.milestone_counter').length)
		{
			var milestoneItems = $('.milestone_counter');

	    	milestoneItems.each(function(i)
	    	{
	    		var ele = $(this);
	    		var endValue = ele.data('end-value');
	    		var eleValue = ele.text();

	    		/* Use data-sign-before and data-sign-after to add signs
	    		infront or behind the counter number (+, k, etc) */
	    		var signBefore = "";
	    		var signAfter = "";

	    		if(ele.attr('data-sign-before'))
	    		{
	    			signBefore = ele.attr('data-sign-before');
	    		}

	    		if(ele.attr('data-sign-after'))
	    		{
	    			signAfter = ele.attr('data-sign-after');
	    		}

	    		var milestoneScene = new ScrollMagic.Scene({
		    		triggerElement: this,
		    		triggerHook: 'onEnter',
		    		reverse:false
		    	})
		    	.on('start', function()
		    	{
		    		var counter = {value:eleValue};
		    		var counterTween = TweenMax.to(counter, 4,
		    		{
		    			value: endValue,
		    			roundProps:"value", 
						ease: Circ.easeOut, 
						onUpdate:function()
						{
							document.getElementsByClassName('milestone_counter')[i].innerHTML = signBefore + counter.value + signAfter;
						}
		    		});
		    	})
			    .addTo(ctrl);
	    	});
		}
	}
});