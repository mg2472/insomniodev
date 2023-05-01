import {idtFetchRequest} from "../../../../assets/scripts/modules/idt-fetch.esm.js";

/**
 * Controller for the component settings form
 * @param component object Container where the form is rendered
 * @param optionsGroupName string The name of the theme settings group of the options
 * @return void
 */
function idtFormSettingsController(component, optionsGroupName = '') {
    if(component && optionsGroupName !== '') {
        const form = component.querySelector('.idt-dashboard__form');

        if(form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();

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

                if(inputs) {
                    let values = [];

                    for(let input of inputs) {
                        const inputName = input.name;
                        let inputValue = input.value;
                        const inputType = input.type;

                        if(inputType === 'radio' || inputType === 'checkbox') {
                            const getValue = input.dataset.value;

                            if(getValue) {
                                if(!input.checked) {
                                    inputValue = false;
                                }
                            }else {
                                inputValue = !!input.checked;
                            }
                        }

                        values.push({
                            name: inputName,
                            value: inputValue,
                        });
                    }

                    idtFetchRequest({
                        action: 'adminRequestsRouter',
                        group: 'settings',
                        method: 'updateSettings',
                        data: {
                            optionsGroup: optionsGroupName,
                            values: values
                        },
                    }, idtAdminSettings.ajaxUrl).then(data => {
                        const toast = document.createElement('div');
                        toast.classList.add('idt-dashboard__toast');
                        const toastIcon = '<span class="idt-dashboard__toast-icon dashicons dashicons-info-outline"></span>';
                        const toastCloseBtn = (
                            `<button class="idt-dashboard__toast-close" 
                                    onclick="this.closest('.idt-dashboard__toast').remove();">
                                    <span class="dashicons dashicons-no"></span>
                            </button>`
                        );

                        toast.insertAdjacentHTML(
                            'beforeend',
                            toastIcon
                        );

                        toast.insertAdjacentHTML(
                            'beforeend',
                            toastCloseBtn
                        );

                        if(data.errors.length) {
                            for(let error of data.errors) {
                                const errorAlert = `<div class="idt-dashboard__alert">${error}</div>`;
                                toast.insertAdjacentHTML(
                                    'beforeend',
                                    errorAlert
                                );
                            }
                        } else if(data.status === 200 && data.message !== '') {
                            const infoAlert = `<div class="idt-dashboard__alert">${data.message}</div>`;
                            toast.insertAdjacentHTML(
                                'beforeend',
                                infoAlert
                            );
                        }

                        component.after(toast);

                        if(submitBtn) {
                            submitBtn.disabled = false;
                        }

                        if(loader) {
                            loader.classList.add('hide');
                        }
                    });
                }
            });
        }
    }
}

export {idtFormSettingsController}