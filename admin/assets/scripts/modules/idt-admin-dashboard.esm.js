import {idtFetchRequest} from "../../../../assets/scripts/modules/idt-fetch.esm.js";

/**
 * Render an admin template
 * @param target string selector of the template container
 * @param templateName string the template to render
 * @param callback function a function that will be trigger after the template render
 * @param callbackArgs object Optional args passed to the callback
 * @return void
 */
function idtRenderTemplate(target = '', templateName = '', callback, callbackArgs) {
    if(target !== '' && templateName !== '') {
        const container = document.querySelector(target);

        if(container) {
            const alerts = container.querySelectorAll('.idt-dashboard__alert');
            const loader = `<div class="idt-dashboard__loader">
                                <svg class="idt-dashboard__loader-icon idt-dashboard__loader-icon--large" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z"/></svg>
                            </div>`;

            if(alerts) {
                for(let alert of alerts) {
                    alert.remove();
                }
            }

            container.innerHTML = loader;

            idtFetchRequest({
                action: 'adminRequestsRouter',
                group: 'templates',
                method: 'getTemplate',
                data: {
                    templateName: templateName
                },
            }, idtAdminSettings.ajaxUrl).then(data => {
                if(data.errors.length) {
                    for(let error of data.errors) {
                        const errorElement = `<div class="idt-dashboard__alert">${error}</div>`;
                        container.insertAdjacentHTML('beforeend', errorElement);
                    }
                }else if(data.status === 200 && data.message !== '') {
                    container.innerHTML = data.message;
                }

                if(callback) {
                    callback(data, callbackArgs);
                }
            });
        }
    }
}

export {idtRenderTemplate};