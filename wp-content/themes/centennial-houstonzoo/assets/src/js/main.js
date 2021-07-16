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

    self.$menuItem.on("click", function(e){
      e.stopPropagation();
      var selectedId = this.getAttribute('data-id');
      var $menuSelected = $('.menu-item[data-id='+selectedId+']');

      self.$menuItem.removeClass('active');
      $menuSelected.addClass('active');     
    });
  
    $('[href="#menu-open"]').on("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      mainHandler.openMenu();
    });

    $('[href="#share-your-story"]').on("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      if (!self.$menuOpenContainer.hasClass('active')) {
        mainHandler.openMenu();
      }
      self.$contentRight.removeClass('active');
      self.$yourStoryContainer.addClass('active');
      self.$leftSection.addClass('hide-for-small-only');      
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
  $htmlFileUpload = '<li id="field_uploads"></li>',
  $fieldBeforeDynamic = $('#field_1_20'),
  totalsItems = 2,
  yearStart = 2000,

  templateUpload = function(){
    var $items = '';
    var $years = '';
    var currentYear = new Date().getFullYear() + 1;

    for (let i = yearStart; i < currentYear; i++) {
      $years += '<option value="'+i+'">'+i+'</option>';      
    }

    for (let i = 0; i < totalsItems; i++) {
      $items += 
      '<div class="uploads-item" data-id="'+i+'">'+
        '<div class="flex-container">'+
          '<p class="input-field flex-child-auto">'+
            '<input type="file" name="file_upload[]" size="25" accept=".jpg,.png" />'+
          '</p>'+
          '<p class="input-field flex-child-shrink">'+
            '<select name="input_year" id="input_year_'+i+'" class="medium gfield_select select-year" aria-invalid="false">'+
              $years+
            '</select>'+
          '</p>'+
        '</div>'+
        '<label class="gfield_label" for="input_caption_'+i+'">Add a caption</label>'+
        '<textarea name="input_caption" id="input_caption_'+i+'" class="textarea medium" tabindex="16" placeholder="50 words max" aria-invalid="false" rows="10" cols="50"></textarea>'+   
      '</div>';        
    }

    return $items;
  },

  init = function(e) {
    var self = this;
    var name = '', email = '', phone = '', visit = '', visitTime = '', zooMemory = '';
    
    self.$fieldReview = self.$fieldHidden.after($htmlContainer).next();

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

      // uploads handle
      var $uploads = $('body').find('#field_1_20').after($htmlFileUpload).next();
      var $html = self.templateUpload();
      console.log($html);
      $uploads.append($html);
      self.generateSelect();

    });
  }
}

jQuery(document).ready(function($) {

  mainHandler.init();
  gfHandler.init();

  $('.your-zoo-carousel-main').flickity({
		cellSelector: '.carousel-cell',
		cellAlign: 'left',
		draggable: true,
		pageDots: false,
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

  $(window).on('load', function() {
    $('.bg-image-content').each(function() {
      $content = $(this);
      $transPanel = $('.half-transparent-panel');
      var newHeight = parseFloat($content.height());
      $transPanel.css({
        'height': newHeight+"px"
      });
      console.log(newHeight);
    })
  });

/*   $(window).on('load', function() {
    $('.info-item-container').each(function() {
      $leftContent = $(".left-item-content");
      $rightContent = $(".right-item-content");
      $leftItems = $leftContent.className('content-container');
      $rightItems = $rightContent.className('content-container');
      console.log($leftItems);
      console.log($rightItems);
    })
  }); */

  $('[href="#show-description"]').on("click", function(e){
    e.preventDefault();
    var id = this.getAttribute('data-id');
    var specificId = this.getAttribute('data-specific-id');
    $item = $(".content-container[data-id="+specificId+id+"]");
    $itemDesc = $(".info-desc[data-id="+specificId+id+"]");
    $itemContainer = $(".info-item-container");
    
    id++;
    var nextId = id;
    $nextItem = $(".content-container[data-id="+specificId+nextId+"]");
    
    if ($item.hasClass('set-focus')) {
        $item.removeClass('set-focus');
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
