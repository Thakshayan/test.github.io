/* JS Document */

/******************************

[Table of Contents]

1. Set Header Active
2. Set Background



******************************/

$(document).ready(function()
{
	"use strict";

	/* 

	1. Set Header Active

	*/

	function setHeaderClass(){
		var activer = document.getElementById("complain");
		activer.className += "active";
		
	}
	setHeaderClass();

	/*

	2. Set Background

	*/
	
	function setHeaderBackground(){
		var backImage = document.getElementById("header_background");
		backImage.innerHTML = '<div class="background_image" style="background-image:url(images/Complains.jpg);"></div>'; 
	}

	setHeaderBackground();

	
});