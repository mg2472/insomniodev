/**
 * Init the social share controller
 * @param items object the share elements to trigger the function
 * @return void
 */
function idtSocialShare(items = null) {
    if(items) {
        for(let item of items) {
            item.addEventListener('click', ()=>{
                const shareUrl = item.dataset.url ? item.dataset.url : window.location.href;
                const shareTitle = item.dataset.shareTitle ? item.dataset.shareTitle : document.title;
                const shareText = item.dataset.shareText ? item.dataset.shareText : null;

                if ('share' in navigator) {
                    const newNavigation = window.navigator;
                    const dataToShare = {
                        title: shareTitle,
                        text: shareText,
                        url: shareUrl
                    };

                    newNavigation.share(dataToShare);
                }
            });
        }
    }
}

export {idtSocialShare};