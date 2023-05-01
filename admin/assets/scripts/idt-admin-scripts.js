//--------------------------------------
// Scripts generales del administrador del tema
//--------------------------------------
( function( $ ) {

	/**
	 * Manejador de eventos del menú
	 */
	$( document ).ready( function() {
		var adminPage = $( '#idt-admin-tpl-dashboard' );
		if ( !adminPage.length ) return;

		var tplTarget = adminPage.find( '.idt-admin-content' );
		var adminMenu = adminPage.find( '.idt-admin-menu' );

		adminMenu.find( '.item' ).click( function () {
			var item = $( this );
			var tpl = 	item.data( 'template' );

			adminMenu.find( '.item' ).removeClass( 'active' );
			item.addClass( 'active' );

			getAdminTemplate( tpl, tplTarget );

		} );

	} );

	/**
	 * Controlador para la barra de opciones del administrador
	 */
	$( document ).ready( function() {
		var adminPage = $( '#idt-admin-tpl-dashboard' );
		if ( !adminPage.length ) return;

		adminPage.on( 'click', '.idt-admin-toolbar .idt-save-settings', function ( e ) {
			e.preventDefault();
			var section = $( this ).data( 'section' );
			var values = getSettingsValues( section );
			saveSettings( values );
		} );

	} );

	/**
	 * Controlador para el componente de subida de imagenes del administrador
	 */
	$( document ).ready( function() {
		var container = $( '#idt-admin-tpl-dashboard' );
		if ( !container.length ) return;

		container.on( 'click', '.idt-btn-upload-image', function ( e ) {
			e.preventDefault();
			var imageManagerContainer = $( this ).closest( '.idt-image-manager' );
			var imagePreview = imageManagerContainer.find( '.idt-image-preview' );
			var imageId = imageManagerContainer.find( '.idt-image-id' );
			var imageUrl = imageManagerContainer.find( '.idt-image-url' );

			var fileFrame;
			var wpMediaPostId = wp.media.model.settings.post.id;
			var setToPostId = imageManagerContainer.find( '.idt-image-id' ).val();

			if ( fileFrame ) {
				// Set the post ID to what we want
				fileFrame.uploader.uploader.param( 'post_id', setToPostId );
				// Open frame
				fileFrame.open();
				return;
			}
			else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = setToPostId;
			}

			// Create the media frame.
			fileFrame = wp.media.frames.file_frame = wp.media( {
				title: ajaxObject.langMediaUploadTitle,
				button: {
					text: ajaxObject.langMediaUploadButton
				},
				multiple: false	// Set to true to allow multiple files to be selected
			} );

			// When an image is selected, run a callback.
			fileFrame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var attachment = fileFrame.state().get( 'selection' ).first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				imagePreview.css( 'background-image', 'url(' + attachment.url + ')' );
				imageUrl.val( attachment.url );
				imageId.val( attachment.id );
				// Restore the main post ID
				wp.media.model.settings.post.id = wpMediaPostId;
			});

			// Finally, open the modal
			fileFrame.open();

		} );

		// Restore the main ID when the add media button is pressed
		$( 'a.add_media' ).on( 'click', function() {
			wp.media.model.settings.post.id = wpMediaPostId;
		});
	});

	/**
	 * Devuelve los valores de la seccion de configuraciones a guardar
	 * @param {string} section nombre de la sección de configuraciones.
	 * @return object objeto con los valores de las configuraciones a guardar
	 */
	function getSettingsValues( section = '' ) {

		if ( section === '' ) {
			values = 'tpl-not-found';
		}
		var values = {};
		var container = $( '#idt-admin-tpl-dashboard' );

		switch ( section ) {
			case 'logos':
				var logosContainer = container.find( '#idt-admin-logos' );
				var logoId = logosContainer.find( '#idt-logo-id' ).val();
				var logoUrl = logosContainer.find( '#idt-logo-url' ).val();

				values = {
					section: 'logos',
					settings: {
						default: [
							parseInt( logoId ),
							logoUrl
						]
					}
				};
				break;
			case 'menu':
				var menuContainer = container.find( '#idt-admin-menu' );
				var active_dropdown = menuContainer.find( '#idt-check-drop-down-mobile' ).is(":checked");
				values = {
					section: 'menu',
					settings: {
						active_dropdown: active_dropdown
					}
				};
				break;
			case 'blog':
				var blogContainer = container.find( '#idt-admin-blog' );
				var bannerId = blogContainer.find( '#idt-blog-banner-id' ).val();
				var bannerUrl = blogContainer.find( '#idt-blog-banner-url' ).val();
				var postsImageId = blogContainer.find( '#idt-posts-image-id' ).val();
				var postsImageUrl = blogContainer.find( '#idt-posts-image-url' ).val();

				values = {
					section: 'blog',
					settings: {
						banner: {
							bannerId: parseInt( bannerId ),
							bannerUrl: bannerUrl
						},
						posts: {
							postsImageId: parseInt( postsImageId ),
							postsImageUrl: postsImageUrl
						}
					}
				};
				break;
			case 'social':
				var socialContainer = container.find( '#idt-admin-social' );
				var facebook = socialContainer.find( '#idt-facebook-url' ).val();
				var instagram = socialContainer.find( '#idt-instagram-url' ).val();
				var twitter = socialContainer.find( '#idt-twitter-url' ).val();
				var youtube = socialContainer.find( '#idt-youtube-url' ).val();
				var whatsapp = socialContainer.find( '#idt-whatsapp-url' ).val();
				var linkedin = socialContainer.find( '#idt-linkedin-url' ).val();

				values = {
					section: 'social',
					settings: {
						default: [
							facebook,
							instagram,
							twitter,
							youtube,
							whatsapp,
							linkedin
						]
					}
				};
				break;
			case 'taxonomies':
				var taxonomiesContainer = container.find( '#idt-admin-taxonomies' );
				var portfolio = taxonomiesContainer.find( '#idt-active-taxonomy-portfolio' ).val();
				var testimony = taxonomiesContainer.find( '#idt-active-taxonomy-testimony' ).val();
				var team = taxonomiesContainer.find( '#idt-active-taxonomy-team' ).val();
				var gallery = taxonomiesContainer.find( '#idt-active-taxonomy-gallery' ).val();
				var client = taxonomiesContainer.find( '#idt-active-taxonomy-client' ).val();
				var value = taxonomiesContainer.find( '#idt-active-taxonomy-value' ).val();

				values = {
					section: 'taxonomies',
					settings: {
						active: [
							portfolio,
							testimony,
							team,
							gallery,
							client,
							value
						]
					}
				};
				break;
			case 'error404':
				var error404Container = container.find( '#idt-admin-404' );
				var error404BannerId = error404Container.find( '#idt-404-banner-id' ).val();
				var error404BannerUrl = error404Container.find( '#idt-404-banner-url' ).val();

				values = {
					section: 'error404',
					settings: {
						banner: [
							parseInt( error404BannerId ),
							error404BannerUrl
						]
					}
				};
				break;
			case 'search':
				var searchContainer = container.find( '#idt-admin-search' );
				var searchBannerId = searchContainer.find( '#idt-search-banner-id' ).val();
				var searchBannerUrl = searchContainer.find( '#idt-search-banner-url' ).val();

				values = {
					section: 'search',
					settings: {
						banner: [
							parseInt( searchBannerId ),
							searchBannerUrl
						]
					}
				};
				break;
			case 'copyright':
				var copyrightContainer = container.find( '#idt-admin-copyright' );
				var copyright = copyrightContainer.find( '#idt-copyright-text' ).val();

				values = {
					section: 'copyright',
					settings: {
						default: copyright
					}
				};
				break;
		}

		return values;

	}

	/**
	 * Guarda las configuraciones del tema
	 * @param {object} values objecto con los configuraciones a ser guardadas.
	 * @return void
	 */
	function saveSettings( values = {} ) {

		var data = {
			action: 'save_settings',
			data: values
		};

		$.post( ajaxObject.ajaxUrl, data, function ( response ) {} )
			.done( function () {} )
			.fail( function () {} )
			.always( function ( response ) {
				console.log( response );
				var newResponse = JSON.parse( response );
				var message = '<p class="idt-message">' + newResponse.message + '</p>';
				$( '.idt-admin-toolbar' ).after( message );
				setTimeout( function () {
					$( '#idt-admin-tpl-dashboard .idt-message' ).fadeOut().remove();
				}, 3000 );
			} );
	}

	/**
	 * Agrega el template solicitado al dashboard administrativo
	 * @param {string} name nombre del template administrativo a rentornar.
	 * @param {string} target selector del contenedor donde sera mostrado el template.
	 * @return void
	 */
	function getAdminTemplate( name = '', target = '' ) {
		var spinner = '<div class="idt-spinner-container"><span class="idt-spinner dashicons dashicons-image-rotate"></span></div>';

		if ( name === '' ) {
			name = 'tpl-not-found';
		}
		if ( target === '' ) {
			target = '.idt-admin-content';
		}

		$( target ).html( spinner );

		var data = {
			action: 'get_admin_template',
			data: name
		};

		$.post( ajaxObject.ajaxUrl, data, function ( response ) {} )
			.done( function () {} )
			.fail( function () {} )
			.always( function ( response ) {
				var newResponse = JSON.parse( response );
				$( target ).html( newResponse );
			} );
	}
} )( jQuery );
