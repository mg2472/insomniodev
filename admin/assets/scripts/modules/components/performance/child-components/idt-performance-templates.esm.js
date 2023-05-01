import {idtFetchRequest} from "../../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtRenderTemplate} from "../../../idt-admin-dashboard.esm.js";
import {idtPerformanceTemplate} from "./idt-performance-template.esm.js";
import {idtToast} from "../../../idt-toast.esm.js";

/**
 * Init the child component general performance settings
 * @return void
 */
function idtPerformanceTemplates(container) {
    if (container) {
        const formFilters = container.querySelector('.idt-dashboard__form');
        let filters = {
            templateType: '',
            templateName: '',
            page: 1,
            totalPages: 0,
            limit: 50
        };

        if (formFilters) {
            formFilters.addEventListener('submit', (event) => {
                event.preventDefault();
                filters.page = 1;
                getData(container, formFilters, filters);
            });
        }

        add(container);

        getData(container, formFilters, filters);
    }
}

/**
 * Render the templates configs component
 * @return void
 */
function add(container) {
    if (container) {
        const addButtons = container.querySelectorAll('.idt-dashboard__action-add');

        if (addButtons) {
            for (let addButton of addButtons) {
                addButton.addEventListener('click', ()=> {
                    idtRenderTemplate(
                        '.idt-dashboard__body',
                        'performance/performance-template',
                        idtPerformanceTemplate
                    );
                });
            }
        }
    }
}

/**
 * Render the templates configs component
 * @return void
 */
function edit(itemID = 0) {
    if (itemID > 0) {
        idtRenderTemplate(
            '.idt-dashboard__body',
            'performance/performance-template',
            idtPerformanceTemplate,
            itemID
        );
    }
}

/**
 * Render a data list
 * @param component htmlNode The component where the results will be rendered
 * @param form htmlNode The form for the query filters
 * @param filters object The filters for the query
 * @return void
 */
function getData(component, form, filters) {
    if (component) {
        const alerts = component.querySelectorAll('.idt-dashboard__alert');
        const loaderTarget = component.querySelector('.idt-dashboard__loader');
        const resultsTarget = component.querySelector('.idt-dashboard__table-body');

        if (resultsTarget) {
            resultsTarget.innerHTML = '';
        }

        if (loaderTarget) {
            loaderTarget.classList.remove('hide');
        }

        if (alerts) {
            for(let alert of alerts) {
                alert.remove();
            }
        }

        if (form) {
            filters = getFilters(form, filters);
        }

        idtFetchRequest({
            action: 'adminRequestsRouter',
            group: 'settings',
            method: 'getTemplatesSettings',
            data: filters,
        }, idtAdminSettings.ajaxUrl).then(data => {

            if (data.errors.length) {
                for(let error of data.errors) {
                    const errorElement = `<div class="idt-dashboard__alert">${error}</div>`;
                    component.insertAdjacentHTML('beforeend', errorElement);
                }
            } else if(data.message && data.message.length) {
                console.log('results rows');
                const items = data.message;
                let tableRows = '';

                for (let item of items) {
                    tableRows += `<tr>`;
                    tableRows += `<td>${item.id}</td>`;
                    tableRows += `<td>${item.templateType}</td>`;
                    tableRows += `<td>${item.templateName}</td>`;
                    tableRows += `<td>${item.status}</td>`;
                    tableRows += `
                        <td>
                            <div class="idt-dashboard__table-actions" data-item-id="${item.id}">
                                <button class="idt-dashboard__button-1 idt-dashboard__action-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                </button>
                                <button class="idt-dashboard__button-1 idt-dashboard__action-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                </button>
                            </div>
                        </td>`;
                    tableRows += `</tr>`;
                }

                resultsTarget.innerHTML = tableRows;
                addActions(component);
            }

            if (loaderTarget) {
                loaderTarget.classList.add('hide');
            }
        });
    }
}

/**
 * Return the form filter values
 * @return object
 */
function getFilters(form, filters) {
    let values = filters;

    if (form) {
        const inputs = form.querySelectorAll('input,textarea,select');

        if (inputs) {
            for (let input of inputs) {
                if (input.name === 'templateType') {
                    values.templateType = input.value;
                }

                if (input.name === 'templateName') {
                    values.templateName = input.value;
                }
            }
        }
    }

    return values;
}

/**
 * Add CRUD actions to table rows
 * @param component htmlNode The component where the results will be rendered
 * @return void
 */
function addActions(component) {
    const actionsGroups = component.querySelectorAll('.idt-dashboard__table-actions');

    if (actionsGroups) {
        for (let actionsGroup of actionsGroups) {
            const itemID = actionsGroup.dataset.itemId ? parseInt(actionsGroup.dataset.itemId) : null;
            const editButton = actionsGroup.querySelector('.idt-dashboard__action-edit');
            const deleteButton = actionsGroup.querySelector('.idt-dashboard__action-delete');

            if (itemID) {
                if (editButton) {
                    editButton.addEventListener('click', ()=> {
                        console.log('edit');
                        edit(itemID);
                    });
                }

                if (deleteButton) {
                    deleteButton.addEventListener('click', ()=> {
                        console.log('delete');
                    });
                }
            }
        }
    }
}

export {idtPerformanceTemplates}