import Glide from "../../libs/glide/glide.esm.js";

/**
 * Embla carousel handler
 *
 * @param target string selector the carousel selector
 *
 * @return void
 */
function idtEmblaCarouselInit(target = '') {
    if (target && target !== '') {
        let carousels = document.querySelectorAll(target);

        if (!carousels.length) return;

        for (let carousel of carousels) {
            const carouselSettings = carousel.dataset.emblaSettings;
            const viewportNode = carousel.querySelector('.embla__viewport');
            const prevBtn = carousel.querySelector('.embla__button--prev');
            const nextBtn = carousel.querySelector('.embla__button--next');
            const dotsNode = carousel.querySelector('.embla__dots');
            let carouselPlugins = [];
            let options = {};

            if (carouselSettings) {
                try {
                    options = JSON.parse(carouselSettings);

                    if (options.hasOwnProperty('behavior')) {
                        switch (options.behavior) {
                            case 'autoScroll':
                                if (options.hasOwnProperty('autoScroll')) {
                                    carouselPlugins.push(EmblaCarouselAutoScroll(options.autoScroll));
                                }
                                break;
                            case 'autoplay':
                            default:
                                if (options.hasOwnProperty('autoplay')) {
                                    carouselPlugins.push(EmblaCarouselAutoplay(options.autoplay));

                                    if (options.autoplay.hasOwnProperty('fade') && options.autoplay.fade) {
                                        carouselPlugins.push(EmblaCarouselFade());
                                    }
                                }
                                break;
                        }
                    }

                    if (options.hasOwnProperty('autoHeight') && options.autoHeight) {
                        carouselPlugins.push(EmblaCarouselAutoHeight());
                    }
                } catch(e) {
                    options = {};
                }
            }

            const emblaApi = EmblaCarousel(viewportNode, options, carouselPlugins);

            if (prevBtn && nextBtn) {
                const removePrevNextBtnsClickHandlers = idtEmblaCarouselAddPrevNextBtnsClickHandlers(
                    emblaApi,
                    prevBtn,
                    nextBtn,
                    options.behavior
                );

                emblaApi.on('destroy', removePrevNextBtnsClickHandlers);
            }

            if (dotsNode) {
                const removeDotBtnsAndClickHandlers = idtEmblaCarouselAddDotBtnsAndClickHandlers(
                    emblaApi,
                    dotsNode,
                    options.behavior
                );
                emblaApi.on('destroy', removeDotBtnsAndClickHandlers);
            }
        }
    }
}

function idtEmblaCarouselAddTogglePrevNextBtnsActive(emblaApi, prevBtn, nextBtn) {
    const togglePrevNextBtnsState = () => {
        if (emblaApi.canScrollPrev()) {
            prevBtn.removeAttribute('disabled');
        } else {
            prevBtn.setAttribute('disabled', 'disabled');
        }

        if (emblaApi.canScrollNext()) {
            nextBtn.removeAttribute('disabled');
        } else {
            nextBtn.setAttribute('disabled', 'disabled');
        }
    }

    emblaApi
        .on('select', togglePrevNextBtnsState)
        .on('init', togglePrevNextBtnsState)
        .on('reInit', togglePrevNextBtnsState);

    return () => {
        prevBtn.removeAttribute('disabled');
        nextBtn.removeAttribute('disabled');
    }
}

function idtEmblaCarouselAddPrevNextBtnsClickHandlers(emblaApi, prevBtn, nextBtn, behavior) {
    let playOrStop = null;

    if (behavior === 'autoplay') {
        const autoplay = emblaApi?.plugins()?.autoplay;
        playOrStop = autoplay.isPlaying() ? autoplay.stop : autoplay.play;
    }
    if (behavior === 'autoScroll') {
        const autoScroll = emblaApi?.plugins()?.autoScroll;
        playOrStop = autoScroll.isPlaying() ? autoScroll.stop : autoScroll.play;
    }

    const scrollPrev = () => {
        emblaApi.scrollPrev();

        if (playOrStop) {
            playOrStop();
        }
    }
    const scrollNext = () => {
        emblaApi.scrollNext();

        if (playOrStop) {
            playOrStop();
        }
    }

    prevBtn.addEventListener('click', scrollPrev, false);
    nextBtn.addEventListener('click', scrollNext, false);

    const removeTogglePrevNextBtnsActive = idtEmblaCarouselAddTogglePrevNextBtnsActive(
        emblaApi,
        prevBtn,
        nextBtn
    );

    return () => {
        removeTogglePrevNextBtnsActive();
        prevBtn.removeEventListener('click', scrollPrev, false);
        nextBtn.removeEventListener('click', scrollNext, false);
    }
}

function idtEmblaCarouselAddDotBtnsAndClickHandlers(emblaApi, dotsNode, behavior) {
    let dotNodes = []
    let playOrStop = null;

    if (behavior === 'autoplay') {
        const autoplay = emblaApi?.plugins()?.autoplay;
        playOrStop = autoplay.isPlaying() ? autoplay.stop : autoplay.play;
    }
    if (behavior === 'autoScroll') {
        const autoScroll = emblaApi?.plugins()?.autoScroll;
        playOrStop = autoScroll.isPlaying() ? autoScroll.stop : autoScroll.play;
    }

    const addDotBtnsWithClickHandlers = () => {
        dotsNode.innerHTML = emblaApi
            .scrollSnapList()
            .map(() => '<button class="embla__dot" type="button"></button>')
            .join('');

        const scrollTo = (index) => {
            emblaApi.scrollTo(index);
            playOrStop();
        }

        dotNodes = Array.from(dotsNode.querySelectorAll('.embla__dot'));
        dotNodes.forEach((dotNode, index) => {
            dotNode.addEventListener('click', () => scrollTo(index), false);
        });
    }

    const toggleDotBtnsActive = () => {
        const previous = emblaApi.previousScrollSnap();
        const selected = emblaApi.selectedScrollSnap();
        dotNodes[previous].classList.remove('embla__dot--selected');
        dotNodes[selected].classList.add('embla__dot--selected');
    }

    emblaApi
        .on('init', addDotBtnsWithClickHandlers)
        .on('reInit', addDotBtnsWithClickHandlers)
        .on('init', toggleDotBtnsActive)
        .on('reInit', toggleDotBtnsActive)
        .on('select', toggleDotBtnsActive);

    return () => {
        dotsNode.innerHTML = ''
    }
}

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

export {idtBootstrapCarouselExternalControls, idtSlickCarouselExternalControls, idtGlideCarouselInit, idtEmblaCarouselInit}