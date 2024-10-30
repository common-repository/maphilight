jQuery.noConflict();
jQuery(function($) {
	var resizeTime = 100;     // total duration of the resize effect, 0 is instant
	var resizeDelay = 100; 
	$('#map').mapster({
		fillColor: map_hilight_args.background_color,
		fillOpacity: map_hilight_args.opacity,
		strokeColor: map_hilight_args.border_color,
		clickNavigate: true
	});
	$(window).bind('resize',onWindowResize);
	// Resize the map to fit within the boundaries provided

	function resize(maxWidth,maxHeight) {
	     var image =  $('#map'),
	        imgWidth = image.width(),
	        imgHeight = image.height(),
	        newWidth=0,
	        newHeight=0;

	    if (imgWidth/maxWidth>imgHeight/maxHeight) {
	        newWidth = maxWidth;
	    } else {
	        newHeight = maxHeight;
	    }
	    image.mapster('resize',newWidth,newHeight,resizeTime);   
	}

	// Track window resizing events, but only actually call the map resize when the
	// window isn't being resized any more

	function onWindowResize() {
	    var curWidth = $('#map').parent().parent().width(),
	        curHeight = $('#map').parent().parent().height(),
	        checking=false;
	    if (checking) {
	        return;
	            }
	    checking = true;
	    window.setTimeout(function() {
	        var newWidth = $('#map').parent().parent().width(),
	           newHeight = $('#map').parent().parent().height();
	        if (newWidth === curWidth &&
	            newHeight === curHeight) {
	            resize(newWidth,newHeight);
	        }
	        checking=false;
	    },resizeDelay );
	}
});