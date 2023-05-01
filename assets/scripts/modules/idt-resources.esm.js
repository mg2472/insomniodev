/**
 * Import tags when the script is loaded
 * @param link string the resource url
 * @param tag string the resource tag, can be "script" or "link"
 * @param args object tag additional attributes or properties
 * @return void
 */
function idtImportResource(link, tag, args = {}) {
    if(link && link !== '' && tag && tag !== '') {
        const head = document.querySelector('head');
        let resource;

        if(head) {
            switch(tag) {
                case 'link':
                    resource = `<link href="${link}" rel="stylesheet">`;
                    break;
                default:
                    break
            }

            head.insertAdjacentHTML('beforeend', resource);
        }
    }
}

export {idtImportResource};