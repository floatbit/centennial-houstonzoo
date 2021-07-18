var homeHandler = {
    resizeHero: function() {
        if (Foundation.MediaQuery.is('medium up')) {
            jQuery('.desc-container').each(function() {
                var $desc = jQuery(this);
                var $hero = jQuery('.hero-item-container');
                var descPadTop = parseFloat($desc.css('padding-top'));
                var descPadBot = parseFloat($desc.css('padding-bottom'));
                var descHeight = parseFloat($desc.height());
                var newHeight = descPadTop + descPadBot + descHeight ; 
                $hero.css({
                    'height': newHeight+"px"
                });
                console.log(newHeight);
            });
        }
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
	}).trigger('resize');
})
