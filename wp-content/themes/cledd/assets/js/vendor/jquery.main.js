jQuery( function() {
	initMobileNav();
} );

// mobile menu init
function initMobileNav() {
	ResponsiveHelper.addRange( {
		'..767': {
			on() {
				jQuery( 'body' ).mobileNav( {
					menuActiveClass: 'nav-active',
					menuOpener: '.nav-opener',
					hideOnClickOutside: true,
					menuDrop: '.header-holder',
				} );
			},
			off() {
				jQuery( 'body' ).mobileNav( 'destroy' );
			},
		},
	} );
}

/*
 * Simple Mobile Navigation
 */
( function( $ ) {
	function MobileNav( options ) {
		this.options = $.extend( {
			container: null,
			hideOnClickOutside: false,
			menuActiveClass: 'nav-active',
			menuOpener: '.nav-opener',
			menuDrop: '.nav-drop',
			toggleEvent: 'click',
			outsideClickEvent: 'click touchstart pointerdown MSPointerDown',
		}, options );
		this.initStructure();
		this.attachEvents();
	}
	MobileNav.prototype = {
		initStructure() {
			this.page = $( 'html' );
			this.container = $( this.options.container );
			this.opener = this.container.find( this.options.menuOpener );
			this.drop = this.container.find( this.options.menuDrop );
		},
		attachEvents() {
			const self = this;

			if ( activateResizeHandler ) {
				activateResizeHandler();
				activateResizeHandler = null;
			}

			this.outsideClickHandler = function( e ) {
				if ( self.isOpened() ) {
					const target = $( e.target );
					if ( ! target.closest( self.opener ).length && ! target.closest( self.drop ).length ) {
						self.hide();
					}
				}
			};

			this.openerClickHandler = function( e ) {
				e.preventDefault();
				self.toggle();
			};

			this.opener.on( this.options.toggleEvent, this.openerClickHandler );
		},
		isOpened() {
			return this.container.hasClass( this.options.menuActiveClass );
		},
		show() {
			this.container.addClass( this.options.menuActiveClass );
			if ( this.options.hideOnClickOutside ) {
				this.page.on( this.options.outsideClickEvent, this.outsideClickHandler );
			}
		},
		hide() {
			this.container.removeClass( this.options.menuActiveClass );
			if ( this.options.hideOnClickOutside ) {
				this.page.off( this.options.outsideClickEvent, this.outsideClickHandler );
			}
		},
		toggle() {
			if ( this.isOpened() ) {
				this.hide();
			} else {
				this.show();
			}
		},
		destroy() {
			this.container.removeClass( this.options.menuActiveClass );
			this.opener.off( this.options.toggleEvent, this.clickHandler );
			this.page.off( this.options.outsideClickEvent, this.outsideClickHandler );
		},
	};

	var activateResizeHandler = function() {
		let win = $( window ),
			doc = $( 'html' ),
			resizeClass = 'resize-active',
			flag, timer;
		const removeClassHandler = function() {
			flag = false;
			doc.removeClass( resizeClass );
		};
		const resizeHandler = function() {
			if ( ! flag ) {
				flag = true;
				doc.addClass( resizeClass );
			}
			clearTimeout( timer );
			timer = setTimeout( removeClassHandler, 500 );
		};
		win.on( 'resize orientationchange', resizeHandler );
	};

	$.fn.mobileNav = function( opt ) {
		const args = Array.prototype.slice.call( arguments );
		const method = args[ 0 ];

		return this.each( function() {
			const $container = jQuery( this );
			const instance = $container.data( 'MobileNav' );

			if ( typeof opt === 'object' || typeof opt === 'undefined' ) {
				$container.data( 'MobileNav', new MobileNav( $.extend( {
					container: this,
				}, opt ) ) );
			} else if ( typeof method === 'string' && instance ) {
				if ( typeof instance[ method ] === 'function' ) {
					args.shift();
					instance[ method ].apply( instance, args );
				}
			}
		} );
	};
}( jQuery ) );

/*
 * Responsive Layout helper
 */
