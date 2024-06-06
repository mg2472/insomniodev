import {idtFetchRequest} from "../../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtToast} from "../../../idt-toast.esm.js";
import {idtAdminAccordions} from "../../../idt-admin-accordion.esm.js";

/**
 * Init the child component general performance settings
 * @param data
 * @param templateID
 * @return void
 */
function idtPerformanceTemplate(data, templateID = 0) {
    const component = document.getElementById('idt-dashboard__component-performance-template');

    if (component) {
        const form = component.querySelector('.idt-dashboard__form');
        let model = {
            id: 0,
            code: '',
            templateName: '',
            templateType: '',
            criticalCss: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            criticalCssScssFiles: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            css: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            cssScssFiles: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            headerScripts: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            footerScripts: {
                bootstrap: [],
                fontawesome: [],
                theme: [],
                childTheme: [],
                additional: []
            },
            isChildTheme: false,
            status: ''
        };
        let method = 'createTemplateSetting';

        if(templateID > 0) {
            model.id = templateID;
            method = 'updateTemplateSetting';
        }

        if(form) {
            inputTypeChange(component);
            idtAdminAccordions();
            toggleFilesType();

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                const inputs = form.querySelectorAll('input,select,textarea');
                const toasts = document.querySelectorAll('.idt-dashboard__toast');
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                const loader = form.querySelector('.idt-dashboard__loader');

                if(submitBtn) {
                    submitBtn.disabled = true;
                }

                if(loader) {
                    loader.classList.remove('hide');
                }

                if(toasts) {
                    for(let toast of toasts) {
                        toast.remove();
                    }
                }

                const settings = getFormValues(form, model);

                idtFetchRequest({
                    action: 'adminRequestsRouter',
                    group: 'settings',
                    method: method,
                    data: settings,
                }, idtAdminSettings.ajaxUrl).then(data => {
                    let messages = [];
                    const toastArgs = {
                        removeToasts: true
                    };

                    if(data.errors.length) {
                        for(let error of data.errors) {
                            messages.push(error);
                        }
                    } else if(data.message !== '') {
                        messages.push(data.message);
                    }

                    idtToast(messages, toastArgs);

                    if(submitBtn) {
                        submitBtn.disabled = false;
                    }

                    if(loader) {
                        loader.classList.add('hide');
                    }
                });
            });

            if (model.id > 0) {
                getSettings(component, form, {id: model.id});
            }
        }
    }
}

/**
 * Get the social settings values
 * @param component htmlNode The component where the messages will be rendered
 * @param form htmlNode The form where the data will be rendered
 * @param filters object The filters for the query
 * @return void
 */
function getSettings(component, form, filters) {
    idtFetchRequest({
        action: 'adminRequestsRouter',
        group: 'settings',
        method: 'getTemplatesSettings',
        data: filters,
    }, idtAdminSettings.ajaxUrl).then(data => {
        if (data.errors.length) {
            for (let error of data.errors) {
                const errorElement = `<div class="idt-dashboard__alert">${error}</div>`;
                component.insertAdjacentHTML('beforeend', errorElement);
            }
        } else if(data.message && data.message.length) {
            setFormValues(form, data.message[0]);
        }
    });
}

/**
 * Set the form fields values
 * @param form The form
 * @param values The values model
 * @return void
 */
