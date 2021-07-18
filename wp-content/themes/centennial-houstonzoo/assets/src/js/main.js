$(document).foundation();
var mainHandler = {
  $menuOpenContainer = $(".menu-open-container"),
  $html = $("html"),
  $menuItem = $(".menu-item"),
  $contentRight = $('.content-right'), 
  $yourStoryContainer = $('.your-story-container'),
  $defaultContent = $('.default-content'), 
  $leftSection = $('.left-section'),
  $buttonBack = $('.button-back'),

  openMenu = function(e){
    this.$menuOpenContainer.toggleClass('active');
    this.$html.toggleClass("disable-scroll");
    this.$yourStoryContainer.removeClass('active');
    this.$defaultContent.addClass('active');
    this.$menuItem.addClass('active');
    this.$leftSection.removeClass('hide-for-small-only');
    this.$buttonBack.addClass('hide');
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
      if (!self.$menuOpenContainer.hasClass('active')) {
        mainHandler.openMenu();
      }
      self.$contentRight.removeClass('active');
      self.$yourStoryContainer.addClass('active');
      self.$leftSection.addClass('hide-for-small-only');      
      self.$buttonBack.removeClass('hide');
      
    });   

    $('[href=#menu-open-back]').on("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      self.$menuItem.addClass('active');
      self.$leftSection.removeClass('hide-for-small-only');            
      self.$contentRight.addClass('active');
      self.$yourStoryContainer.removeClass('active');
      self.$buttonBack.addClass('hide');
    })
  
  }
}

