import {idtPerformanceGeneralSettings} from "./child-components/idt-performance-general-settings.esm.js";
import {idtPerformanceResources} from "./child-components/idt-performance-resources.esm.js";
import {idtPerformanceTemplates} from "./child-components/idt-performance-templates.esm.js";
import {idtAdminTabs} from "../../idt-admin-tabs.esm.js";

/**
 * Init the component Social functions
 * @return void
 */
function idtAdminComponentPerformanceInit() {
    const component = document.getElementById('idt-dashboard__component-performance');

    if (!component) return;

    const optionsGeneralSettings = component.querySelector('#idt-dashboard__tab-target-general-settings');
    const optionsResources = component.querySelector('#idt-dashboard__tab-target-resources');
    const optionsTemplates = component.querySelector('#idt-dashboard__tab-target-templates');

    if (optionsGeneralSettings) {
        idtPerformanceGeneralSettings(optionsGeneralSettings);
    }

    if (optionsResources) {

    }

    if (optionsTemplates) {
        idtPerformanceTemplates(optionsTemplates);
    }

    idtAdminTabs();
}

export {idtAdminComponentPerformanceInit}