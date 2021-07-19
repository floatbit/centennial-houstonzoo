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

var yearHandler = {

    resizeLookingForwardItems: function() {
        jQuery('.info-item-container').each(function() {
            var arrLeft = [];
            var arrRight = [];
            jQuery('.left-item-content').find('.info-title').each(function(index){
                $content = jQuery(this);
                var contentHeight = parseFloat($content.height());
                var tempArr = [contentHeight, $content];
                arrLeft.push(tempArr);
            })
            jQuery('.right-item-content').find('.info-title').each(function(index){
                $content = jQuery(this);
                var contentHeight = parseFloat($content.height());
                var tempArr = [contentHeight, $content];
                arrRight.push(tempArr);
            })
            $.each(arrLeft, function(index, value) {
                var firstHeight = value[0];
                $firstContent = value[1];
                if (index < arrRight.length) {
                    var secondValue = arrRight[index];
                    var secondHeight = secondValue[0];
                    $secondContent = secondValue[1];
            
                    if (firstHeight > secondHeight) {
                        $secondContent.css({
                            'height': firstHeight+"px"
                        });
                    } else if (firstHeight < secondHeight) {
                        $firstContent.css({
                            'height': secondHeight+"px"
                        });
                    }
                }
            })
        });
      },

    showDescription: function(self) {
        var id = self.getAttribute('data-id');
        var specificId = self.getAttribute('data-specific-id');
        $item = jQuery(".content-container[data-id="+id+"][data-specific-id="+specificId+"]");
        $itemDesc = jQuery(".info-desc[data-id="+id+"][data-specific-id="+specificId+"]");
        $itemContainer = jQuery(".info-item-container");
        
        var nextId = id;
        nextId++;
        $nextItem = jQuery(".content-container[data-id="+nextId+"][data-specific-id="+specificId+"]");
        
        if ($item.hasClass('set-focus')) {
            clearShowDesc();
        } else {
            clearShowDesc();
            $item.addClass('set-focus');
            if ($nextItem.hasClass('next-item')) {
                $nextItem.removeClass('next-item');
            } else {
                $nextItem.addClass('next-item');
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
        }
    },
    onHoverClick: function() {
        var self = this;
        $topContainer = jQuery('#looking-forward').find('.info-item-container');
        jQuery('[href="#show-description"]').on("click", function(e){
            e.preventDefault();
            self.showDescription(this);
        })

        jQuery('#looking-forward').find(".content-container").on("mouseover", function(e){
            e.preventDefault();
            if ($topContainer.hasClass('open-desc')) {
                if (!jQuery(this).hasClass('set-focus')) {
                    var id = this.getAttribute('data-id');
                    var specificId = this.getAttribute('data-specific-id');
                    $showDesc = jQuery(".button-show-desc[data-id="+id+"][data-specific-id="+specificId+"]");
                    $showDesc.click();
                }
            }
        });
        
        jQuery('#looking-forward').find(".info-item-container").on("mouseleave", function(e){
            e.preventDefault();
            if ($topContainer.hasClass('open-desc')) {
                clearShowDesc();
            }
        });
    }
}

jQuery(document).ready(function($) {
    yearHandler.onHoverClick();

    $(window).on('load', function() {
        yearHandler.resizeLookingForwardItems();
    });
})
