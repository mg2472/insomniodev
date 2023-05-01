import {idtImportResource} from "../modules/idt-resources.esm.js";

idtAddThemeNoCriticalCss();

/**
 * Add no critical CSS to current template
 * @return void
 */
function idtAddThemeNoCriticalCss() {
    const cssResources = idtResourcesJS || null;

    if (cssResources && cssResources.hasOwnProperty('css') && cssResources.css.length) {
        for (const cssFile of cssResources.css) {
            idtImportResource(cssFile, 'link');
        }
    }
}