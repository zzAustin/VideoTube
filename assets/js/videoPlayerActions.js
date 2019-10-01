function likeVideo(button, videoId) {
	$.post("ajax/likeVideo.php", {videoId: videoId}).done(
		function(data){
			var likeButton = $(button); // cast the js button to a jquery butotn
			var dislikeButton = $(button).siblings(".dislikeButton");

			likeButton.addClass("active");
			dislikeButton.removeClass("active");
			var result = JSON.parse(data); //data: {likes: deltaLikes, dislikes: deltaDislikes}

			// update the text of the spans of like/dislike button
			updateLikesValue(likeButton.find(".text"), result.likes);
			updateLikesValue(dislikeButton.find(".text"), result.dislikes);

			// update the img of the like/dislike button
			if(result.likes < 0){
				likeButton.removeClass("active");
				likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
			}
			else{
				likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up-active.png");
			}

			dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
		}
		);
}

function dislikeVideo(button, videoId) {
	$.post("ajax/dislikeVideo.php", {videoId: videoId}).done(
		function(data){
			var dislikeButton = $(button); // cast the js button to a jquery butotn
			var likeButton = $(button).siblings(".likeButton");

			dislikeButton.addClass("active");
			likeButton.removeClass("active");
			var result = JSON.parse(data); //data: {likes: deltaLikes, dislikes: deltaDislikes}

			// update the text of the spans of like/dislike button
			updateLikesValue(likeButton.find(".text"), result.likes);
			updateLikesValue(dislikeButton.find(".text"), result.dislikes);

			// update the img of the like/dislike button
			if(result.dislikes < 0){
				dislikeButton.removeClass("active");
				dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
			}
			else{
				dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down-active.png");
			}

			likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
		}
		);
}


function updateLikesValue(element, num){
	var likesCountVal = element.text() || 0; // get the string form of the current count from the element
	element.text(parseInt(likesCountVal) + parseInt(num));
}