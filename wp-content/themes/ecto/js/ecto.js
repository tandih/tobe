(function( $ ) {

	/**
	* Progressively enhance an off-canvas menu.
	* See: http://heydonworks.com/practical_aria_examples/#hamburger
	*/
	function ectoSlideControl() {
		$( '.js #slide-menu-toggle' ).attr( {
			'role': 'button',
			'aria-controls': 'slide-menu',
			'aria-expanded': 'false'
		} );

		// Do this on open.
		var ectoOpenMenu = function() {
			$( '.js #slide-menu-toggle' ).attr( {
				'aria-expanded': 'true'
			} );
			$( '.js #slide-menu' ).attr( {
				'aria-expanded': 'true',
				'tabindex': '-1'
			} );
		};

		// Do this on close.
		var ectoCloseMenu = function() {
			$( '.js #slide-menu-toggle' ).attr( {
				'aria-expanded': 'false'
			} );
			$( '.js #slide-menu' ).attr( {
				'aria-expanded': 'false'
			} );
			$( '.js #slide-menu' ).removeAttr(
				'tabindex'
			);
		};

		// Toggle all the things on click.
		$( '.js #slide-menu-toggle' ).on( 'click', function( e ) {
			e.preventDefault();
			$( 'body' ).toggleClass( 'sidebar-open' );
			$( this ).attr( 'aria-expanded' ) == 'true' ? ectoCloseMenu() : ectoOpenMenu();
		});
	}

	function ectoManageMenuFocus() {
		// Get element where we need to trap focus.
		var element = $( '.js #slide-menu' );

		// Get all the elements in there.
		var o = element.find( '*' );

		// Store only the elements that would be focusable.
		var focuasable = '.js #slide-menu a[href], #slide-menu area[href], #slide-menu input:not([disabled]), #slide-menu select:not([disabled]), #slide-menu textarea:not([disabled]), #slide-menu button:not([disabled]), #slide-menu iframe, #slide-menu object, #slide-menu embed, #slide-menu *[tabindex], #slide-menu *[contenteditable]';

		// Now, filter through all the elements and get the first focusable item that's visisble.
		var firstFocusable = o.filter( focuasable ).filter(':visible').first();

		// Now, filter through all the elements and get the last focusable item that's visisble.
		var lastFocusable = o.filter( focuasable ).filter(':visible').last();

		// At end of slide menu block, return focus to navigation menu toggle.
		$( lastFocusable ).on( 'keydown', function( e ) {
			if ( e.keyCode === 9 ) {
				if ( ! e.shiftKey ) {
					e.preventDefault();
					$( '.js #slide-menu-toggle' ).focus();
				}
			}
		} );

		// At start of slide menu block, refocus navigation menu toggle on SHIFT+TAB.
		$( '.js #site-navigation li:first a' ).on( 'keydown', function( e ) {
			if ( e.keyCode === 9 ) {
				if ( e.shiftKey ) {
					e.preventDefault();
					$( '.js #slide-menu-toggle' ).focus();
				}
			}
		} );

		// If the menu/sidebar is visible, always TAB into it from the menu button.
		$( '.js #slide-menu-toggle[aria-expanded]' ).on( 'keydown', function( e ) {
			if ( e.keyCode === 9 ) {
				if ( $( this ).attr( 'aria-expanded' ) == 'true' ) {
					if ( ! e.shiftKey ) {
						e.preventDefault();
						$( firstFocusable ).focus();
					} else {
						if ( e.shiftKey ) {
							e.preventDefault();
							$( '#masthead' ).attr( 'tabindex', '-1' ).focus();
						}
					}
				}
			}
		} );

		// Shift focus to slide container, if open.
		$( '.js #slide-menu-toggle' ).on( 'click', function() {
			if ( $( this ).attr( 'aria-expanded' ) == 'true' ) {
				$( '.js #slide-menu' ).focus();
			}
		});
	}

	/**
	* Add smooth page scrolling to page anchor links.
	* See: http://www.paulund.co.uk/smooth-scroll-to-internal-links-with-jquery
	*/
	function ectoSmoothAnchors() {
		$( '.js a[href^="#"]' ).not( '#slide-menu-toggle' ).on( 'click', function ( e ) {
			e.preventDefault();
			var target = this.hash;
			var $target = $( target );

			$( 'html, body' ).stop().animate( {
				'scrollTop': $target.offset().top
			}, 500, 'swing', function () {
				window.location.hash = target;
				$( target ).focus();
			} );
		} );
	}

	$( document ).ready( function() {
		ectoSlideControl();
		ectoSmoothAnchors();
		ectoManageMenuFocus();
	} );
} )( jQuery );
