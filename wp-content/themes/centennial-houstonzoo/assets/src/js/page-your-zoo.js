
var yourZooHandler = {

	clearShowProjectDesc: function() {
		if (Foundation.MediaQuery.is('medium up')) {
			if (jQuery(".description-container").hasClass('hide')) {
				jQuery(".description-container").addClass('hide');
			}
		} else if (Foundation.MediaQuery.is('small only')) {
			jQuery("#completed-projects .small-description-container").remove();
		}
	
		if (jQuery(".show-desc").hasClass('is-active')) {
			jQuery(".show-desc").removeClass('is-active');
		}
	
		if (jQuery(".project-item-container").hasClass('set-focus')) {
			jQuery(".project-item-container").removeClass('set-focus');
		}
	
		if (jQuery(".projects-container").hasClass('open-desc')) {
			jQuery(".projects-container").removeClass('open-desc');
		}
	},
	
	showDescription: function() {
		var self = this;
		jQuery('[href="#show-project-desc"]').on("click", function(e){
			e.preventDefault();
			var id = this.getAttribute('data-id');
			var totalItem = this.getAttribute('data-count-item');
			$button = jQuery(".show-desc[data-id="+id+"]");
			$item = jQuery(".description-container[data-id="+id+"]");
			$itemContainer = jQuery("#completed-projects .project-item-container[data-id="+id+"]");
			$itemProjectContainer = jQuery("#completed-projects .projects-container");

			if ($itemContainer.hasClass('set-focus')) {
				self.clearShowProjectDesc();
			} else {
				self.clearShowProjectDesc();
				if (Foundation.MediaQuery.is('medium up')) {
					if ($item.hasClass('hide')) {
						$item.removeClass('hide');
					} else {
						$item.addClass('hide');
					}
				} else if (Foundation.MediaQuery.is('small only')) {
					if ($button.hasClass('is-active')) {
						jQuery("#completed-projects .small-description-container").remove();
					} else {
						var oddEven = id % 2;
						var nextId = id;
						if ((oddEven == 0 && id < (totalItem-1))) {
							nextId++;
						}
						$clonedContent = $item.clone();
						$clonedContent.removeClass('hide');
						var $newCell = document.createElement('div');
						$newCell.className = "cell small-14 small-description-container";
						$theCell = jQuery($newCell).append($clonedContent);
						$itemAfter = jQuery(".project-id-container[data-id="+nextId+"]");
						$itemAfter.after($theCell);
					}
				}

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

				if ($itemProjectContainer.hasClass('open-desc')) {
					$itemProjectContainer.removeClass('open-desc');
				} else {
					$itemProjectContainer.addClass('open-desc');
				}
			}
		});
	}
}

jQuery(document).ready(function($) {
    yourZooHandler.showDescription();

	var maxCarouselHeight = 0;
	$('.your-zoo-carousel-main .bg-image-content').each(function() {
		var cellHeight = $(this).children().height();
		if (cellHeight > maxCarouselHeight) maxCarouselHeight = cellHeight;
	});
	if (maxCarouselHeight > 0) {
		$('.your-zoo-carousel-main .bg-image-content').height(maxCarouselHeight);
	}

	$('.your-zoo-carousel-main').flickity({
		cellSelector: '.carousel-cell',
		cellAlign: 'left',
		draggable: true,
		pageDots: false,
		fade: true,
		hash: false,
		adaptiveHeight: false,
		prevNextButtons: false,
		selectedAttraction: 0.2, 
	}).resize();
})
