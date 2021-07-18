function clearShowDesc() {
    if (jQuery(".content-container").hasClass('set-focus')) {
        jQuery(".content-container").removeClass('set-focus');
    }
    if (jQuery(".content-container").hasClass('next-item')) {
        jQuery(".content-container").removeClass('next-item');
    }
    if (jQuery(".info-desc").hasClass('hide')) {
        jQuery(".info-desc").addClass('hide');
    }
    if (jQuery(".info-item-container").hasClass('open-desc')) {
        jQuery(".info-item-container").removeClass('open-desc');
    }
};

var yourZooHandler = {
    showDescription: function() {
        jQuery('[href="#show-project-desc"]').on("click", function(e){
            e.preventDefault();
            var id = this.getAttribute('data-id');
			$button = $(this);
            $item = jQuery(".description-container[data-id="+id+"]");
            $itemContainer = jQuery(".project-item-container[data-id="+id+"]");
            $itemProjectContainer = jQuery(".projects-container");

            console.log($button);
            
            if ($button.hasClass('is-active')) {
                $button.removeClass('is-active');
            } else {
                $button.addClass('is-active');
            }

            if ($itemContainer.hasClass('set-focus')) {
                $itemContainer.removeClass('set-focus');
            } else {
                $itemContainer.addClass('set-focus');
            }

            if ($item.hasClass('hide')) {
                $item.removeClass('hide');
            } else {
                $item.addClass('hide');
            }

            if ($itemProjectContainer.hasClass('open-desc')) {
                $itemProjectContainer.removeClass('open-desc');
            } else {
                $itemProjectContainer.addClass('open-desc');
            }
        });
    }
}

jQuery(document).ready(function($) {
    yourZooHandler.showDescription();
})
