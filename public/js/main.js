/** 
 * ===================================================================
 * Main js
 *
 * ------------------------------------------------------------------- 
 */ 

(function($) {

	/* --------------------------------------------------- */
	/* Preloader
	------------------------------------------------------ */ 
   $(window).load(function() {
      // will first fade out the loading animation 
    	$("#loader").fadeOut("slow", function(){

        // will fade out the whole DIV that covers the website.
        $("#preloader").delay(300).fadeOut("slow");

      }); 
  	})

	/* --------------------------------------------------- */
	/*  Vegas Slideshow
	------------------------------------------------------ */
	$(".home-slides").vegas({
		transition: 'fade',
		transitionDuration: 2500,
		delay: 5000,
    	slides: [
       		{ src: "images/slides/03.jpg" },
        	{ src: "images/slides/02.jpg" },
        	{ src: "images/slides/01.jpg" }
    	]
	});
})(jQuery);