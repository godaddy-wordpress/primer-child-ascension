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

	$('.menu-item-has-children > a > span').click(function(e){
		if($(window).width() < 640) {
			e.preventDefault();
			$(this).parent().parent().find( ".sub-menu" ).first().toggle();
		}
	});


	$('.main-navigation li.menu-item-has-children').hover(function() {
    var menu = $(this).find("> .sub-menu");
    var menu_position = $(menu).offset();

		if ( menu_position.left + menu.width() > $(window).width() ) {

			if( $(this).closest(".sub-menu").length > 0 ) {
				var new_position = -$(menu).width();
				menu.css({
					left: new_position
				});
			} else {
				menu.css({
					left: -((menu_position.left + menu.width()) - $(window).width()) - 10
				});
			}

    }
	});

})( jQuery );
