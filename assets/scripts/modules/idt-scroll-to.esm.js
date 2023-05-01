/**
 * Scroll to element event controller
 * @param target string selector of the element to click for the scroll event
 * @return void
 */
function idtScrollToElement(target) {
    if(target && target !== '') {
        const items = document.querySelectorAll(target);

        if (!items.length) return;

        for(let item of items) {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const targetElementSelector = item.dataset.target;

                if(targetElementSelector) {
                    const targetElement = document.querySelector(targetElementSelector);

                    if(targetElement) {
                        const targetElementOffset = targetElement.scrollTop;
                        window.scrollTo(0, targetElementOffset);
                    }
                }
            }) ;
        }
    }
}

export {idtScrollToElement}