var yearHandler = {
    showDescription: function() {
        jQuery('[href="#show-description"]').on("click", function(e){
            e.preventDefault();
            var id = this.getAttribute('data-id');
            $item = jQuery(".content-container[data-id="+id+"]");
            $itemDesc = jQuery(".info-desc[data-id="+id+"]");
            $itemContainer = jQuery(".info-item-container");
            if ($item.hasClass('set-focus')) {
                $item.removeClass('set-focus');
            } else {
                $item.addClass('set-focus');
            }
        
            if ($itemDesc.hasClass('hide')) {
                $itemDesc.removeClass('hide');
            } else {
                $itemDesc.addClass('hide');
            }
        
            if ($itemContainer.hasClass('open-desc')) {
              $itemContainer.removeClass('open-desc');
            } else {
                $itemContainer.addClass('open-desc');
            }
        });
    }
}

jQuery(document).ready(function($) {
    //yearHandler.showDescription();
})
