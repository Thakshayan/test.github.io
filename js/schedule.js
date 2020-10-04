/* JS Document */

/******************************

[Table of Contents]


1. Set Header Active
2. Set background


******************************/
$(document).ready(function()
{
	"use strict";

	/* 

	1. Set Header Active

	*/

	function setHeaderClass(){
		var activer = document.getElementById("index");
		activer.className += "active";
		
	}
	setHeaderClass();

	/*

	2. Set Background

	*/
	
	function setHeaderBackground(){
		var backImage = document.getElementById("header_background");
		backImage.innerHTML = '<div class="background_image" style="background-image:url(images/About.jpg);"></div>'; 
	}

	setHeaderBackground();

	function dispalyCount(){
		var Counter = document.getElementsByTagName('tr').length-2;
		var footerCount = document.getElementById('result_footer');
		
		footerCount.innerHTML = Counter;
		
	}
	dispalyCount();
});