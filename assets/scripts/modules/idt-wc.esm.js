/**
 * Woocommerce mini cart controller
 * @return void
 */
function idtWcMiniCart() {
    const miniCarts = document.querySelectorAll('.idt-wc-mini-cart');

    if(miniCarts) {
        for(let miniCart of miniCarts) {
            const miniCartToggle = miniCart.querySelector('.idt-wc-mini-cart__toggle');
            const miniCartContent = miniCart.querySelector('.idt-wc-mini-cart__content');
            const miniCartClose = miniCart.querySelector('.idt-wc-mini-cart__close');

            if(miniCartToggle && miniCartContent) {
                miniCartToggle.addEventListener('click', () => {
                    miniCartToggle.classList.toggle('active');
                    miniCartContent.classList.toggle('active');
                });
            }

            if(miniCartClose) {
                miniCartClose.addEventListener('click', () => {
                    miniCartToggle.classList.remove('active');
                    miniCartContent.classList.remove('active');
                });
            }
        }
    }
}

export {idtWcMiniCart}