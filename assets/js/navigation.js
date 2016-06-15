/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
(function($) {

	$('.menu-toggle').click(function(e) {
		e.preventDefault();
		$('#site-navigation').toggle();
	})

	$('.menu-item-has-children > a').click(function(e){
		if($(window).width() < 640) {
			e.preventDefault();
			$(this).parent().find( ".sub-menu" ).first().toggle();
		}
	});

})( jQuery );
