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
  $buttonInsideMenu = $('.button-inside-menu'),

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
      self.openMenu();
    });

    $('[href="#share-your-story"]').on("click", function(e) {
      e.preventDefault();
      if (!self.$menuOpenContainer.hasClass('active')) {
        self.openMenu();
      }
      self.$contentRight.removeClass('active');
      self.$yourStoryContainer.addClass('active');
      self.$leftSection.addClass('hide-for-small-only');      
      self.$buttonBack.removeClass('hide');
      self.$buttonInsideMenu.removeClass('hide');
      
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
  $input = $('.ginput_container').find('input[type=text], input[type=email], input[type=tel], input[type=number], textarea[name="input_6"]'),
  $fieldHidden = $('#field_1_12'),
  $fieldReview = [],
  $htmlContainer = '<li id="field_review"></li>',
  $htmlFileUpload = '<li id="field_uploads"></li>',
  $fieldBeforeDynamic = $('#field_1_20'),
  totalsItems = 10,
  yearStart = 2000,
  $htmlHasInputedFile = null,
  $selectIdentifier = $('.ginput_container select'),
  $gformPageFooter = $('.gform_body').find('#gform_previous_button_1'), 
  name = '', email = '', phone = '', 

  templateUpload = function(){
    var $items = '';
    var $years = '<option>Year</option>';
    var currentYear = new Date().getFullYear() + 1;

    for (let i = yearStart; i < currentYear; i++) {
      $years += '<option value="'+i+'">'+i+'</option>';      
    }

    for (let i = 0; i < totalsItems; i++) {  
      $items += 
      '<div class="uploads-item input '+((i>0) ? 'hide': '')+'" data-id="'+i+'">'+
        '<div class="grid-x grid-margin-x grid-input">'+
          '<div class="cell small-7 input-field">'+
            '<input type="file" class="input_file hide" id="input_file_'+i+'" data-id="'+i+'" name="file_upload[]" size="25" accept=".jpg,.png,.giv,.mov" />'+
            '<label class="label-input" data-id="'+i+'" for="input_file_'+i+'">Upload file</label>'+
            '<span class="clear-img" data-id="'+i+'" ></span>'+
          '</div>'+
          '<div class="cell small-5 input-field-cmb">'+
            '<select name="input_year[]" id="input_year_'+i+'" data-id="'+i+'" class="medium gfield_select select-year" aria-invalid="false">'+
              $years+
            '</select>'+
          '</div>'+
        '</div>'+
        '<label class="gfield_label" for="input_caption_'+i+'">Add a caption</label>'+
        '<textarea name="input_caption[]" id="input_caption_'+i+'" data-id="'+i+'"  class="textarea textarea-uploads" tabindex="16" placeholder="50 words max" aria-invalid="false" rows="10" cols="50"></textarea>'+
        ((i+1 == totalsItems) ? '' :
          '<a href="#show-next-item" class="button-plus white"> '+
            '<span class="button-label color-white"> Add another photo or video </span>'+ 
          '</a>')+   
        '<div class="review-container flex-container">'+
          '<p class="file-label button-label color-dark-green" data-id="'+i+'"></p>'+ 
          '<div class="flex-container">'+
            '<a href="#actions-button" class="button btn-act editmode" data-id="'+i+'" >EDIT</a>'+
            '<a href="#delete-item" class="button button-close" data-id="'+i+'" ></a>'+
          '</div>'+
        '</div>'+
      '</div>';        
    }

    return $items;
  },

  comboStyled = function(onlyFunction = false) {
    $('body').find('.ginput_container select, .input-field select, .input-field-cmb select').each(function(){
      var $this = $(this), numberOfOptions = $(this).children('option').length;
      var $name = $this.attr('name');
      
      if (onlyFunction == false) {
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
      } else {
        var $styledSelect = $this.next('div.select-styled');
        var $list = $this.find('.select-options');        
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

  clearItems = function(id, file_only = false) {
    var $currInputFile = $('.input_file[data-id="'+id+'"]');
    var $currInputFileText = $('.file-label[data-id="'+id+'"]');
    var $labelInput = $('.label-input[data-id="'+id+'"]');
    
    $currInputFile.val('');
    $currInputFileText.val('');
    $labelInput.text('Upload file');
    $currInputFile.parent().removeClass('selected');

    if (file_only == false) { 
      var $uploadsItem = $('.uploads-item[data-id="'+id+'"]');
      var $selectedYear =  $('.select-year[data-id="'+id+'"]');
      var $textareaUploads =  $('.textarea-uploads[data-id="'+id+'"]');

      $selectedYear.prop('selectedIndex',0);
      $($selectedYear.parent().find('.select-styled')).text("Year");
      $textareaUploads.val('');
      $uploadsItem.removeClass('selected');
      $uploadsItem.addClass('input');
    }    
  },

  inputHandler = function(id, filename, showNextItem = false) {
    var nextID = parseInt( parseInt(id) + 1 );
    var $fileLabel = $('.file-label[data-id="'+id+'"]');
    var $labelInput = $('.label-input[data-id="'+id+'"]');
    var $uploadsItem = $('.uploads-item[data-id="'+id+'"]');
    var $nextItem = $('.uploads-item[data-id='+nextID+']');
    $fileLabel.text(nextID+'.  '+filename);
    $labelInput.text(filename);
    $labelInput.parent().addClass('selected');

    if ((filename !== '') && (!$uploadsItem.hasClass('edit'))) {
      if (showNextItem) {
        $uploadsItem.addClass('selected');
        $uploadsItem.removeClass('input');  
        $nextItem.removeClass('hide');
      }
    }

    if (filename == '') {
      $labelInput.text('Upload file');
      $labelInput.parent().removeClass('selected');
    }
  },

  onChangeEvents = function(){
    var self = this;
    this.$input.on("change, keyup, input", function(e){
      if (this.name == self.fieldName) {
        self.name = this.value 
      } else if (this.name == self.fieldEmail) {
        self.email = this.value;
      } else if (this.name == self.fieldPhone) {
        self.phone = this.value;
      }
    });
  },

  getFilename = function(id){
    var $obj = $('.input_file[data-id="'+id+'"]');
    
    if ($obj) {
      var tmpName = $obj.val().split('\\').pop();
      var file = $obj[0].files[0];
      var totalSizeMb = 0;
      if (file !== undefined) {
        totalSizeMb = file.size  / Math.pow(1024,2);
      }
      if (tmpName != '') {
        return tmpName  + ' (' + totalSizeMb.toFixed(2) + ' MB)';
      } else {
        return "";
      }
    } else {
      return "";
    }
  },

  init = function(e) {
    var self = this;

    self.$fieldReview = self.$fieldHidden.after($htmlContainer).next();
    self.onChangeEvents();
    self.comboStyled();

    $(document).on('gform_post_render', function (event, form_id, current_page) {
      self.onChangeEvents();
      // fill for review section
      var $rev = $('body').find('#field_1_12').after($htmlContainer).next();
      var visits = '';
      var conn = '';
      var zooMemory = $('body').find('textarea[id="input_1_6"]').val();

      if (self.name) {
        var visit = $('body').find('input[id="input_1_13"]').val();
        var visitTime = $('body').find('select[id="input_1_15"]').find(":selected").text();

        $('body').find('.gfield_checkbox[id="input_1_5"]').children().each(function(){
          var val = $(this).find('input:checked').val();
          if (val) {
            conn += val + ',';
          }
        }); 

        if ( (conn != '') || (visit != '') || (visitTime != '')) {
          visits = '<span class="button-label"> ('+conn+' '+visit+' '+visitTime+')</span>';
        } 
        $rev.append('<div class="form-input-text">'+ self.name + visits+'</div>');
      }
      $rev.append('<p>'+self.email + ', ' + self.phone + '</p>');      
      $rev.append('<p class="zoo-memory"><i>'+zooMemory+'</i></p>');   
      if (self.$htmlHasInputedFile != null) {
        $rev.after().append(self.$htmlHasInputedFile[0]);
      }       

      // uploads handle
      if (self.$htmlHasInputedFile == null) {
        var $uploads = $('body').find('#field_1_20').after($htmlFileUpload).next();
        var $html = self.templateUpload();
        $uploads.append($html); 
        self.comboStyled();
      } else {
        var $uploads = $('body').find('#field_uploads');
        self.comboStyled(true);
      }

      $uploads.children().each(function(){  
        var id = this.getAttribute('data-id');
        var filename = self.getFilename(id);

        if (filename != '') {
          self.inputHandler(id, filename, true);
        }
      });
           
      $uploads.find('[href="#show-next-item"]').on("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).parents()[0].getAttribute('data-id');
        var filename = self.getFilename(id);

        if (filename == '') {
          alert('Cannot add new item, fill current item first.');
        } else {
          self.inputHandler(id, filename, true);
        }
      });
      
      $uploads.find('.clear-img').on("click", function(e) {
        var id = this.getAttribute('data-id');
        $(this).parent().removeClass('selected');
        self.clearItems(id, true);
        self.inputHandler(id, '');
      }); 

      $uploads.find('[href="#actions-button"]').on("click", function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-id');
        var $uploadsItem = $('.uploads-item[data-id="'+id+'"]');
        var filename = self.getFilename(id);
        
        if (filename == '') {
          alert('File must be selected.')
        } else {
          $uploadsItem.toggleClass('edit');
          $uploadsItem.toggleClass('selected');

          if ($uploadsItem.hasClass('edit')) {
            $(this).text('SAVE');
          } else {
            $(this).text('EDIT');
          }
        }
        
      });

      $uploads.find('[href="#delete-item"]').on("click", function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-id');
        if (confirm('Delete Item ?')) {
          self.clearItems(id);         
          $('.uploads-item').removeClass('input');
          $('.uploads-item').not('.selected, [data-id="'+id+'"]').addClass('hide');
          $('.uploads-item[data-id="'+id+'"]').addClass('input');
        }                       
      });
        
      $uploads.find(' input.input_file ').on("change", function() {
        var id = this.getAttribute('data-id');
        var filename = self.getFilename(id);
        self.inputHandler(id, filename);
      });

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
      });
    

      if (self.$htmlHasInputedFile != null) {
        var $inputedData = $('body').find('#field_1_20').after(self.$htmlHasInputedFile).next();

        $inputedData.children().each(function(e){
          var id = this.getAttribute('data-id');
          var count = parseInt( parseInt(id) + 1);
          var $currInputFile = $('.input_file[data-id="'+id+'"]');
          var filename = self.getFilename(id);

          if (filename) {
            var caption = $('.textarea-uploads[data-id="'+id+'"]').val();
            var $html = 
            '<li class="item-review" data-id="'+id+'">'+
              '<div class="review-container flex-container">'+
                '<p class="file-label button-label color-dark-green" data-id="'+id+'" >'+count+'.  '+filename+'</p>'+
                '<div class="flex-container">'+
                  '<a href="#review-edit-button" class="button editmode" data-id="'+id+'" >EDIT</a>'+
                  '<a href="#delete-item" class="button button-close" data-id="'+id+'" ></a>'+
                '</div>'+
              '</div>'+
              '<div class="image-container flex-container">'+
                '<img src="" class="img-review" data-id="'+id+'" >'+
                '<p class="" >'+caption+'</p>'+
              '</div>'+
            '</li>';

            var $obj = $rev.append($html);            
            var reader = new FileReader();
            reader.onload = function (e) {
              $obj.find('.img-review[data-id="'+id+'"]').attr('src', e.target.result);
            }
            reader.readAsDataURL($currInputFile[0].files[0]);
          }
        });

        $rev.find('[href="#review-edit-button"]').on("click", function(e){
          e.preventDefault();
          e.stopPropagation();              
          var id = this.getAttribute('data-id');

          $("#gform_target_page_number_1").val("3");  
          $("#gform_1").trigger("submit",[true]);

          $($('.btn-act[data-id="'+id+'"]')[0]).click();
        });

        $rev.find('[href="#delete-item"]').on("click", function(e){
          e.preventDefault();
          var id = this.getAttribute('data-id');
          
          if (confirm('Delete Item ?')) {
            self.clearItems(id);
            $('.item-review[data-id="'+id+'"]').remove();
          }
        });            
      }

    });

    
  }
}

jQuery(document).ready(function($) {

  mainHandler.init();
  gfHandler.init();

  $(window).on("load, scroll", function() {
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

  $(window).on('resize, load, scroll', function() {
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
