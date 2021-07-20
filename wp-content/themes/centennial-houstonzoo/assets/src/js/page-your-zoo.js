var yourZooHandler = {
	showDescription: function() {
		jQuery('[href="#show-project-desc"]').on("click", function(e){
			e.preventDefault();
			var id = this.getAttribute('data-id');
			$item = jQuery(".description-container[data-id="+id+"]");
			if (Foundation.MediaQuery.is('medium up')) {
				$button = $(this);
				$itemContainer = jQuery(".project-item-container[data-id="+id+"]");
				$itemProjectContainer = jQuery(".projects-container");
				
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
			} else if (Foundation.MediaQuery.is('small only')) {
				var oddEven = id % 2;
				if (oddEven > 0 ) {
					id++;
				}
				$newItem = jQuery(".description-container[data-id="+id+"]");
				$clonedContent = $newItem.clone();
				var $newCell = document.createElement('div');
				$newCell.className = "cell small-12";
				$newCell.append($newItem);
				console.log($newCell);
				$itemAfter = jQuery(".project-id-container[data-id="+id+"]");
				$itemAfter.after($newCell);
			}
		});
	}
}

jQuery(document).ready(function($) {
    yourZooHandler.showDescription();

	$('.your-zoo-carousel-main').flickity({
		cellSelector: '.carousel-cell',
		cellAlign: 'left',
		draggable: true,
		pageDots: false,
		fade: true,
		hash: false,
		prevNextButtons: false,
		selectedAttraction: 0.2, 
	}).resize();
})