var gfHandler = {
  fieldName = 'input_16',
  fieldPhone = 'input_4',
  fieldEmail = 'input_3',
  fieldVisit = 'input_13',
  fieldVisitTime = 'input_15',
  fieldZooMemory = 'input_6',
  $input = $('.ginput_container').find('input[type=text], input[type=email], input[type=tel], input[type=number]'),
  $inputFile = $('body').find('input_file'),
  $fieldHidden = $('#field_1_12'),
  $fieldReview = [],
  $htmlContainer = '<li id="field_review"></li>',
  $htmlFileUpload = '<li id="field_uploads"></li>',
  $fieldBeforeDynamic = $('#field_1_20'),
  totalsItems = 2,
  yearStart = 2000,
  $htmlHasInputedFile = null,
  $selectIdentifier = $('.ginput_container select'),

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
        '<div class="grid-x">'+
          '<div class="cell small-7 input-field">'+
            '<input type="file" class="input_file" name="file_upload[]" size="25" accept=".jpg,.png" />'+
          '</div>'+
          '<div class="cell small-5 input-field">'+
            '<select name="input_year[]" id="input_year_'+i+'" class="medium gfield_select select-year" aria-invalid="false">'+
              $years+
            '</select>'+
          '</div>'+
        '</div>'+
        '<label class="gfield_label" for="input_caption_'+i+'">Add a caption</label>'+
        '<textarea name="input_caption[]" id="input_caption_'+i+'" class="textarea medium" tabindex="16" placeholder="50 words max" aria-invalid="false" rows="10" cols="50"></textarea>'+   
      '</div>';        
    }

    return $items;
  },

  comboStyled = function(e) {
    $('body').find('.ginput_container select, .input-field select').each(function(){
      var $this = $(this), numberOfOptions = $(this).children('option').length;
      var $name = $this.attr('name');
  
      $this.parent().parent().addClass($name);
      $this.addClass('select-hidden');
      $this.wrap('<div class="select"></div>');
      $this.after('<div class="select-styled"></div>');
      
      var $styledSelect = $this.next('div.select-styled');
      $styledSelect.text($this.children('option').eq(0).text());
  
      var $list = $('<ul />', {
        'class': 'select-options'
      }).insertAfter($styledSelect);
  
      for (var i = 0; i < numberOfOptions; i++) {
      if ($this.children('option').eq(i).is(':selected')) {
        $styledSelect.text($this.children('option').eq(i).text());
      }
      }
  
      $styledSelect.on("click", function(e) {
          e.stopPropagation();
          $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
          });
          var $selectOptions = $(this).closest('.select').find('.select-options').empty();
          for (var i = 0; i < numberOfOptions; i++) {
            if ( $this.children('option').eq(i).text() !== '') {
              var liProps = {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val(),
                class: ($this.children('option').eq(i).attr('disabled') ? 'disabled' : '') + $this.children('option').eq(i).val(),
              };
              $('<li />', liProps).appendTo($selectOptions);
            }
          }			
          $selectOptions.find('li').on("click", function(e) {
            e.stopPropagation();
            if (!$(e.target).is('.disabled')) {
              $styledSelect.removeClass('active');
              $this.val($(this).attr('rel')).trigger("change");
              $selectOptions.hide();		
            }
          });	
      $(this).toggleClass('active').next('ul.select-options').toggle();
      })
  
        $this.on("change", function() {
        // sync select's value with front label
          var currentValue = $this.val();
          $styledSelect.removeClass('selected');
          for (var i = 0; i < numberOfOptions; i++) {
            if ($this.children('option').eq(i).attr('value') == currentValue) {
              $styledSelect.text($this.children('option').eq(i).text());
              if ($this.children('option').eq(i).val()) {
                $styledSelect.addClass('selected');
              }
            }
          }	
        });
  
      $(document).on("click", function() {
      $styledSelect.removeClass('active');
      $list.hide();
      })
    });
  },

  init = function(e) {
    var self = this;
    var name = '', email = '', phone = '', visit = '', visitTime = '', zooMemory = '';

    self.$fieldReview = self.$fieldHidden.after($htmlContainer).next();
    self.$input.on("change, keyup", function(e){
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
    });
    self.comboStyled();

    $(document).on('gform_post_render', function (event, form_id, current_page) {
      var $rev = $('body').find('#field_1_12').after($htmlContainer).next();
      var visits = '';
      if (name) {
        if ( visit && visitTime ) {
          visits = '<span class="">'+visit+', '+visitTime+'</span>';
        }         
        $rev.append('<div class="form-input-text">'+name+visits+'</div>');
      }
      $rev.append('<p>'+email + (phone) ? ', ' : ''+phone+'</p>');      
      $rev.append('<p>'+zooMemory+'</p>');   
      if (self.$htmlHasInputedFile != null) {
        $rev.after().append(self.$htmlHasInputedFile[0]);
      }    

      // uploads handle
      if (self.$htmlHasInputedFile == null) {
        var $uploads = $('body').find('#field_1_20').after($htmlFileUpload).next();
        var $html = self.templateUpload();
        $uploads.append($html);    

        $uploads.children().each(function(){
          var id = this.getAttribute('data-id');
          var $input = $(this).children().children().children()[0];
          var $yearInput = $(this).children().children().children()[1];

          $($input).on("change", function(e){
            var $previewContainer = $('<div id="image-prev-'+id+'" class="gf-image-upload-preview"><div class="remove-button" title="Remove image"></div><img/></div>').appendTo($rev);
            var reader = new FileReader();
            reader.onload = function (e) {
              $previewContainer.find('img').attr('src', e.target.result);
            }
            reader.readAsDataURL( $input.files[0] );	
            self.$htmlHasInputedFile = $uploads;
          });

          $($yearInput).on("change", function(e){
            self.$htmlHasInputedFile = $uploads;
          })
        })
      }

      if (self.$htmlHasInputedFile != null) {
        $('body').find('#field_1_20').after(self.$htmlHasInputedFile);
      }

      self.comboStyled();
    });
  }
}

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
  mainHandler.init();
  gfHandler.init();


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

  $(window).on('resize, load', function() {
    $('.dynamic-content-container').children('.bg-image-content').each(function() {
      $content = $(this);
      var specifiedId = this.getAttribute('data-specified-id');
      $transPanel = $(".half-transparent-panel[data-specified-id="+specifiedId+"]");
      var contentPadTop = parseFloat($content.css('padding-top'));
      var contentPadBot = parseFloat($content.css('padding-bottom'));
      var contentHeight = parseFloat($content.height());
      var newHeight = contentHeight + contentPadTop + contentPadBot;
      $transPanel.css({
        'height': newHeight+"px"
      });
      console.log(newHeight);
    })
  }).trigger('resize');
  
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
