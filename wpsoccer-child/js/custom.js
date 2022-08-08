(function($) 
{
	
	$(document).ready(function(){
		$('#yt-video-image').on('click', function(e) {
			$("#yt-video-image").hide();
			/*var videoURL = $("#yt-video-video").find("iframe").attr('src');
			videoURL += "&autoplay=1";
			$('#yt-video-embed').attr('src',videoURL);*/
			
			var videoSrc = $("#yt-video-video").find("iframe").attr("src") + '&autoplay=1';
			$("#yt-video-video").find("iframe").attr('src', videoSrc);
			
			
		});
	});
	$(window).load(function(){
		$('.check-tabs .wpb_tabs_nav + .ui-tabs-panel > .ui-tabs-panel').insertAfter('.check-tabs .wpb_tabs_nav + .ui-tabs-panel');
	})
	
})(jQuery);