window.ResponsiveHelper = ( function( $ ) {
	// init variables
	let handlers = [],
		prevWinWidth,
		win = $( window ),
		nativeMatchMedia = false;

	// detect match media support
	if ( window.matchMedia ) {
		if ( window.Window && window.matchMedia === Window.prototype.matchMedia ) {
			nativeMatchMedia = true;
		} else if ( window.matchMedia.toString().indexOf( 'native' ) > -1 ) {
			nativeMatchMedia = true;
		}
	}

	// prepare resize handler
	function resizeHandler() {
		const winWidth = win.width();
		if ( winWidth !== prevWinWidth ) {
			prevWinWidth = winWidth;

			// loop through range groups
			$.each( handlers, function( index, rangeObject ) {
				// disable current active area if needed
				$.each( rangeObject.data, function( property, item ) {
					if ( item.currentActive && ! matchRange( item.range[ 0 ], item.range[ 1 ] ) ) {
						item.currentActive = false;
						if ( typeof item.disableCallback === 'function' ) {
							item.disableCallback();
						}
					}
				} );

				// enable areas that match current width
				$.each( rangeObject.data, function( property, item ) {
					if ( ! item.currentActive && matchRange( item.range[ 0 ], item.range[ 1 ] ) ) {
						// make callback
						item.currentActive = true;
						if ( typeof item.enableCallback === 'function' ) {
							item.enableCallback();
						}
					}
				} );
			} );
		}
	}
	win.bind( 'load resize orientationchange', resizeHandler );

	// test range
	function matchRange( r1, r2 ) {
		let mediaQueryString = '';
		if ( r1 > 0 ) {
			mediaQueryString += '(min-width: ' + r1 + 'px)';
		}
		if ( r2 < Infinity ) {
			mediaQueryString += ( mediaQueryString ? ' and ' : '' ) + '(max-width: ' + r2 + 'px)';
		}
		return matchQuery( mediaQueryString, r1, r2 );
	}

	// media query function
	function matchQuery( query, r1, r2 ) {
		if ( window.matchMedia && nativeMatchMedia ) {
			return matchMedia( query ).matches;
		} else if ( window.styleMedia ) {
			return styleMedia.matchMedium( query );
		} else if ( window.media ) {
			return media.matchMedium( query );
		}
		return prevWinWidth >= r1 && prevWinWidth <= r2;
	}

	// range parser
	function parseRange( rangeStr ) {
		const rangeData = rangeStr.split( '..' );
		const x1 = parseInt( rangeData[ 0 ], 10 ) || -Infinity;
		const x2 = parseInt( rangeData[ 1 ], 10 ) || Infinity;
		return [ x1, x2 ].sort( function( a, b ) {
			return a - b;
		} );
	}

	// export public functions
	return {
		addRange( ranges ) {
			// parse data and add items to collection
			const result = { data: {} };
			$.each( ranges, function( property, data ) {
				result.data[ property ] = {
					range: parseRange( property ),
					enableCallback: data.on,
					disableCallback: data.off,
				};
			} );
			handlers.push( result );

			// call resizeHandler to recalculate all events
			prevWinWidth = null;
			resizeHandler();
		},
	};
}( jQuery ) );

// Smooth Scroll
jQuery( 'a[href*="#"]' )
// Remove links that don't actually link to anything
	.not( '[href="#"]' )
	.not( '[href="#0"]' )
	.click( function( event ) {
		// On-page links
		if (
			location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) &&
      location.hostname == this.hostname
		) {
			// Figure out element to scroll to
			let target = $( this.hash );
			target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
			// Does a scroll target exist?
			if ( target.length ) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$( 'html, body' ).animate( {
					scrollTop: target.offset().top,
				}, 1000, function() {
					// Callback after animation
					// Must change focus!
					const $target = $( target );
					$target.focus();
					if ( $target.is( ':focus' ) ) { // Checking if the target was focused
						return false;
					}
					$target.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
					$target.focus(); // Set focus again
				} );
			}
		}
	} );
