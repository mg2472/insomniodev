/**
 * Init the child component resources
 * @return void
 */
function idtPerformanceResources(container) {
    if(container) {
        const inputBootstrapImportStyles = container.querySelector('select[name="bootstrapImportStyles"]');
        const bootstrapImportStylesOptions = container.querySelectorAll('.idt-dashboard__bootstrap-import-styles-option');

        if(inputBootstrapImportStyles) {
            inputBootstrapImportStyles.addEventListener('change', () => {
                const value = inputBootstrapImportStyles.value;

                if(bootstrapImportStylesOptions) {
                    for(let item of bootstrapImportStylesOptions) {
                        item.classList.add('idt-dashboard__hide');
                    }
                }

                if(value === 'cssSelectedFiles') {
                    const cssSelectedFilesContainer = container.querySelector('#idt-dashboard__bootstrap-import-styles-1');

                    if(cssSelectedFilesContainer) {
                        cssSelectedFilesContainer.classList.remove('idt-dashboard__hide');
                    }
                }else if(value === 'scssSelectedFiles') {
                    const scssSelectedFilesContainer = container.querySelector('#idt-dashboard__bootstrap-import-styles-2');

                    if(scssSelectedFilesContainer) {
                        scssSelectedFilesContainer.classList.remove('idt-dashboard__hide');
                    }
                }
            });
        }
    }
}

export {idtPerformanceResources}