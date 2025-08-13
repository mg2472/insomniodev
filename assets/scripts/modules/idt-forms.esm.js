import {idtFetchRequest} from "./idt-fetch.esm.js";

/**
 * Validate a form
 * @param form object the form to validate.
 * @param callback function an optional callback that will be trigger after the validation.
 * @return bool true if the form inputs not have errors, else return false.
 */
function idtFormValidation(form, callback = null) {
    if(form) {
        const formSubmitBtn = form.querySelector('button[type="submit"], input[type="submit"]');

        if(formSubmitBtn && formSubmitBtn.hasAttribute('disabled')) {
            formSubmitBtn.disabled = false;
        }

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            let isValidForm = true;
            let loader = null;
            const inputs = form.querySelectorAll('input, select, textarea');
            const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
            const elementLoader = `<div class="idt-spinner idt-form__loader" role="status">
                                        <span class="idt-visually-hidden">Loading...</span>
                                   </div>`;

            if(submitBtn) {
                submitBtn.disabled = true;
            }

            form.insertAdjacentHTML('beforeend', elementLoader);

            loader = form.querySelector('.idt-form__loader');

            if(inputs) {
                idtRemoveErrorMessages(form);
                isValidForm = idtInputsValidation(inputs);

                if(isValidForm.isValidInputs) {
                    if (isValidForm.serverSideValidations.length) {
                        idtFetchRequest({
                            action: 'idtRequestsRouter',
                            group: 'validations',
                            method: 'serverSideValidations',
                            data: isValidForm.serverSideValidations,
                        }, idtSettings.ajaxUrl).then(data => {

                            if(data.errors && data.errors.length) {
                                for(let error of data.errors) {
                                    const errorAlert = `<div class="idt-form__alert alert alert-danger"
                                                role="alert">${error}</div>`;

                                    form.insertAdjacentHTML('beforeend', errorAlert);
                                }

                                if(submitBtn) {
                                    submitBtn.disabled = false;
                                }

                                if(loader) {
                                    loader.remove();
                                }
                            }else if(data.status === 200 && data.body) {
                                if(callback) {
                                    callback(form, loader, submitBtn);
                                }else {
                                    form.submit();

                                    if(submitBtn) {
                                        submitBtn.disabled = false;
                                    }

                                    if(loader) {
                                        loader.remove();
                                    }
                                }
                            }
                        });
                    } else {
                        if(callback) {
                            callback(form, loader, submitBtn);
                        }else {
                            form.submit();

                            if(submitBtn) {
                                submitBtn.disabled = false;
                            }

                            if(loader) {
                                loader.remove();
                            }
                        }
                    }
                }else {
                    if(submitBtn) {
                        submitBtn.disabled = false;
                    }

                    if(loader) {
                        loader.remove();
                    }
                }
            }
        });
    }
}

/**
 * Validate a form step
 * @param form object the form to validate.
 * @param callback function an optional callback that will be trigger after the validation.
 * @return bool true if the form inputs not have errors, else return false.
 */
function idtFormStepsValidation(form, callback = null) {
    if(form) {
        const steps = form.querySelectorAll('.idt-form__step');
        const stepsIndicators = form.querySelectorAll('.idt-form__steps-indicators .idt-form__steps-indicator');

        if(steps.length) {
            for(let step of steps) {
                const stepSubmit = step.querySelector('[data-to-step]');

                if(stepSubmit) {
                    stepSubmit.addEventListener('click', (e) => {
                        e.preventDefault();

                        const stepSubmitType = stepSubmit.getAttribute('type');
                        const validateStep = stepSubmit.dataset.validateStep;
                        const toStep = stepSubmit.dataset.toStep;
                        const inputs = step.querySelectorAll('input, select, textarea');
                        const elementLoader = `<div class="idt-spinner idt-form__loader" role="status">
                                                    <span class="idt-visually-hidden">Loading...</span>
                                               </div>`;
                        let isValidFormStep = {
                            isValidInputs: true
                        };
                        let loader = null;

                        step.insertAdjacentHTML('beforeend', elementLoader);

                        loader = step.querySelector('.idt-form__loader');

                        stepSubmit.disabled = true;

                        if(validateStep) {
                            if(inputs) {
                                idtRemoveErrorMessages(form);
                                isValidFormStep = idtInputsValidation(inputs);
                            }
                        }

                        if(isValidFormStep.isValidInputs) {
                            const nextStep = form.querySelector(`[data-step="${toStep}"]`);

                            if(stepSubmitType === 'submit') {
                                if(callback) {
                                    callback(form, loader, stepSubmit, steps, step, toStep, stepsIndicators);
                                }else {
                                    form.submit();

                                    stepSubmit.disabled = false;

                                    if(loader) {
                                        loader.remove();
                                    }
                                }
                            }else {
                                stepSubmit.disabled = false;

                                if(loader) {
                                    loader.remove();
                                }

                                idtFormNextStep(steps, toStep, stepsIndicators);
                            }
                        }else {
                            stepSubmit.disabled = false;

                            if(loader) {
                                loader.remove();
                            }
                        }
                    });
                }
            }
        }
    }
}

