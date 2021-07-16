$(document).foundation();

var mainHandler = {
  $menuOpenContainer = $(".menu-open-container"),
  $html = $("html"),
  $menuItem = $(".menu-item"),
  $contentRight = $('.content-right'), 
  $yourStoryContainer = $('.your-story-container'),
  $defaultContent = $('.default-content'), 
  $leftSection = $('.left-section'),

  openMenu = function(e){
    this.$menuOpenContainer.toggleClass('active');
    this.$html.toggleClass("disable-scroll");
    this.$yourStoryContainer.removeClass('active');
    this.$defaultContent.addClass('active');
    this.$menuItem.addClass('active');
    this.$leftSection.removeClass('hide-for-small-only');
  },

  init = function(e){
    var self = this;

    self.$menuItem.on("click", function(){
      var selectedId = this.getAttribute('data-id');
      var $menuSelected = $('.menu-item[data-id='+selectedId+']');

      self.$menuItem.removeClass('active');
      $menuSelected.addClass('active');

      if (selectedId == 1) {
        self.$contentRight.removeClass('active');
        self.$yourStoryContainer.addClass('active');
        self.$leftSection.addClass('hide-for-small-only');        
      }
      
    });
    
  }
}

var gfHandler = {
  fieldName = 'input_16',
  fieldPhone = 'input_4',
  fieldEmail = 'input_3',
  fieldVisit = 'input_13',
  fieldVisitTime = 'input_15',
  fieldZooMemory = 'input_6',
  $input = $('.ginput_container').find('input[type=text],input[type=email],input[type=tel],input[type=number]'),
  $fieldHidden = $('#field_1_12'),
  $fieldReview = [],
  $htmlContainer = '<li id="field_review"></li>',

  init = function(e) {
    var self = this;
    var name = '', email = '', phone = '', visit = '', visitTime = '', zooMemory = '';
    
    self.$fieldReview = self.$fieldHidden.after($htmlContainer).next();
    console.log( $fieldReview );

    $input.on("change, keyup", function(e){
      switch (this.name) {
        case fieldName:
          name = this.value 
          break;
        case fieldEmail:
          email = this.value;
          break;
        case fieldPhone:
          phone = this.value;
          break;
        case fieldVisit:
          visit = this.value;
          break;
        case fieldVisitTime:
          visitTime = this.value;
          break;
        case fieldZooMemory: 
          zooMemory = this.value;
          break;
      }
    })

    $(document).on('gform_post_render', function (event, form_id, current_page) {
      var $rev = $('body').find('#field_1_12').after($htmlContainer).next();
      var visits = '';
      if (name) {
        if ( visit && visitTime ) {
          visits = '<span class="">'+visit+', '+visitTime+'</span>';
        }         
        $rev.append('<div class="form-input-text">'+name+visits+'</div>');
      }
      $rev.append('<p>'+email+', '+phone+'</p>');      
      $rev.append('<p>'+zooMemory+'</p>');
      //$rev.append($obj);
      //console.log($obj);

    });

  }

}

jQuery(document).ready(function($) {

  mainHandler.init();
  gfHandler.init();

  $('[href="#menu-open"]').on("click", function(e) {
    e.preventDefault;
    mainHandler.openMenu();
	});

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

  $(window).on("scroll", function() {
    if($(window).scrollTop() > 50) {
        $("header").addClass("scrolled");
        $(".logo-white").addClass("hide");
        $(".logo-black").removeClass("hide");
    } else {
        $("header").removeClass("scrolled");
        $(".logo-black").addClass("hide");
        $(".logo-white").removeClass("hide");
    }
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
