/**
*
* -----------------------------------------------------------------------------
*
* Template : CL Testimonial
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/

(function($) {
    "use strict";

    $(".testi-carousels").each(function() {
        var options = $(this).data('carousel-options');
        $(this).owlCarousel(options); 
    }); 
    

})(jQuery);