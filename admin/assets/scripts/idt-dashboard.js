import {idtRenderTemplate} from './modules/idt-admin-dashboard.esm.js';
import {idtAdminComponentSocialInit} from "./modules/components/social/idt-admin-social.esm.js";
import {idtAdminComponentPerformanceInit} from "./modules/components/performance/idt-admin-performance.esm.js";
import {idtAdminComponentSettingsInit} from "./modules/components/settings/idt-admin-settings.esm.js";
import {idtAdminComponentLogosInit} from "./modules/components/logos/idt-admin-logos.esm.js";

idtAdminDashboardInit();

/**
 * Init the admin dashboard
 * @return void
 */
function idtAdminDashboardInit() {
    const target = document.getElementById('idt-dashboard');

    if(!target) return;

    const container = document.getElementById('wpwrap');
    const adminmenumain = document.getElementById('adminmenumain');
    const wpcontent = document.getElementById('wpcontent');
    const wpfooter = document.getElementById('wpfooter');
    const html = document.querySelector('.wp-toolbar');

    adminmenumain.remove();
    wpfooter.remove();

    html.classList.add('idt-remove-padding');
    wpcontent.classList.add('idt-remove-padding');

    idtRenderTemplate(
        '#wpcontent',
        'dashboard/default',
        idtAdminDashboardContentInit
    );
}

/**
 * Init the main dashboard content
 * @return void
 */
function idtAdminDashboardContentInit() {
    idtRenderTemplate(
        '.idt-dashboard__body',
        'dashboard/main',
        idtAdminRenderChildTemplate
    );
}

/**
 * Render a dashboard child template
 * @return void
 */
function idtAdminRenderChildTemplate() {
    const items = document.querySelectorAll('.idt-dashboard__menu-button');

    if(!items) return;

    for(let item of items) {
        item.addEventListener('click', () => {
           const template = item.dataset.template;
            let callback;

            for(let item of items) {
                item.classList.remove('active');
            }

            item.classList.add('active');

           if(template && template !== '') {
               switch(template) {
                   case 'logos/default':
                       callback = idtAdminComponentLogosInit;
                       break;
                   case 'social/default':
                       callback = idtAdminComponentSocialInit;
                       break;
                   case 'performance/default':
                       callback = idtAdminComponentPerformanceInit;
                       break;
                   case 'settings/default':
                       callback = idtAdminComponentSettingsInit;
                       break;
                   default:
                       break;
               }

               idtRenderTemplate('.idt-dashboard__body', template, callback);
           }
        });
    }
}