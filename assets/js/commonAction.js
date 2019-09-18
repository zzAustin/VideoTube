$(document).ready(function(){
	$(".navShowHide").on("click", function(){
		var main = $("#mainSectionContainer");
		var nav = $("#sideNavContainer");

		if(main.hasClass("leftPadding")) // this is a bit confusing, well if it now has "leftPadding", then it means next it will lose it, so we need to hide nav bar.
		{
			nav.hide();
		}
		else
		{
			nav.show();
		}

		main.toggleClass("leftPadding");

	});
});