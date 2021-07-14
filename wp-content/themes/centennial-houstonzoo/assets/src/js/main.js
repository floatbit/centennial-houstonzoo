$(document).foundation();

var mainHandler = {
  $menuOpenContainer = $(".menu-open-container"),

  openMenu = function(e){
    $($menuOpenContainer).toggleClass('active');
  }
}

jQuery(document).ready(function($) {

  $('body').on("click", '[href="#menu-open"]', function(e) {
    e.preventDefault;
    mainHandler.openMenu();
	})

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
  
	// Adds Flex Video to YouTube and Vimeo Embeds
  $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
    $(this).parent().addClass('responsive-embed widescreen')
  })

  // debugger
  $(window).on('resize', function() {
    $('.debugger .column-width').html($('.debugger .cell').eq(0).width())
    $('.debugger .gutter-width').html(parseInt($('.debugger .cell').eq(0).css('margin-left')) * 2)
    $('.debugger .container-padding').html(parseInt($('.debugger .grid-container').eq(0).css('padding-left')) * 2)
  }).trigger('resize')

  $('.debugger').on('click', function(e) {
    $(this).remove()
  })

})
