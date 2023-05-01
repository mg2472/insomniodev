/**
 * Scripts generales del tema
 **/

( function ( $ ) {

    /**
     * Variables globales para los scripts
     **/
    var prevRatio = 0.0;

    /**
     * Inicializa los scripts del tema luego de que el documento esta preparado
     **/
    $( document ).ready( function() {

        //Controlador de eventos para el menú movil
        mobileMenuController();

        //Controlador de dropdown en el menú movil
        mobileDropDownController();

        //Controlador de eventos para el header sticky
        stickyHeaderController();

        //Controlador de eventos para el carrusel slick
        // slickCarouselController();

        //Controlador para los controles externos del carrusel de bootstrap
        bootstrapCarouselExternalControlsController();

        //Controlador para los controles externos del carrusel slick
        slickCarouselExternalControlsController();

        //Controlador para los elementos con animaciones del tema
        animationController();

        //Controlador para los elementos que ejecutan la animación de scroll hasta otro elemento
        scrollToElementController();

        //Controlador para las funciones de compartir en redes sociales
        socialShareController();

    } );

    /**
     * Controlador de los eventos del menú movil
     **/
    function mobileMenuController() {
        var container = $( '.idt-menu-mobile-layout' );
        if ( !container.length ) return;

        var menuMobileBtn = $( '.idt-mobile-menu-button' );
        var menu = container.find( '.idt-mobile-menu-container' );
        var menuItems = menu.find( '.menu-item a' );
        var closeIcon = '<i class="fas fa-times"></i>';
        var openIcon = '<i class="fa fa-bars"></i>';
        var flag = false;

        menuMobileBtn.click( function () {
            var btn = $( this );
            flag = !flag;
            if ( flag ) {
                btn.html( closeIcon );
            } else {
                btn.html( openIcon );
            }
            container.toggleClass( 'active' );
            menu.toggleClass( 'active' );
        } );

        menuItems.click( function () {
            menuMobileBtn.click();
        } );

    }

    /**
     * Controlador de dropdown en sub-menus de menú movil
     */
    function mobileDropDownController() {
        var container = $( '.idt-menu-mobile__dropdown' );
        if ( !container.length ) return;

        $('li.menu-item-has-children').click( function () {
            if(!$(this).hasClass('idt-active__dropdown')) {
                $('li.menu-item-has-children.idt-active__dropdown').removeClass('idt-active__dropdown');
                $(this).addClass('idt-active__dropdown');
            } else {
                $(this).removeClass('idt-active__dropdown');
            }

        });
    }

    /**
     * Controlador de los eventos del menú sticky
     **/
    function stickyHeaderController() {
        var sticky = $( '.idt-header-sticky' );
        if ( !sticky.length ) return;

        $( window ).scroll( function() {
            var scroll = $( this ).scrollTop();
            if ( scroll > 0 ) {
                sticky.addClass( 'idt-sticky-active' );
            } else {
                sticky.removeClass( 'idt-sticky-active' );
            }
        });
    }

    /**
     * Controlador de los eventos del del carrusel slick
     **/
    function slickCarouselController() {
        var carousel = $( '.idt-slick-carousel' );
        if ( !carousel.length ) return;

        carousel.each( function () {
            var item = $( this );
            var arrowLeft = "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>";
            var arrowRight = "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>";
            var config = {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: false,
                centerMode: false,
                centerPadding: '0px',
            };

            var slickConfigs = item.data( 'config' );

            if ( slickConfigs ) {
                config = slickConfigs;
            }
            config['prevArrow'] = arrowLeft;
            config['nextArrow'] = arrowRight;

            item.slick( config );


        } );

    }

    /**
     * Controlador para los elementos que ejecutan la animación de scroll hasta otro elemento
     **/
    function scrollToElementController() {
        var items = $( '.idt-to-next-section' );
        if ( !items.length ) return;

        items.click( function ( e ) {
            e.preventDefault();
            var item = $( this );
            var target = item.data( 'target' );
            if ( target ) {
                var targetOffset = $( target ).offset().top;
                $( 'html,body' ).animate( { scrollTop: targetOffset }, 'fast' );
            }
        } );
    }
    /**
     * Controlador para los botones externos del carrusel de bootstrap
     **/
    function bootstrapCarouselExternalControlsController() {
        var container = $( '.idt-bootstrap-custom-controls' );
        if ( !container.length ) return;

        container.each( function () {

            var item = $( this );
            var target = $( item.data( 'target' ) );

            if ( target ) {
                var leftControl = item.find( '.idt-custom-control-left' );
                var rightControl = item.find( '.idt-custom-control-right' );

                leftControl.click( function() {
                    target.carousel( 'prev' );
                } );

                rightControl.click( function() {
                    target.carousel( 'next' );
                } );
            }

        } );

    }

    /**
     * Controlador para los botones externos del carrusel slick
     **/
    function slickCarouselExternalControlsController() {
        var container = $( '.idt-slick-custom-controls' );
        if ( !container.length ) return;

        container.each( function () {

            var item = $( this );
            var target = $( item.data( 'target' ) );

            if ( target ) {
                var leftControl = item.find( '.idt-custom-control-left' );
                var rightControl = item.find( '.idt-custom-control-right' );

                leftControl.click( function() {
                    target.slick( 'slickPrev' );
                } );

                rightControl.click( function() {
                    target.slick( 'slickNext' );
                } );
            }

        } );

    }

    /**
     * Controlador para los elementos con animaciones del tema
     **/
    function animationController() {
        var items = $( '.animated' );
        if ( !items.length ) return;

        var viewport = $( window );

        viewport.on( 'scroll resize', function () {
            var windowHeight = viewport.height();
            var windowTopPosition = viewport.scrollTop();
            var windowBottomPosition = ( windowTopPosition + windowHeight );

            items.each( function() {
                var item = $( this );
                var animation = item.data( 'animation' );
                var itemHeight = item.outerHeight();
                var itemTopPosition = item.offset().top;
                var itemBottomPosition = ( itemTopPosition + itemHeight );

                //check to see if this current container is within viewport
                if ( ( itemBottomPosition >= windowTopPosition ) && ( itemTopPosition <= windowBottomPosition ) ) {
                    item.addClass( animation );
                } else {
                    item.removeClass( animation );
                }
            } );
        } );

        viewport.trigger( 'scroll' );

    }

    /**
     * Controlador para las funciones de compartir en redes sociales
     **/
    function socialShareController() {

        let socialShareButton = document.querySelectorAll( '.idt-share__button' );
        if ( !socialShareButton.length ) return;

        console.log(navigator)

        if ( 'share' in navigator ) {

            let newNavigation;

            socialShareButton.forEach(el => el.addEventListener( 'click', ( button ) => {

                console.log( button );

                //     newNavigation = window.navigator;
                //
                //     let shareText = "";
                //     shareText += this.texts.title + this.property.neighborhoodName + ', ' + this.property.cityName + "\n";
                //
                //     shareText += "Información: ";
                //     // shareText += this.shareUrl + "?id=" + property_id;
                //     // shareText = encodeURIComponent( shareText );
                //     newNavigation.share( {
                //         title: document.title,
                //         text: shareText,
                //         url: this.shareUrl + "?id=" + property_id
                //     } );
                //
            } ) );

        } else {
            for( button of socialShareButton ) {
                button.addEventListener( 'click', () => {
                    let shareModal = button.dataset.modal;
                    console.log( shareModal );
                    console.log( button );
                    $( shareModal ).modal( 'show' );
                } );
            }
        }

    }

} )( jQuery );