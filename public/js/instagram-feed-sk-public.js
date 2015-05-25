(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 $( window ).load(function() {
	 	alert('hi');
	  });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

	 $(window).load( function(){
	 	init();
	 });

	 function init(){

// Load masonry layout
	 	var $container = $('.insta_feed_sk_wrapper');
		// initialize Masonry after all images have loaded  
		$container.imagesLoaded( function() {
		  $container.masonry({
		  	itemSelector: '.insta_feed_single_sk'
		  });
		});

// Hover event
		$(".insta_feed_single_sk").hover( hoverOver, hoverOut);
// Open popup with comment and rating
		$(".insta_feed_single_sk").bind("click", openPopup);

		function hoverOver(){
			console.log("hover over");
			$(this).toggleClass("shadow");
			$(this).toggleClass("transparent");
		};
		function hoverOut(){
			console.log("hover out");
			$(this).toggleClass("shadow");
			$(this).toggleClass("transparent");
		}

		function openPopup(e){
			e.preventDefault();
			//get image to display
			var img = $(this).find("img").eq(0).clone();
			var $popupDiv = $(this).parent().next();

	
			$popupDiv.css("display", "block");

			$popupDiv.find(".close").click( function(e){
				e.preventDefault();
				$popupDiv.css("display", "none");
			});

			$popupDiv.find(".insta_feed_sk_img_wrapper").html( img);
			console.log( img);
			console.log( $popupDiv);

		}

	 }





})( jQuery );
