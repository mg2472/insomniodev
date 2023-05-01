import {idtFetchRequest} from "../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtToast} from "../../idt-toast.esm.js";

/**
 * Init the admin settings component
 * @return void
 */
function idtAdminComponentSettingsInit() {
    const component = document.getElementById('idt-dashboard__component-settings');

    if(!component) return;

    const form = component.querySelector('.idt-dashboard__form');
    let lang = 'all';
    let settings = {
        disableGutenbergEditor: {
            value: '',
            group: '',
            lang: ''
        },
        disableWidgetsBlockEditor: {
            value: '',
            group: '',
            lang: ''
        },
        copyright: {
            value: '',
            group: '',
            lang: ''
        },
    };

    if(form) {
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

            settings = getFormValues(form, settings, lang);

            idtFetchRequest({
                action: 'adminRequestsRouter',
                group: 'settings',
                method: 'updateGeneralSettings',
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

        getSettings(component, form, lang);
    }
}

/**
 * Get the social settings values
 * @param component htmlNode The component where the messages will be rendered
 * @param form htmlNode The form where the data will be rendered
 * @param lang string Settings language
 * @return void
 */
function getSettings(component, form, lang = 'all') {
    idtFetchRequest({
        action: 'adminRequestsRouter',
        group: 'settings',
        method: 'getGeneralSettings',
        data: {
            lang: lang
        },
    }, idtAdminSettings.ajaxUrl).then(data => {

        if(data.errors.length) {
            for(let error of data.errors) {
                const errorElement = `<div class="idt-dashboard__alert">${error}</div>`;
                component.insertAdjacentHTML('beforeend', errorElement);
            }
        }else if(data.message) {
            setFormValues(form, data.message);
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

        //Disable Gutenberg editor
        const inputDisableGutenbergEditor = form.querySelector('input[name="disableGutenbergEditor"]');
        if(inputDisableGutenbergEditor && values.disableGutenbergEditor && values.disableGutenbergEditor.value === 'disabled') {
            inputDisableGutenbergEditor.checked = true;
        }

        //Disable Widgets block editor
        const inputDisableWidgetsBlockEditor = form.querySelector('input[name="disableWidgetsBlockEditor"]');
        if(inputDisableWidgetsBlockEditor && values.disableWidgetsBlockEditor && values.disableWidgetsBlockEditor.value === 'disabled') {
            inputDisableWidgetsBlockEditor.checked = true;
        }

        //Copyright
        const inputCopyright = form.querySelector('textarea[name="copyright"]');
        if(inputCopyright && values.copyright) {
            inputCopyright.value = values.copyright.value ? values.copyright.value : '';
        }
    }
}

/**
 * Get the form fields values
 * @param form The form
 * @param values The values model
 * @param lang string Settings language
 * @return object Form values
 */
function getFormValues(form, values, lang = 'all') {
    if(form && values) {

        //Disable Gutenberg editor
        const inputDisableGutenbergEditor = form.querySelector('input[name="disableGutenbergEditor"]');
        if(inputDisableGutenbergEditor) {
            if(inputDisableGutenbergEditor.checked) {
                values.disableGutenbergEditor.value = 'disabled';
            } else {
                values.disableGutenbergEditor.value = 'enabled';
            }
        }

        //Disable Gutenberg editor Lang and Group
        values.disableGutenbergEditor.group = 'general';
        values.disableGutenbergEditor.lang = 'all';


        //Disable Widgets block editor
        const inputDisableWidgetsBlockEditor = form.querySelector('input[name="disableWidgetsBlockEditor"]');
        if(inputDisableWidgetsBlockEditor) {
            if(inputDisableWidgetsBlockEditor.checked) {
                values.disableWidgetsBlockEditor.value = 'disabled';
            } else {
                values.disableWidgetsBlockEditor.value = 'enabled';
            }
        }

        //Disable Gutenberg editor Lang and Group
        values.disableWidgetsBlockEditor.group = 'general';
        values.disableWidgetsBlockEditor.lang = 'all';

        //Copyright
        const inputCopyright = form.querySelector('textarea[name="copyright"]');
        if(inputCopyright) {
            values.copyright.value = inputCopyright.value;
        }

        //Copyright Lang and Group
        values.copyright.group = 'general';
        values.copyright.lang = lang;
    }

    return values;
}

export {idtAdminComponentSettingsInit}