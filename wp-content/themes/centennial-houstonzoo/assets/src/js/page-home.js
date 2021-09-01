var homeHandler = {
    resizeHero: function() {
        jQuery('#home').find('.desc-container').each(function() {
            $desc = jQuery(this);
            $hero = jQuery('#home').children('.home-container').find('.hero-item-container');
            $flickView = jQuery('#home').children('.home-container').find('.flickity-viewport');
            var descPadTop = parseFloat($desc.css('padding-top'));
            var descPadBot = parseFloat($desc.css('padding-bottom'));
            var descHeight = parseFloat($desc.height());
            var newHeight = descPadTop + descPadBot + descHeight ;
            var currHeight = Math.round(window.innerHeight / (100 / 100));

            if (newHeight < currHeight) {
                newHeight = currHeight;
            }
            
            $hero.css({
                'height': newHeight+"px"
            });
            $flickView.css({
                'height': newHeight+"px"
            });
        });
    }
}

jQuery(document).ready(function($) {
    var flickityOptions = {
		cellSelector: '.carousel-cell',
		cellAlign: 'left',
		draggable: false,
		pageDots: true,
        autoPlay: 6000,
		fade: true,
        wrapAround: true,
		prevNextButtons: false,
		selectedAttraction: 0, 
	};
    $('.small-home-container .carousel-main').on("select.flickity,ready.flickity", function(event, index) {
        var selectedSlide = $(this).find('.carousel-cell .hero-item-container').eq(index);
        $(this).find('.title-container p').html(selectedSlide.data('slide-title'));
    });
    $('.carousel-main').flickity(flickityOptions);

    $(window).on('resize, load, scroll', function() {
        homeHandler.resizeHero();
	}).trigger("scroll");
})
