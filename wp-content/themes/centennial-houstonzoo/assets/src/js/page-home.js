var homeHandler = {
    resizeHero: function() {
        if (Foundation.MediaQuery.is('medium up')) {
            jQuery('.desc-container').each(function() {
                var $desc = jQuery(this);
                var $hero = jQuery('.hero-item-container');
                var $transPanel = jQuery('.hero-transparent-panel');
                var $flickView = jQuery('.flickity-viewport');
                var descPadTop = parseFloat($desc.css('padding-top'));
                var descPadBot = parseFloat($desc.css('padding-bottom'));
                var descHeight = parseFloat($desc.height());
                var newHeight = descPadTop + descPadBot + descHeight ; 
                $hero.css({
                    'height': newHeight+"px"
                });
                $transPanel.css({
                    'height': newHeight+"px"
                });
                $flickView.css({
                    'height': newHeight+"px"
                });
                console.log(newHeight);
            });
        }
    }
}
jQuery(document).ready(function($) {
    $(window).on('resize, load', function() {
        homeHandler.resizeHero();
	}).trigger('resize');
})
