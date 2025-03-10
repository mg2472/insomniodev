/**
 * Mobile menu controller class
 */
class idtMobileMenuEsm {

    /**
     * Class constructor
     */
    constructor() {
        this.flag = false;
    }

    /**
     * Initialize the mobile menu toggle handler
     * @param target string the menu container selector
     * @return void
     */
    toggle(target) {
        if(target && target !== '') {
            const container = document.querySelector(target);
            if(!container) return;

            const menuMobileTriggers = document.querySelectorAll('.idt-mobile-menu-button');
            const menu = container.querySelector('.idt-mobile-menu-container');
            const menuItems = menu.querySelectorAll('.menu-item a');

            if(menuMobileTriggers) {
                for(let menuMobileTrigger of menuMobileTriggers) {
                    for (const item of menuMobileTriggers) {
                        item.classList.toggle('active');
                    }
                    
                    menuMobileTrigger.addEventListener('click', () => {
                        this.toggleHandler(container, menu, menuMobileTriggers);
                    });
                }
            }

            if(menuItems) {
                for(let menuItem of menuItems) {
                    menuItem.addEventListener('click', () => {
                        const hideMenu = menuItem.dataset.hideMenu || 'true';

                        if (hideMenu !== 'false') {
                            this.toggleHandler(container, menu, menuMobileTriggers);
                        }
                    });
                }
            }
        }
    }

    /**
     * Show or hide the menu
     * @param container object the main element that contain the menu
     * @param menu object the menu element
     * @param triggers object the elements that trigger the toggle menu function
     * @return void
     */
    toggleHandler (container, menu, triggers) {
        if (container && menu && triggers) {
            this.flag = !this.flag;
            for (let trigger of triggers) {
                const closeIcon = trigger.querySelector('.idt-mobile-menu-button__close');
                const openIcon = trigger.querySelector('.idt-mobile-menu-button__open');

                if (closeIcon) {
                    openIcon.classList.toggle('active');
                }

                if (openIcon) {
                    closeIcon.classList.toggle('active');
                }
            }
            container.classList.toggle('active');
            menu.classList.toggle('active');
        }
    }

    /**
     * Init the dropdown functionality for the menu
     * @param target string the menu container selector
     * @param clickTarget string selector for the collapse trigger
     * @param collapseTarget string selector for the collapse elements
     * @return void
     */
    dropdown(target, clickTarget, collapseTarget) {
        if(
            target && target !== ''
            && clickTarget && clickTarget !== ''
            && collapseTarget && collapseTarget !== ''
        ) {
            const container = document.querySelector(target);

            if(!container) return;
            const menuItems = container.querySelectorAll(clickTarget);

            if(menuItems) {
                for(let menuItem of menuItems) {
                    const collapseArea = menuItem.querySelector(collapseTarget);

                    menuItem.classList.add('idt-collapse__trigger');

                    if(collapseArea) {
                        collapseArea.classList.add('idt-collapse__area');

                        menuItem.addEventListener('click', () => {
                            menuItem.classList.toggle('idt-collapse__trigger--active');
                            collapseArea.classList.toggle('idt-collapse__area--active');
                        });
                    }
                }
            }
        }
    }
}

export {idtMobileMenuEsm}