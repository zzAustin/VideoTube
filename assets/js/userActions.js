function subscribe(userTo, userFrom, button) {
	if(userTo == userFrom) {
		alert("You can't subscribe to yourself");
		return;
	}

	$.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
	.done(function(count) {
		if(count != null) {
			$(button).toggleClass("subscribe unsubscribe"); // remove existing one and add non-existing one(also remember button is casted to jqurey button)
			var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
			$(button).text(buttonText + " " + count);
		}
		else{
			alert("Something went wrong");
		}
	});
}