function setFormValues(form, values) {
    if(form && values) {
        //Template type
        const inputTplType = form.querySelector('select[name="templateType"]');
        if (values.hasOwnProperty('templateType') && values.templateType !== '') {
            let tplName = '';
            inputTplType.value = values.templateType;

            if (values.hasOwnProperty('templateName') && values.templateName !== '') {
                tplName = values.templateName;
            }

            inputTypeChangeTrigger(form, tplName);
        }

        //Template status
        const inputStatus = form.querySelector('select[name="templateStatus"]');
        if (values.hasOwnProperty('status') && values.status !== '') {
            inputStatus.value = values.status;
        }

        /************
         ************
         * Critical CSS
         * ***********
         * ***********/
        if (values.hasOwnProperty('criticalCssFiles') && values.criticalCssFiles !== '') {
            const criticalCssFiles = JSON.parse(values.criticalCssFiles);

            //Bootstrap Critical CSS
            const inputBootstrapCriticalType = form.querySelector('select[name="bootstrapCriticalCssFilesType"]');
            const inputBootstrapCriticalTypeParent = inputBootstrapCriticalType.closest('.idt-dashboard__accordion-body');

            if (inputBootstrapCriticalType && inputBootstrapCriticalTypeParent && criticalCssFiles.hasOwnProperty('bootstrap') && criticalCssFiles.bootstrap.length) {
                inputBootstrapCriticalType.value = 'css';
                inputBootstrapCriticalType.dispatchEvent(new Event('change'));

                for (let value of criticalCssFiles.bootstrap) {
                    const input = inputBootstrapCriticalTypeParent.querySelector(`.idt-dashboard__input-css-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome Critical CSS
            const inputFontawesomeCriticalType = form.querySelector('select[name="fontawesomeCriticalCssFilesType"]');
            const inputFontawesomeCriticalTypeParent = inputFontawesomeCriticalType.closest('.idt-dashboard__accordion-body');

            if (inputFontawesomeCriticalType && inputFontawesomeCriticalTypeParent && criticalCssFiles.hasOwnProperty('fontawesome') && criticalCssFiles.fontawesome.length) {
                inputFontawesomeCriticalType.value = 'css';
                inputFontawesomeCriticalType.dispatchEvent(new Event('change'));

                for (let value of criticalCssFiles.fontawesome) {
                    const input = inputFontawesomeCriticalTypeParent.querySelector(`.idt-dashboard__input-css-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Additional Critical CSS
            const inputAdditionalCriticalCssFilesContainer = form.querySelector('.idt-dashboard__input-additional-critical-css-files');

            if (inputAdditionalCriticalCssFilesContainer && criticalCssFiles.hasOwnProperty('additional') && criticalCssFiles.additional.length) {
                for (let value of criticalCssFiles.additional) {
                    const input = inputAdditionalCriticalCssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }

        /************
         ************
         * Critical CSS Scss
         * ***********
         * ***********/
        if (values.hasOwnProperty('criticalCssScssFiles') && values.criticalCssScssFiles !== '') {
            const criticalCssScssFiles = JSON.parse(values.criticalCssScssFiles);

            //Bootstrap Critical CSS Scss
            const inputBootstrapCriticalType = form.querySelector('select[name="bootstrapCriticalCssFilesType"]');
            const inputBootstrapCriticalTypeParent = inputBootstrapCriticalType.closest('.idt-dashboard__accordion-body');

            if (inputBootstrapCriticalType && inputBootstrapCriticalTypeParent && criticalCssScssFiles.hasOwnProperty('bootstrap') && criticalCssScssFiles.bootstrap.length) {
                inputBootstrapCriticalType.value = 'scss';
                inputBootstrapCriticalType.dispatchEvent(new Event('change'));

                for (let value of criticalCssScssFiles.bootstrap) {
                    const input = inputBootstrapCriticalTypeParent.querySelector(`.idt-dashboard__input-scss-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome Critical CSS Scss
            const inputFontawesomeCriticalType = form.querySelector('select[name="fontawesomeCriticalCssFilesType"]');
            const inputFontawesomeCriticalTypeParent = inputFontawesomeCriticalType.closest('.idt-dashboard__accordion-body');

            if (inputFontawesomeCriticalType && inputFontawesomeCriticalTypeParent && criticalCssScssFiles.hasOwnProperty('fontawesome') && criticalCssScssFiles.fontawesome.length) {
                inputFontawesomeCriticalType.value = 'scss';
                inputFontawesomeCriticalType.dispatchEvent(new Event('change'));

                for (let value of criticalCssScssFiles.fontawesome) {
                    const input = inputFontawesomeCriticalTypeParent.querySelector(`.idt-dashboard__input-scss-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Theme Critical CSS Scss
            const inputThemeCriticalScssFilesContainer = form.querySelector('.idt-dashboard__input-theme-critical-css-scss-files');

            if (inputThemeCriticalScssFilesContainer && criticalCssScssFiles.hasOwnProperty('theme') && criticalCssScssFiles.theme.length) {
                for (let value of criticalCssScssFiles.theme) {
                    const input = inputThemeCriticalScssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Child Theme Critical CSS Scss
            const inputChildThemeCriticalScssFilesContainer = form.querySelector('.idt-dashboard__input-child-theme-critical-css-scss-files');

            if (inputChildThemeCriticalScssFilesContainer && criticalCssScssFiles.hasOwnProperty('childTheme') && criticalCssScssFiles.childTheme.length) {
                for (let value of criticalCssScssFiles.childTheme) {
                    const input = inputChildThemeCriticalScssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }

        /************
         ************
         * CSS
         * ***********
         * ***********/
        if (values.hasOwnProperty('cssFiles') && values.cssFiles !== '') {
            const cssFiles = JSON.parse(values.cssFiles);

            //Bootstrap CSS
            const inputBootstrapType = form.querySelector('select[name="bootstrapCssFilesType"]');
            const inputBootstrapTypeParent = inputBootstrapType.closest('.idt-dashboard__accordion-body');

            if (inputBootstrapType && inputBootstrapTypeParent && cssFiles.hasOwnProperty('bootstrap') && cssFiles.bootstrap.length) {
                inputBootstrapType.value = 'css';
                inputBootstrapType.dispatchEvent(new Event('change'));

                for (let value of cssFiles.bootstrap) {
                    const input = inputBootstrapTypeParent.querySelector(`.idt-dashboard__input-css-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome CSS
            const inputFontawesomeType = form.querySelector('select[name="fontawesomeCssFilesType"]');
            const inputFontawesomeTypeParent = inputFontawesomeType.closest('.idt-dashboard__accordion-body');

            if (inputFontawesomeType && inputFontawesomeTypeParent && cssFiles.hasOwnProperty('fontawesome') && cssFiles.fontawesome.length) {
                inputFontawesomeType.value = 'css';
                inputFontawesomeType.dispatchEvent(new Event('change'));

                for (let value of cssFiles.fontawesome) {
                    const input = inputFontawesomeTypeParent.querySelector(`.idt-dashboard__input-css-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Additional CSS
            const inputAdditionalCssFilesContainer = form.querySelector('.idt-dashboard__input-additional-critical-css-files');

            if (inputAdditionalCssFilesContainer && cssFiles.hasOwnProperty('additional') && cssFiles.additional.length) {
                for (let value of cssFiles.additional) {
                    const input = inputAdditionalCssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }

        /************
         ************
         * CSS Scss
         * ***********
         * ***********/
        if (values.hasOwnProperty('cssScssFiles') && values.cssScssFiles !== '') {
            const cssScssFiles = JSON.parse(values.cssScssFiles);

            //Bootstrap CSS Scss
            const inputBootstrapType = form.querySelector('select[name="bootstrapCssFilesType"]');
            const inputBootstrapTypeParent = inputBootstrapType.closest('.idt-dashboard__accordion-body');

            if (inputBootstrapType && inputBootstrapTypeParent && cssScssFiles.hasOwnProperty('bootstrap') && cssScssFiles.bootstrap.length) {
                inputBootstrapType.value = 'scss';
                inputBootstrapType.dispatchEvent(new Event('change'));

                for (let value of cssScssFiles.bootstrap) {
                    const input = inputBootstrapTypeParent.querySelector(`.idt-dashboard__input-scss-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome CSS Scss
            const inputFontawesomeType = form.querySelector('select[name="fontawesomeCssFilesType"]');
            const inputFontawesomeTypeParent = inputFontawesomeType.closest('.idt-dashboard__accordion-body');

            if (inputFontawesomeType && inputFontawesomeTypeParent && cssScssFiles.hasOwnProperty('fontawesome') && cssScssFiles.fontawesome.length) {
                inputFontawesomeType.value = 'scss';
                inputFontawesomeType.dispatchEvent(new Event('change'));

                for (let value of cssScssFiles.fontawesome) {
                    const input = inputFontawesomeTypeParent.querySelector(`.idt-dashboard__input-scss-files input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Theme CSS Scss
            const inputThemeScssFilesContainer = form.querySelector('.idt-dashboard__input-theme-css-scss-files');

            if (inputThemeScssFilesContainer && cssScssFiles.hasOwnProperty('theme') && cssScssFiles.theme.length) {
                for (let value of cssScssFiles.theme) {
                    const input = inputThemeScssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Child Theme CSS Scss
            const inputChildThemeScssFilesContainer = form.querySelector('.idt-dashboard__input-child-theme-css-scss-files');

            if (inputChildThemeScssFilesContainer && cssScssFiles.hasOwnProperty('childTheme') && cssScssFiles.childTheme.length) {
                for (let value of cssScssFiles.childTheme) {
                    const input = inputChildThemeScssFilesContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }

        /************
         ************
         * Header scripts
         * ***********
         * ***********/
        if (values.hasOwnProperty('scriptsHeaderFiles') && values.scriptsHeaderFiles !== '') {
            const scriptsHeaderFiles = JSON.parse(values.scriptsHeaderFiles);

            //Bootstrap Header Scripts
            const scriptsHeaderFilesBootstrapContainer = form.querySelector('.idt-dashboard__input-bootstrap-header-scripts');

            if (scriptsHeaderFilesBootstrapContainer && scriptsHeaderFiles.hasOwnProperty('bootstrap') && scriptsHeaderFiles.bootstrap.length) {
                for (let value of scriptsHeaderFiles.bootstrap) {
                    const input = scriptsHeaderFilesBootstrapContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome Header Scripts
            const scriptsHeaderFilesFontawesomeContainer = form.querySelector('.idt-dashboard__input-fontawesome-header-scripts');

            if (scriptsHeaderFilesFontawesomeContainer && scriptsHeaderFiles.hasOwnProperty('fontawesome') && scriptsHeaderFiles.fontawesome.length) {
                for (let value of scriptsHeaderFiles.fontawesome) {
                    const input = scriptsHeaderFilesFontawesomeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Theme Header Scripts
            const scriptsHeaderFilesThemeContainer = form.querySelector('.idt-dashboard__input-theme-header-scripts');

            if (scriptsHeaderFilesThemeContainer && scriptsHeaderFiles.hasOwnProperty('theme') && scriptsHeaderFiles.theme.length) {
                for (let value of scriptsHeaderFiles.theme) {
                    const input = scriptsHeaderFilesThemeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Child Theme Header Scripts
            const scriptsHeaderFilesChildThemeContainer = form.querySelector('.idt-dashboard__input-child-theme-header-scripts');

            if (scriptsHeaderFilesChildThemeContainer && scriptsHeaderFiles.hasOwnProperty('childTheme') && scriptsHeaderFiles.childTheme.length) {
                for (let value of scriptsHeaderFiles.childTheme) {
                    const input = scriptsHeaderFilesChildThemeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Additional Header Scripts
            const scriptsHeaderFilesAdditionalContainer = form.querySelector('.idt-dashboard__input-additional-header-scripts');

            if (scriptsHeaderFilesAdditionalContainer && scriptsHeaderFiles.hasOwnProperty('additional') && scriptsHeaderFiles.additional.length) {
                for (let value of scriptsHeaderFiles.additional) {
                    const input = scriptsHeaderFilesAdditionalContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }

        /************
         ************
         * Footer scripts
         * ***********
         * ***********/
        if (values.hasOwnProperty('scriptsFooterFiles') && values.scriptsFooterFiles !== '') {
            const scriptsFooterFiles = JSON.parse(values.scriptsFooterFiles);

            //Bootstrap Footer Scripts
            const scriptsFooterFilesBootstrapContainer = form.querySelector('.idt-dashboard__input-bootstrap-footer-scripts');

            if (scriptsFooterFilesBootstrapContainer && scriptsFooterFiles.hasOwnProperty('bootstrap') && scriptsFooterFiles.bootstrap.length) {
                for (let value of scriptsFooterFiles.bootstrap) {
                    const input = scriptsFooterFilesBootstrapContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Fontawesome Footer Scripts
            const scriptsFooterFilesFontawesomeContainer = form.querySelector('.idt-dashboard__input-fontawesome-footer-scripts');

            if (scriptsFooterFilesFontawesomeContainer && scriptsFooterFiles.hasOwnProperty('fontawesome') && scriptsFooterFiles.fontawesome.length) {
                for (let value of scriptsFooterFiles.fontawesome) {
                    const input = scriptsFooterFilesFontawesomeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Theme Footer Scripts
            const scriptsFooterFilesThemeContainer = form.querySelector('.idt-dashboard__input-theme-footer-scripts');

            if (scriptsFooterFilesThemeContainer && scriptsFooterFiles.hasOwnProperty('theme') && scriptsFooterFiles.theme.length) {
                for (let value of scriptsFooterFiles.theme) {
                    const input = scriptsFooterFilesThemeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Child Theme Footer Scripts
            const scriptsFooterFilesChildThemeContainer = form.querySelector('.idt-dashboard__input-child-theme-footer-scripts');

            if (scriptsFooterFilesChildThemeContainer && scriptsFooterFiles.hasOwnProperty('childTheme') && scriptsFooterFiles.childTheme.length) {
                for (let value of scriptsFooterFiles.childTheme) {
                    const input = scriptsFooterFilesChildThemeContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }

            //Additional Footer Scripts
            const scriptsFooterFilesAdditionalContainer = form.querySelector('.idt-dashboard__input-additional-footer-scripts');

            if (scriptsFooterFilesAdditionalContainer && scriptsFooterFiles.hasOwnProperty('additional') && scriptsFooterFiles.additional.length) {
                for (let value of scriptsFooterFiles.additional) {
                    const input = scriptsFooterFilesAdditionalContainer.querySelector(`input[value="${value}"]`);
                    if (input) {
                        input.checked = true;
                    }
                }
            }
        }
    }
}

/**
 * Get the form fields values
 * @param form The form
 * @param values The values model
 * @return object Form values
 */
function getFormValues(form, values) {
    if(form && values) {
        values.criticalCss = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };
        values.criticalCssScssFiles = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };
        values.css = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };
        values.cssScssFiles = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };
        values.headerScripts = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };
        values.footerScripts = {
            bootstrap: [],
            fontawesome: [],
            theme: [],
            childTheme: [],
            additional: []
        };

        //Template type
        const inputTplType = form.querySelector('select[name="templateType"]');
        if (inputTplType && inputTplType.value !== '') {
            values.templateType = inputTplType.value;
        }

        //Template name
        const inputTplName = form.querySelector('select[name="templateName"]');
        if (inputTplName && inputTplName.value !== '') {
            values.templateName = inputTplName.value;
        }

        //Template status
        const inputStatus = form.querySelector('select[name="templateStatus"]');
        if (inputStatus && inputStatus.value !== '') {
            values.status = inputStatus.value;
        }

        //Critical CSS

        //Bootstrap Critical CSS
        const inputBootstrapCriticalCss = form.querySelector('select[name="bootstrapCriticalCssFilesType"]');
        if (inputBootstrapCriticalCss && inputBootstrapCriticalCss.value !== '') {
            const inputBootstrapCriticalCssParent = inputBootstrapCriticalCss.closest('.idt-dashboard__accordion-body');
            const inputBootstrapCriticalCssCssFiles = inputBootstrapCriticalCssParent.querySelectorAll('.idt-dashboard__input-css-files input[type="checkbox"]');
            const inputBootstrapCriticalCssScssFiles = inputBootstrapCriticalCssParent.querySelectorAll('.idt-dashboard__input-scss-files input[type="checkbox"]');

            if (inputBootstrapCriticalCss.value === 'css') {
                for (let input of inputBootstrapCriticalCssCssFiles) {
                    if (input.checked) {
                        values.criticalCss.bootstrap.push(input.value);
                    }
                }
            } else if (inputBootstrapCriticalCss.value === 'scss') {
                for (let input of inputBootstrapCriticalCssScssFiles) {
                    if (input.checked) {
                        values.criticalCssScssFiles.bootstrap.push(input.value);
                    }
                }
            }
        }

        //Fontawesome Critical CSS
        const inputFontawesomeCriticalCss = form.querySelector('select[name="fontawesomeCriticalCssFilesType"]');
        if (inputFontawesomeCriticalCss && inputFontawesomeCriticalCss.value !== '') {
            const inputFontawesomeCriticalCssParent = inputFontawesomeCriticalCss.closest('.idt-dashboard__accordion-body');
            const inputFontawesomeCriticalCssCssFiles = inputFontawesomeCriticalCssParent.querySelectorAll('.idt-dashboard__input-css-files input[type="checkbox"]');
            const inputFontawesomeCriticalCssScssFiles = inputFontawesomeCriticalCssParent.querySelectorAll('.idt-dashboard__input-scss-files input[type="checkbox"]');

            if (inputFontawesomeCriticalCss.value === 'css') {
                for (let input of inputFontawesomeCriticalCssCssFiles) {
                    if (input.checked) {
                        values.criticalCss.fontawesome.push(input.value);
                    }
                }
            } else if (inputFontawesomeCriticalCss.value === 'scss') {
                for (let input of inputFontawesomeCriticalCssScssFiles) {
                    if (input.checked) {
                        values.criticalCssScssFiles.fontawesome.push(input.value);
                    }
                }
            }
        }

        //Theme Critical CSS
        const inputThemeCriticalScss = form.querySelectorAll('.idt-dashboard__input-theme-critical-css-scss-files input[type="checkbox"]');
        if (inputThemeCriticalScss) {
            for (let input of inputThemeCriticalScss) {
                if (input.checked) {
                    values.criticalCssScssFiles.theme.push(input.value);
                }
            }
        }

        //Child theme Critical CSS
        const inputChildThemeCriticalScss = form.querySelectorAll('.idt-dashboard__input-child-theme-critical-css-scss-files input[type="checkbox"]');
        if (inputChildThemeCriticalScss) {
            for (let input of inputChildThemeCriticalScss) {
                if (input.checked) {
                    values.criticalCssScssFiles.childTheme.push(input.value);
                }
            }
        }

        //Additional Critical CSS
        const inputAdditionalCriticalScss = form.querySelectorAll('.idt-dashboard__input-additional-critical-css-files input[type="checkbox"]');
        if (inputAdditionalCriticalScss) {
            for (let input of inputAdditionalCriticalScss) {
                if (input.checked) {
                    values.criticalCss.additional.push(input.value);
                }
            }
        }

        //End Critical CSS


        //CSS

        //Bootstrap CSS
        const inputBootstrapCss = form.querySelector('select[name="bootstrapCssFilesType"]');
        if (inputBootstrapCss && inputBootstrapCss.value !== '') {
            const inputBootstrapCssParent = inputBootstrapCss.closest('.idt-dashboard__accordion-body');
            const inputBootstrapCssFiles = inputBootstrapCssParent.querySelectorAll('.idt-dashboard__input-css-files input[type="checkbox"]');
            const inputBootstrapScssFiles = inputBootstrapCssParent.querySelectorAll('.idt-dashboard__input-scss-files input[type="checkbox"]');

            if (inputBootstrapCss.value === 'css') {
                for (let input of inputBootstrapCssFiles) {
                    if (input.checked) {
                        values.css.bootstrap.push(input.value);
                    }
                }
            } else if (inputBootstrapCss.value === 'scss') {
                for (let input of inputBootstrapScssFiles) {
                    if (input.checked) {
                        values.cssScssFiles.bootstrap.push(input.value);
                    }
                }
            }
        }

        //Fontawesome CSS
        const inputFontawesomeCss = form.querySelector('select[name="fontawesomeCssFilesType"]');
        if (inputFontawesomeCss && inputFontawesomeCss.value !== '') {
            const inputFontawesomeCssParent = inputFontawesomeCss.closest('.idt-dashboard__accordion-body');
            const inputFontawesomeCssFiles = inputFontawesomeCssParent.querySelectorAll('.idt-dashboard__input-css-files input[type="checkbox"]');
            const inputFontawesomeCssScssFiles = inputFontawesomeCssParent.querySelectorAll('.idt-dashboard__input-scss-files input[type="checkbox"]');

            if (inputFontawesomeCss.value === 'css') {
                for (let input of inputFontawesomeCssFiles) {
                    if (input.checked) {
                        values.css.fontawesome.push(input.value);
                    }
                }
            } else if (inputFontawesomeCss.value === 'scss') {
                for (let input of inputFontawesomeCssScssFiles) {
                    if (input.checked) {
                        values.cssScssFiles.fontawesome.push(input.value);
                    }
                }
            }
        }

        //Theme SCSS
        const inputThemeScss = form.querySelectorAll('.idt-dashboard__input-theme-css-scss-files input[type="checkbox"]');
        if (inputThemeScss) {
            for (let input of inputThemeScss) {
                if (input.checked) {
                    values.cssScssFiles.theme.push(input.value);
                }
            }
        }

        //Child theme CSS
        const inputChildThemeScss = form.querySelectorAll('.idt-dashboard__input-child-theme-css-scss-files input[type="checkbox"]');
        if (inputChildThemeScss) {
            for (let input of inputChildThemeScss) {
                if (input.checked) {
                    values.cssScssFiles.childTheme.push(input.value);
                }
            }
        }

        //Additional CSS
        const inputAdditionalScss = form.querySelectorAll('.idt-dashboard__input-additional-css-files input[type="checkbox"]');
        if (inputAdditionalScss) {
            for (let input of inputAdditionalScss) {
                if (input.checked) {
                    values.css.additional.push(input.value);
                }
            }
        }

        //End CSS

        //Header scripts

        //Bootstrap scripts
        const inputBootstrapHeaderScripts = form.querySelectorAll('.idt-dashboard__input-bootstrap-header-scripts input[type="checkbox"]');
        if (inputBootstrapHeaderScripts) {
            for (let input of inputBootstrapHeaderScripts) {
                if (input.checked) {
                    values.headerScripts.bootstrap.push(input.value);
                }
            }
        }

        //Fontawesome scripts
        const inputFontawesomeHeaderScripts = form.querySelectorAll('.idt-dashboard__input-fontawesome-header-scripts input[type="checkbox"]');
        if (inputFontawesomeHeaderScripts) {
            for (let input of inputFontawesomeHeaderScripts) {
                if (input.checked) {
                    values.headerScripts.fontawesome.push(input.value);
                }
            }
        }

        //Theme scripts
        const inputThemeHeaderScripts = form.querySelectorAll('.idt-dashboard__input-theme-header-scripts input[type="checkbox"]');
        if (inputThemeHeaderScripts) {
            for (let input of inputThemeHeaderScripts) {
                if (input.checked) {
                    values.headerScripts.theme.push(input.value);
                }
            }
        }

        //Child theme scripts
        const inputChildThemeHeaderScripts = form.querySelectorAll('.idt-dashboard__input-child-theme-header-scripts input[type="checkbox"]');
        if (inputChildThemeHeaderScripts) {
            for (let input of inputChildThemeHeaderScripts) {
                if (input.checked) {
                    values.headerScripts.childTheme.push(input.value);
                }
            }
        }

        //Additional scripts
        const inputAdditionalHeaderScripts = form.querySelectorAll('.idt-dashboard__input-additional-header-scripts input[type="checkbox"]');
        if (inputAdditionalHeaderScripts) {
            for (let input of inputAdditionalHeaderScripts) {
                if (input.checked) {
                    values.headerScripts.additional.push(input.value);
                }
            }
        }

        //End Header Scripts

        //Footer scripts

        //Bootstrap scripts
        const inputBootstrapFooterScripts = form.querySelectorAll('.idt-dashboard__input-bootstrap-footer-scripts input[type="checkbox"]');
        if (inputBootstrapFooterScripts) {
            for (let input of inputBootstrapFooterScripts) {
                if (input.checked) {
                    values.footerScripts.bootstrap.push(input.value);
                }
            }
        }

        //Fontawesome scripts
        const inputFontawesomeFooterScripts = form.querySelectorAll('.idt-dashboard__input-fontawesome-footer-scripts input[type="checkbox"]');
        if (inputFontawesomeFooterScripts) {
            for (let input of inputFontawesomeFooterScripts) {
                if (input.checked) {
                    values.footerScripts.fontawesome.push(input.value);
                }
            }
        }

        //Theme scripts
        const inputThemeFooterScripts = form.querySelectorAll('.idt-dashboard__input-theme-footer-scripts input[type="checkbox"]');
        if (inputThemeFooterScripts) {
            for (let input of inputThemeFooterScripts) {
                if (input.checked) {
                    values.footerScripts.theme.push(input.value);
                }
            }
        }

        //Child theme scripts
        const inputChildThemeFooterScripts = form.querySelectorAll('.idt-dashboard__input-child-theme-footer-scripts input[type="checkbox"]');
        if (inputChildThemeFooterScripts) {
            for (let input of inputChildThemeFooterScripts) {
                if (input.checked) {
                    values.footerScripts.childTheme.push(input.value);
                }
            }
        }

        //Additional scripts
        const inputAdditionalFooterScripts = form.querySelectorAll('.idt-dashboard__input-additional-footer-scripts input[type="checkbox"]');
        if (inputAdditionalFooterScripts) {
            for (let input of inputAdditionalFooterScripts) {
                if (input.checked) {
                    values.footerScripts.additional.push(input.value);
                }
            }
        }

        //End Footer Scripts
    }

    return values;
}

function inputTypeChangeTrigger(component, tplName = '') {
    if (component) {
        const inputType = component.querySelector('select[name="templateType"]');
        const inputTemplateName = component.querySelector('select[name="templateName"]');

        if (inputType && inputTemplateName) {
            const value = inputType.value;
            const templateNameOptions = inputTemplateName.querySelectorAll('option');

            if (templateNameOptions) {
                for (const option of templateNameOptions) {
                    option.remove();
                }
            }

            if (value !== '') {
                idtFetchRequest({
                    action: 'adminRequestsRouter',
                    group: 'templates',
                    method: 'getTemplatesList',
                    data: {
                        tplType: value
                    },
                }, idtAdminSettings.ajaxUrl).then(data => {
                    let messages = [];
                    const toastArgs = {
                        removeToasts: true
                    };

                    if (data.errors.length) {
                        for(let error of data.errors) {
                            messages.push(error);
                        }
                    } else if(data.message) {
                        const options = data.message;
                        let selectValues = '';

                        for (const option of Object.entries(options)) {
                            const label = option[0];
                            const value = option[1].name ? option[1].name : `${label}.php`;
                            selectValues += addSelectOption(label, value);

                            inputTemplateName.innerHTML = selectValues;
                        }

                        if (tplName !== '') {
                            //Template name
                            const inputTplName = component.querySelector('select[name="templateName"]');

                            if (inputTplName) {
                                inputTplName.value = tplName;
                            }
                        }
                    }
                });
            }
        }
    }
}


function inputTypeChange(component) {
    if (component) {
        const inputType = component.querySelector('select[name="templateType"]');
        const inputTemplateName = component.querySelector('select[name="templateName"]');

        if (inputType && inputTemplateName) {
            inputType.addEventListener('change', (e) => {
                e.preventDefault();

                inputTypeChangeTrigger(component);
            })
        }
    }
}

function toggleFilesType() {
    const inputs = document.querySelectorAll('.idt-dashboard__input-toggle-files-type');

    if (inputs) {
        for (let input of inputs) {
            input.addEventListener('change', () => {
                const container = input.closest('.idt-dashboard__accordion-body');
                const value = input.value;

                if (container) {
                    const cssFiles = container.querySelector('.idt-dashboard__input-css-files');
                    const scssFiles = container.querySelector('.idt-dashboard__input-scss-files');

                    if (cssFiles && scssFiles) {
                        switch (value) {
                            case 'css':
                                cssFiles.classList.remove('hide');
                                scssFiles.classList.add('hide');
                                break;
                            case 'scss':
                                cssFiles.classList.add('hide');
                                scssFiles.classList.remove('hide');
                                break;
                            default:
                                cssFiles.classList.add('hide');
                                scssFiles.classList.add('hide');
                                break;
                        }
                    }
                }
            });
        }
    }
}

function addSelectOption(label, value) {
    return `<option value="${value}">${label}</option>`;
}

export {idtPerformanceTemplate}