/**
 * Animation event controller
 *
 * @param target string Animation event controller
 *
 * @return void
 */
function idtAnimationController(target) {
    if(target && target !== '') {
        const elements = document.querySelectorAll(target);

        if (!elements.length) return;

        if ('IntersectionObserver' in window) {
            let elementObserver = new IntersectionObserver(entries => {

                entries.forEach(entry => {
                    let element = entry.target;

                    if (entry.isIntersecting && element.classList.contains('idt-animated')) {
                        const animation = element.dataset.animation || '';
                        const animationRepeat = element.dataset.animationRepeat || 'once';

                        if (animation !== '') {
                            element.classList.add('animate__animated', animation);

                            if (animationRepeat === 'once') {
                                elementObserver.unobserve(element);
                            }
                        } else {
                            elementObserver.unobserve(element);
                        }
                    }
                });
            });

            elements.forEach(element => {
                elementObserver.observe(element);
            });
        }
    }
}

export {idtAnimationController}