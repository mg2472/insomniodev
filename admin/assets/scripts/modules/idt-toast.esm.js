/**
 * Show a toast on the screen
 * @param messages array The messages that will show the toast
 * @param args object The toast arguments
 * @return void
 */
function idtToast(messages, args) {
    if(messages) {
        const oldToasts = document.querySelectorAll('.idt-dashboard__toast');
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

        for(let message of messages) {
            const infoAlert = `<div class="idt-dashboard__alert">${message}</div>`;
            toast.insertAdjacentHTML(
                'beforeend',
                infoAlert
            );
        }

        if(oldToasts && args.removeToasts) {
            for(let toast of oldToasts) {
                toast.remove();
            }
        }

        document.querySelector('.idt-dashboard').after(toast);
    }
}

export {idtToast};