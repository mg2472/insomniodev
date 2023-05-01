/**
 * Main theme scripts
 */

import {idtMobileMenuEsm} from "./modules/idt-mobile-menu.esm.js";
import {idtStickyHeaderEsm} from "./modules/idt-sticky-header.esm.js";
import {idtBootstrapCarouselExternalControls, idtSlickCarouselExternalControls} from "./modules/idt-carousels.esm.js";
import {idtAnimationController} from "./modules/idt-animation.esm.js";
import {idtScrollToElement} from "./modules/idt-scroll-to.esm.js";
import {idtSocialShare} from "./modules/idt-social-share.esm.js";

//Mobile menu controller
mobileMenuController();

//Sticky header controller
stickyHeaderController();

//Bootstrap carousel external controls handler
bootstrapCarouselExternalControlsController();

//Slick carousel external controls handler
slickCarouselExternalControlsController();

//Animations controller
animationController();

//Scroll to element event controller
scrollToElementController();

/**
 * Mobile menu controller
 * @return void
 */
function mobileMenuController() {
    const mobileMenuController = new idtMobileMenuEsm();
    mobileMenuController.toggle('.idt-menu-mobile-layout');
    mobileMenuController.dropdown('.idt-menu-mobile__dropdown');
}

/**
 * Sticky header event controller
 * @return void
 */
function stickyHeaderController() {
    idtStickyHeaderEsm('.idt-header-sticky');
}

/**
 * Bootstrap carousel external controls handler
 * @return void
 */
function bootstrapCarouselExternalControlsController() {
    idtBootstrapCarouselExternalControls('.idt-bootstrap-custom-controls');
}

/**
 * Slick carousel external controls handler
 * @return void
 */
function slickCarouselExternalControlsController() {
    idtSlickCarouselExternalControls('.idt-slick-custom-controls');
}

/**
 * Animation event controller
 * @return void
 */
function animationController() {
    idtAnimationController('.animated');
}

/**
 * Scroll to element event controller
 * @return void
 */
function scrollToElementController() {
    idtScrollToElement('.idt-to-next-section');
}

/**
 * Social share event controller
 * @return void
 */
function idtSocialShareController() {
    const socialShares = document.querySelectorAll('.idt-social-share-trigger');
    if(!socialShares.length) return;
    idtSocialShare(socialShares);
}