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
    $('.carousel-main').flickity({
		cellSelector: '.carousel-cell',
		cellAlign: 'left',
		draggable: false,
		pageDots: true,
		fade: true,
		hash: true,
		prevNextButtons: false,
		selectedAttraction: 0.2, 
	});

    $(window).on('resize, load', function() {
        homeHandler.resizeHero();
	});
})
