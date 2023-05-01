/**
 * Init the admin tabs functions
 * @return void
 */
function idtAdminTabs() {
    const containers = document.querySelectorAll('.idt-dashboard__tabs');

    if(!containers) return;

    for(let container of containers) {
        const tabs = container.querySelectorAll('.idt-dashboard__tab');
        const tabsTargets = container.querySelectorAll('.idt-dashboard__tab-target');

        if(tabs) {
            for(let tab of tabs) {
                tab.addEventListener('click', () => {
                    const target = tab.dataset.target;

                    if(tabsTargets) {
                        for(let tabTarget of tabsTargets) {
                            tabTarget.classList.remove('show');
                        }
                    }

                    if(target) {
                        const tabTarget = document.querySelector(target);

                        if(tabTarget) {

                            for(let tab of tabs) {
                                tab.classList.remove('active');
                            }

                            tab.classList.add('active');
                            tabTarget.classList.add('show');
                        }
                    }
                });
            }
        }
    }
}

export {idtAdminTabs}