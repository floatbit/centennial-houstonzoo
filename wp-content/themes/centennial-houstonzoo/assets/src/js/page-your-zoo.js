var yourZooHandler = {
	showDescription: function() {
		jQuery('[href="#show-project-desc"]').on("click", function(e){
			e.preventDefault();
			var id = this.getAttribute('data-id');
			$button = $(this);
			$item = jQuery(".description-container[data-id="+id+"]");
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
		});
	}
}

jQuery(document).ready(function($) {
    yourZooHandler.showDescription();
})
