/**
 * Init the admin accordions functions
 * @return void
 */
function idtAdminAccordions() {
    const accordions = document.querySelectorAll('.idt-dashboard__accordion');

    if (accordions) {
        for (let accordion of accordions) {
            const header = accordion.querySelector('.idt-dashboard__accordion-header');
            const body = accordion.querySelector('.idt-dashboard__accordion-body');

            if (header && body) {
                header.addEventListener('click', () => {
                    const icons = header.querySelectorAll('svg');

                    if (icons) {
                        for (let icon of icons) {
                            icon.classList.toggle('hide');
                        }
                    }

                    body.classList.toggle('hide');
                });
            }
        }
    }
}

export {idtAdminAccordions}