jQuery(document).ready(function($) {
    $('#show-description').on("click", function(e){
        e.preventDefault();
        var id = this.getAttribute('data-id');
        var $item = $(".content-container[data-id="+$id+"]");
        if ($item.hasClass('set-focus')) {
            $item.removeClass('set-focus');
        } else {
            $item.addClass('set-focus');
        }

        if ($item.find('info-desc').hasClass('hide')) {
            $item.removeClass('hide');
        } else {
            $item.addClass('hide');
        }
    })
})
