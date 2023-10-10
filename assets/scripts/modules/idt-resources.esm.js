/**
 * Import tags when the script is loaded
 * @param link string the resource url
 * @param tag string the resource tag, can be "script" or "link"
 * @param args object tag additional attributes or properties
 * @return void
 */
function idtImportResource(link, tag, args = {}) {
    if (link && link !== '' && tag && tag !== '') {
        const head = document.querySelector('head');
        let resource;
        let tagArgs = Object.entries(args);
        let customTagArgs = [];

        if (tagArgs.length) {
            for (let [key, value] of tagArgs) {
                customTagArgs.push(`${key}="${value}"`);
            }
        }

        if (head) {
            switch(tag) {
                case 'link':
                    let customAttrs = customTagArgs.length ? customTagArgs.join(' ') : 'rel="stylesheet"';

                    resource = `<link href="${link}" ${customAttrs}>`;
                    break;
                default:
                    break
            }

            head.insertAdjacentHTML('beforeend', resource);
        }
    }
}

/**
 * Import a list of tags when the script is loaded
 * @param items array The tags to import
 * @return void
 */
function idtImportResources(items) {
    if (items && items.length) {
        for (let item of items) {
            idtImportResource(item.link ?? '', item.tag ?? '', item.args ?? {});
        }
    }
}

export {idtImportResource, idtImportResources};