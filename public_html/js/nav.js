jQuery.noConflict();
(function( $ ) {
	var current = (location.pathname + location.search).split("/")[1];
    $('#nav li a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href') == current){
            $this.parent().addClass('active');
        }
    })
})(jQuery);