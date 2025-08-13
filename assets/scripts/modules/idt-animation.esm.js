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

/**
 * Init am element counter animation
 *
 * @param element htmlNode The message to show
 *
 * @param startValue int element start value
 *
 * @param endValue int element end value
 *
 * @param duration int the animation duration in milliseconds
 *
 * @return void
 */
function idtAnimateCounter(element, startValue = 0, endValue = 0, duration = 1000) {
    const range = endValue - startValue;
    const startTime = performance.now();
    const endValueDecimals = numberDecimals(endValue);

    function step(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const value = progress * range + startValue;

        element.textContent = value.toFixed(endValueDecimals);

        if (progress < 1) {
            requestAnimationFrame(step);
        }
    }

    function numberDecimals(number) {
        if (Math.floor(number) === number) return 0;
        const str = number.toString();
        const parts = str.split(".");
        return parts[1]?.length || 0;
    }

    requestAnimationFrame(step);
}

export {idtAnimationController, idtAnimateCounter}