/**
 * Animation event controller
 * @param target string Animation event controller
 * @return void
 */
function idtAnimationController(target) {
    if(target && target !== '') {
        const elements = document.querySelectorAll(target);

        if(!elements.length) return;

        //need to implement resize event too
        window.addEventListener('scroll', () => {
            const windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
            const windowTopPosition = window.scrollY;
            const windowBottomPosition = (windowTopPosition + windowHeight);

            for(let element of elements) {
                const animation = element.dataset.animation;
                const elementHeight = element.innerHeight || element.height;
                const elementTopPosition = element.offsetTop;
                const elementBottomPosition = (elementTopPosition + elementHeight);
                //check to see if this current container is within viewport
                if((elementBottomPosition >= windowTopPosition) && (elementTopPosition <= windowBottomPosition) ) {
                    element.classList.add(animation);
                }else {
                    element.classList.remove(animation);
                }
            }
        });
    }
}

export {idtAnimationController}