/**
 * Main theme header scripts
 */

import {idtMobileMenuEsm} from "./modules/idt-mobile-menu.esm.js";
import {idtStickyHeaderEsm} from "./modules/idt-sticky-header.esm.js";

//Mobile menu controller
mobileMenuController();

//Sticky header controller
stickyHeaderController();

/**
 * Mobile menu controller
 * @return void
 */
function mobileMenuController() {
    const mobileMenu = new idtMobileMenuEsm();
    mobileMenu.toggle('.idt-menu-mobile-layout');
}

/**
 * Sticky header event controller
 * @return void
 */
function stickyHeaderController() {
    idtStickyHeaderEsm('.idt-header-sticky');
}