import {idtFetchRequest} from "../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtToast} from "../../idt-toast.esm.js";
import {idtWpMediaImage} from "../../../../../../assets/scripts/modules/idt-images.esm.js";

/**
 * Init the admin settings component
 * @return void
 */
function idtAdminComponentLogosInit() {
    const component = document.getElementById('idt-dashboard__component-logos');

    if(!component) return;

    const form = component.querySelector('.idt-dashboard__form');
    let lang = 'all';
    let settings = {
        logo1: {
            value: '',
            group: '',
            lang: ''
        },
        logo2: {
            value: '',
            group: '',
            lang: ''
        },
        logo3: {
            value: '',
            group: '',
            lang: ''
        },
        logo4: {
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
                method: 'updateLogosSettings',
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
        idtWpMediaImage();
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
        method: 'getLogosSettings',
        data: {
            lang: lang,
            group: 'logo'
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
        //Logo 1 ID
        const inputLogo1 = form.querySelector('input[name="logo1"]');
        if(inputLogo1 && values.logo1) {
            const logo1Container = inputLogo1.closest('.idt-image-manager');
            const logo1Preview = logo1Container.querySelector('.idt-image-manager__preview-image');
            logo1Preview.src = values.logo1.url;
            inputLogo1.value = values.logo1.id;
        }

        //Logo 2 ID
        const inputLogo2 = form.querySelector('input[name="logo2"]');
        if(inputLogo2 && values.logo2) {
            const logo2Container = inputLogo2.closest('.idt-image-manager');
            const logo2Preview = logo2Container.querySelector('.idt-image-manager__preview-image');
            logo2Preview.src = values.logo2.url;
            inputLogo2.value = values.logo2.id;
        }

        //Logo 3 ID
        const inputLogo3 = form.querySelector('input[name="logo3"]');
        if(inputLogo3 && values.logo3) {
            const logo3Container = inputLogo3.closest('.idt-image-manager');
            const logo3Preview = logo3Container.querySelector('.idt-image-manager__preview-image');
            logo3Preview.src = values.logo3.url;
            inputLogo3.value = values.logo3.id;
        }

        //Logo 4 ID
        const inputLogo4 = form.querySelector('input[name="logo4"]');
        if(inputLogo4 && values.logo4) {
            const logo4Container = inputLogo4.closest('.idt-image-manager');
            const logo4Preview = logo4Container.querySelector('.idt-image-manager__preview-image');
            logo4Preview.src = values.logo4.url;
            inputLogo4.value = values.logo4.id;
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

        //Logo 1 ID
        const inputLogo1 = form.querySelector('input[name="logo1"]');
        if(inputLogo1) {
            values.logo1.value = inputLogo1.value;
        }

        //Logo 1 ID Lang and Group
        values.logo1.group = 'logo';
        values.logo1.lang = lang;

        //Logo 2 ID
        const inputLogo2 = form.querySelector('input[name="logo2"]');
        if(inputLogo2) {
            values.logo2.value = inputLogo2.value;
        }

        //Logo 2 ID Lang and Group
        values.logo2.group = 'logo';
        values.logo2.lang = lang;

        //Logo 3 ID
        const inputLogo3 = form.querySelector('input[name="logo3"]');
        if(inputLogo3) {
            values.logo3.value = inputLogo3.value;
        }

        //Logo 3 ID Lang and Group
        values.logo3.group = 'logo';
        values.logo3.lang = lang;

        //Logo 4 ID
        const inputLogo4 = form.querySelector('input[name="logo4"]');
        if(inputLogo4) {
            values.logo4.value = inputLogo4.value;
        }

        //Logo 4 ID Lang and Group
        values.logo4.group = 'logo';
        values.logo4.lang = lang;
    }

    return values;
}

export {idtAdminComponentLogosInit}