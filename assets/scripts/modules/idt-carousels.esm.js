import Glide from "../../libs/glide/glide.esm.js";

/**
 * Bootstrap carousel external controls handler
 * @param target string selector the carousels selector
 * @return void
 */
function idtBootstrapCarouselExternalControls(target = '') {
    if(typeof bootstrap.Carousel !== 'undefined') {
        if(target && target !== '') {
            const controls = document.querySelectorAll(target);

            if(!controls.length) return;

            for(let control of controls) {
                const controlTarget = control.dataset.target;

                if(controlTarget && controlTarget !== '') {
                    const bsCarousel = new bootstrap.Carousel(controlTarget);

                    if(bsCarousel) {
                        const leftControl = control.querySelector('.idt-custom-control-left');
                        const rightControl = control.querySelector('.idt-custom-control-right');

                        leftControl.addEventListener('click', (event) => {
                            event.preventDefault();
                            bsCarousel.prev();
                        });

                        rightControl.addEventListener('click', (event) => {
                            event.preventDefault();
                            bsCarousel.next();
                        });
                    }
                }
            }
        }
    }
}

/**
 * Slick carousel external controls handler
 * @param target string selector the carousels selector
 * @return void
 */
function idtSlickCarouselExternalControls(target = '') {
    if(typeof jQuery !== 'undefined' && typeof jQuery.fn.slick !== 'undefined') {
        if(target && target !== '') {
            const controls = document.querySelectorAll(target);

            if(!controls.length) return;

            for(let control of controls) {
                const controlTarget = control.dataset.target;

                if(controlTarget && controlTarget !== '') {
                    const slickCarousel = jQuery(controlTarget);

                    if(slickCarousel) {
                        const leftControl = control.querySelector('.idt-custom-control-left');
                        const rightControl = control.querySelector('.idt-custom-control-right');

                        leftControl.addEventListener('click', (event) => {
                            event.preventDefault();
                            slickCarousel.slick('slickPrev');
                        });

                        rightControl.addEventListener('click', (event) => {
                            event.preventDefault();
                            slickCarousel.slick('slickNext');
                        });
                    }
                }
            }
        }
    }
}

/**
 * Glide carousel controls init handler
 * @param target string selector the carousels selector
 * @return void
 */
function idtGlideCarouselInit(target = '') {
    if(target && target !== '') {
        let carousels = document.querySelectorAll(target);

        if(!carousels.length) return;

        for(let carousel of carousels) {
            let configs = {};
            const carouselConfigs = carousel.dataset.glideConfigs;

            if(carouselConfigs) {
                try{
                    configs = JSON.parse(carouselConfigs);
                }catch(e) {
                    configs = {};
                }
            }

            const glideCarousels = new Glide(carousel, configs);

            glideCarousels.mount();
        }
    }
}

export {idtBootstrapCarouselExternalControls, idtSlickCarouselExternalControls, idtGlideCarouselInit}