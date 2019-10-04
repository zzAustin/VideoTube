function postComment(button, postedBy, videoId, replyTo, containerClass) {
	var textarea = $(button).siblings("textarea");
	var commentText = textarea.val();
	textarea.val("");

	if(commentText) {
		$.post("ajax/postComment.php", { commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo})
		.done(function (comment){
			$("." + containerClass).prepend(comment);
		});
	}
	else{
		alert("You can't post empty comment");
	}
}

function toggleReply(button) {
	var parent = $(button).closest(".itemContainer");
	var commentForm = parent.find(".commentForm").first();

	commentForm.toggleClass("hidden");
}

function likeComment(commentId, button, videoId) {
	$.post("ajax/likeComment.php", {commentId: commentId,videoId: videoId}).done(
	function(numToChange){
		var likeButton = $(button); // cast the js button to a jquery butotn
		var dislikeButton = $(button).siblings(".dislikeButton");

		likeButton.addClass("active");
		dislikeButton.removeClass("active");

		likesCount = $(button).siblings(".likesCount");
		updateLikesValue(likesCount, numToChange);

		// update the img of the like/dislike button
		if(numToChange < 0){
			likeButton.removeClass("active");
			likeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
		}
		else{
			likeButton.find("img:first").attr("src", "assets/images/icons/thumb-down-active.png");
		}

		dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
	}
	);
}

function dislikeComment(commentId, button, videoId) {
	$.post("ajax/dislikeComment.php", {commentId: commentId,videoId: videoId}).done(
	function(numToChange){
		var dislikeButton = $(button); // cast the js button to a jquery butotn
		var likeButton = $(button).siblings(".likeButton");

		dislikeButton.addClass("active");
		likeButton.removeClass("active");

		likesCount = $(button).siblings(".likesCount");
		updateLikesValue(likesCount, numToChange);

		// update the img of the like/dislike button
		if(numToChange > 0){
			dislikeButton.removeClass("active");
			dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
		}
		else{
			dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-up-active.png");
		}

		likeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
	}
	);
}

function updateLikesValue(element, num){
	var likesCountVal = element.text() || 0; // get the string form of the current count from the element
	element.text(parseInt(likesCountVal) + parseInt(num));
}