/**
 * Show the next form step
 * @param steps HTMLNodes The steps containers
 * @param toStep int The next form step to show
 * @param stepsIndicators HTMLNodes The form steps indicators if existed.
 * @return void
 */
function idtFormNextStep(steps = null, toStep  = null, stepsIndicators = null) {
    if(steps && toStep) {
        const nextStep = steps[0].closest('form').querySelector(`[data-step="${toStep}"]`);

        if(nextStep) {
            for(let step of steps) {
                step.classList.remove('show');
            }

            nextStep.classList.add('show');

            if(stepsIndicators) {
                const nextIndicator = parseInt(toStep);
                let stepIndicatorCount = 0;

                for(let indicator of stepsIndicators) {
                    stepIndicatorCount++;
                    if(stepIndicatorCount <= nextIndicator) {
                        indicator.classList.add('active');
                    }else {
                        indicator.classList.remove('active');
                    }
                }
            }
        }
    }
}

/**
 * Validate inputs to check errors
 * @param inputs object The inputs to validate
 * @return object Result with the validation status and an array of extra validations to made on server side
 */
function idtInputsValidation(inputs = null) {
    let validations = {
        isValidInputs: true,
        serverSideValidations: []
    };

    if(inputs) {

        for(let input of inputs) {
            let isValidInput = true;
            const name = input.name ? input.name : null;
            const type = input.type ? input.type.toLowerCase() : input.tagName ? input.tagName.toLowerCase() : null;
            const value = input.value;
            const inputAppended = input.dataset.appended ? input.dataset.appended : false;
            const isRequired = !!input.hasAttribute('required');
            const isValidateType = input.dataset.validateType ? input.dataset.validateType : false;

            const validateUrlExist = input.dataset.validateUrlExist ? input.dataset.validateUrlExist : false;
            const validateUrlExistErrorMsg = input.dataset.validateUrlExistErrorMsg ? input.dataset.validateUrlExistErrorMsg : false;

            const validateExp = input.dataset.validateExp ? input.dataset.validateExp : false;

            const validateExcludeExpList = input.dataset.validateExcludeExpList ? input.dataset.validateExcludeExpList : false;
            const validateExcludeExpListErrorMsg = input.dataset.validateExcludeExpListErrorMsg ? input.dataset.validateExcludeExpListErrorMsg : false;

            const validateExcludeType = input.dataset.validateExcludeType ? input.dataset.validateExcludeType : false;
            const validateExcludeTypeErrorMsg = input.dataset.validateExcludeTypeErrorMsg ? input.dataset.validateExcludeErrorMsg : false;

            let errorMsg = input.dataset.errorMsg ? input.dataset.errorMsg : false;

            // Validation for input required
            if(isRequired) {
                switch(type) {
                    case 'checkbox':
                        if(!input.checked) {
                            isValidInput = false;
                        }
                        break;
                    case 'radio':
                        const inputsRadio = input
                            .closest('.idt-form, .idt-radio-group')
                            .querySelector( `input[name="${name}"]:checked` );
                        if(!inputsRadio) {
                            isValidInput = false;
                        }
                        break;
                    case 'text':
                    case 'email':
                    case 'url':
                    case 'tel':
                    case 'select':
                    case 'select-one':
                    case 'select-multiple':
                    case 'textarea':
                    default:
                        if(!value) {
                            isValidInput = false;
                        }
                        break;
                }
            }

            // Validate the input by input type
            if(isValidateType) {
                switch(type) {
                    case 'email':
                        const emailValidationExp = validateExp ? validateExp : idtGetValidationExpressions('email');
                        if(!value || value === '' || !emailValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'url':
                        const urlValidationExp = validateExp ? validateExp : idtGetValidationExpressions('url');
                        if(!value || value === '' || !urlValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'tel':
                        const telValidationExp = validateExp ? validateExp : idtGetValidationExpressions('tel');
                        if(!value || value === '' || !telValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'number':
                        if(!value || !isNaN(value)) {
                            isValidInput = false;
                        }
                        break;
                    default:
                        break;
                }
            }

            // Validate if input not have an excluded data type
            if(validateExcludeType) {
                switch(validateExcludeType) {
                    case 'email':
                        const emailValidationExp = validateExp ? validateExp : idtGetValidationExpressions('emailNamespace');
                        if(value && value !== '' && emailValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'url':
                        const urlValidationExp = validateExp ? validateExp : idtGetValidationExpressions('url');
                        if(value && value !== '' && urlValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'tel':
                        const telValidationExp = validateExp ? validateExp : idtGetValidationExpressions('tel');
                        if(value && value !== '' && telValidationExp.test(value)) {
                            isValidInput = false;
                        }
                        break;
                    case 'number':
                        if(value && isNaN(value)) {
                            isValidInput = false;
                        }
                        break;
                    default:
                        break;
                }
            }

            // Validate if the input value not have the values on the list
            if(validateExcludeExpList) {
                validations.serverSideValidations.push(
                    {
                        validation: 'validateExcludeExpList',
                        errorMsg: validateExcludeExpListErrorMsg,
                        excludesList: validateExcludeExpList,
                        value: value
                    }
                );
            }

            // Validate if the input value have an existing url
            if(validateUrlExist) {
                validations.serverSideValidations.push(
                    {
                        validation: 'validateUrlExist',
                        errorMsg: validateUrlExistErrorMsg,
                        value: value
                    }
                );
            }

            // Add default error message if the input is invalid and custom error message not exist
            if(!isValidInput) {
                validations.isValidInputs = isValidInput;

                if(!errorMsg) {
                    errorMsg = 'This field is required.';
                }
                const errorAlert = `<div class="idt-form__error-msg" role="alert">${errorMsg}</div>`;

                if(inputAppended) {
                    const parent = input.closest('.idt-form__input-append');

                    if(parent) {
                        parent.insertAdjacentHTML('afterend', errorAlert);
                    }
                }else if(type === 'checkbox') {
                    const parent = input.closest('.idt-form__checkbox');

                    if(parent) {
                        parent.insertAdjacentHTML('beforeend', errorAlert);
                    }
                }else {
                    input.insertAdjacentHTML('afterend', errorAlert);
                }
            }
        }
    } else {
        validations.isValidInputs = false;
    }

    return validations;
}

/**
 * Return a validation expression
 * @param target string the desired validation to be returned
 * @return string a regex expression
 */
function idtGetValidationExpressions(target = '') {
    let validationExp;

    switch(target) {
        case 'email':
            validationExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            break;
        case 'emailNamespace':
            validationExp = /^\w+([\.-]?\w+)*@/;
            break;
        case 'text':
            validationExp = /^[a-zA-Z \u00C0-\u00FF]*$/;
            break;
        case 'tel':
            validationExp = /^\(?([0-9]{7,11})$/;
            break;
        case 'url':
            validationExp = /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i;
            break;
        default:
            validationExp = '';
            break;
    }

    return validationExp;
}

/**
 * Validate a required input
 * @param input object the input to validate
 * @return bool true if the input
 */
function idtValidateRequired(input) {
    let validationExp;

    switch(target) {
        case 'email':
            validationExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            break;
        case 'text':
            validationExp = /^[a-zA-Z \u00C0-\u00FF]*$/;
            break;
        case 'phone':
            validationExp = /^\(?([0-9]{7,10})$/;
            break;
        case 'url':
            validationExp = /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i;
            break;
        default:
            validationExp = '';
            break;
    }

    return validationExp;
}

/**
 * Remove error messages
 * @param form object the form when the errors are showed
 * @return void
 */
function idtRemoveErrorMessages(form = null) {
    if(form) {
        const errorMessages = form.querySelectorAll('.idt-form__error-msg, .idt-form__alert');

        if(errorMessages) {
            for(let errorMessage of errorMessages) {
                errorMessage.remove();
            }
        }
    }
}

export {idtFormValidation, idtFormStepsValidation};