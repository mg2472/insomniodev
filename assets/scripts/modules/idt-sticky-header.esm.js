/**
 * Sticky header handler
 * @param target string selector of the sticky header element
 * @return void
 */
function idtStickyHeaderEsm(target) {
    if(target && target !== '') {
        const sticky = document.querySelector(target);

        if(!sticky) return;

        window.addEventListener('scroll', ()=> {
            let scroll = window.scrollY;

            if(scroll > 0) {
                sticky.classList.add('idt-sticky-active');
            } else {
                sticky.classList.remove('idt-sticky-active');
            }
        });
    }
}

export {idtStickyHeaderEsm}