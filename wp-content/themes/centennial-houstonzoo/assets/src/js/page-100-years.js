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
        $item = jQuery(".content-container[data-id="+specificId+id+"]");
        $itemDesc = jQuery(".info-desc[data-id="+specificId+id+"]");
        $itemContainer = jQuery(".info-item-container");
        
        var nextId = id;
        nextId++;
        $nextItem = jQuery(".content-container[data-id="+specificId+nextId+"]");
        
        //clearShowDesc();
        /* if ($item.hasClass('set-focus')) {
            $item.remove('set-focus');
        } else {
            $item.addClass('set-focus');
        }
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
        } */
        if ($item.hasClass('set-focus')) {
            console.log('yes he does');
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
        jQuery('[href="#show-description"]').on("click", function(e){
            e.preventDefault();
            self.showDescription(this);
        })

        if (jQuery(".info-item-container").hasClass('open-desc')) {
            jQuery('.content-container').on({
                mouseenter: function (e) {
                    e.preventDefault();
                    self.showDescription(this);
                }
            })
        }
    }
}

jQuery(document).ready(function($) {
    yearHandler.onHoverClick();

    $(window).on('load', function() {
        yearHandler.resizeLookingForwardItems();
    });
})
