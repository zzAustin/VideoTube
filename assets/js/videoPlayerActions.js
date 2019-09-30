function likeVideo(button, videoId) {
	$.post("ajax/likeVideo.php", {videoId: videoId}).done(
		function(data){
			var likeButton = $(button); // cast the js button to a jquery butotn
			var dislikeButton = $(button).siblings(".dislikeButton");

			likeButton.addClass("active");
			dislikeButton.removeClass("active")
		}
		);
}