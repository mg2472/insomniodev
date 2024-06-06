import {idtFetchRequest} from "../../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtToast} from "../../../idt-toast.esm.js";

/**
 * Init the child component general performance settings
 * @return void
 */
function idtPerformanceGeneralSettings(container) {
    if(container) {
        const form = container.querySelector('.idt-dashboard__form');
        let lang = 'all';
        let settings = {
            enableThemeScssCompiler: {
                value: '',
                group: '',
                lang: ''
            },
            enableChildThemeScssCompiler: {
                value: '',
                group: '',
                lang: ''
            },
            disableJquery: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleWpGlobalStyles: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleWpBlockLibrary: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleWpBlockLibraryTheme: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleClassicTheme: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleDashicons: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojis: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojisContentFeed: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojisTextRss: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojisEmail: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojisTinyMcePlugins: {
                value: '',
                group: '',
                lang: ''
            },
            disableStyleEmojisDns: {
                value: '',
                group: '',
                lang: ''
            },
        };

        if(form) {
            form.addEventListener('submit', (event) => {
                event.preventDefault();

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

                settings = getFormValues(form, settings, lang);

                idtFetchRequest({
                    action: 'adminRequestsRouter',
                    group: 'settings',
                    method: 'updateGeneralSettings',
                    data: settings,
                }, idtAdminSettings.ajaxUrl).then(data => {
                    let messages = [];
                    const toastArgs = {
                        removeToasts: true
                    };

                    if(data.errors.length) {
                        for(let error of data.errors) {
                            messages.push(error);
                        }
                    } else if(data.message !== '') {
                        messages.push(data.message);
                    }

                    idtToast(messages, toastArgs);

                    if(submitBtn) {
                        submitBtn.disabled = false;
                    }

                    if(loader) {
                        loader.classList.add('hide');
                    }
                });
            });

            getSettings(container, form, lang);
        }
    }
}

/**
 * Get the social settings values
 * @param component htmlNode The component where the messages will be rendered
 * @param form htmlNode The form where the data will be rendered
 * @param lang string Settings language
 * @return void
 */
function getSettings(component, form, lang = 'all') {
    idtFetchRequest({
        action: 'adminRequestsRouter',
        group: 'settings',
        method: 'getGeneralSettings',
        data: {
            lang: lang
        },
    }, idtAdminSettings.ajaxUrl).then(data => {

        if(data.errors.length) {
            for(let error of data.errors) {
                const errorElement = `<div class="idt-dashboard__alert">${error}</div>`;
                component.insertAdjacentHTML('beforeend', errorElement);
            }
        }else if(data.message) {
            setFormValues(form, data.message);
        }
    });
}

/**
 * Set the form fields values
 * @param form The form
 * @param values The values model
 * @return void
 */
function setFormValues(form, values) {
    if(form && values) {

        //Enable theme SCSS compiler
        const inputEnableThemeScssCompiler = form.querySelector('input[name="enableThemeScssCompiler"]');
        if(inputEnableThemeScssCompiler && values.enableThemeScssCompiler && values.enableThemeScssCompiler.value === 'enabled') {
            inputEnableThemeScssCompiler.checked = true;
        }

        //Enable child theme SCSS compiler
        const inputEnableChildThemeScssCompiler = form.querySelector('input[name="enableChildThemeScssCompiler"]');
        if(inputEnableChildThemeScssCompiler && values.enableChildThemeScssCompiler && values.enableChildThemeScssCompiler.value === 'enabled') {
            inputEnableChildThemeScssCompiler.checked = true;
        }

        //Disable jQuery
        const inputDisableJquery = form.querySelector('input[name="disableJquery"]');
        if(inputDisableJquery && values.disableJquery && values.disableJquery.value === 'disabled') {
            inputDisableJquery.checked = true;
        }

        //Disable style: WP Global styles
        const inputDisableStyleWpGlobalStyles = form.querySelector('input[name="disableStyleWpGlobalStyles"]');
        if(inputDisableStyleWpGlobalStyles && values.disableStyleWpGlobalStyles && values.disableStyleWpGlobalStyles.value === 'disabled') {
            inputDisableStyleWpGlobalStyles.checked = true;
        }

        //Disable style: WP Block Library
        const inputDisableStyleWpBlockLibrary = form.querySelector('input[name="disableStyleWpBlockLibrary"]');
        if(inputDisableStyleWpBlockLibrary && values.disableStyleWpBlockLibrary && values.disableStyleWpBlockLibrary.value === 'disabled') {
            inputDisableStyleWpBlockLibrary.checked = true;
        }

        //Disable style: WP Block Library Theme
        const inputDisableStyleWpBlockLibraryTheme = form.querySelector('input[name="disableStyleWpBlockLibraryTheme"]');
        if(inputDisableStyleWpBlockLibraryTheme && values.disableStyleWpBlockLibraryTheme && values.disableStyleWpBlockLibraryTheme.value === 'disabled') {
            inputDisableStyleWpBlockLibraryTheme.checked = true;
        }

        //Disable style: Classic Theme
        const inputDisableStyleClassicTheme = form.querySelector('input[name="disableStyleClassicTheme"]');
        if(inputDisableStyleClassicTheme && values.disableStyleClassicTheme && values.disableStyleClassicTheme.value === 'disabled') {
            inputDisableStyleClassicTheme.checked = true;
        }

        //Disable style: Dashicons
        const inputDisableStyleDashicons = form.querySelector('input[name="disableStyleDashicons"]');
        if(inputDisableStyleDashicons && values.disableStyleDashicons && values.disableStyleDashicons.value === 'disabled') {
            inputDisableStyleDashicons.checked = true;
        }

        //Disable style: Emojis
        const inputDisableStyleEmojis = form.querySelector('input[name="disableStyleEmojis"]');
        if(inputDisableStyleEmojis && values.disableStyleEmojis && values.disableStyleEmojis.value === 'disabled') {
            inputDisableStyleEmojis.checked = true;
        }

        //Disable style: Emojis in content feed
        const inputDisableStyleEmojisContentFeed = form.querySelector('input[name="disableStyleEmojisContentFeed"]');
        if(inputDisableStyleEmojisContentFeed && values.disableStyleEmojisContentFeed && values.disableStyleEmojisContentFeed.value === 'disabled') {
            inputDisableStyleEmojisContentFeed.checked = true;
        }

        //Disable style: Emojis in text RSS
        const inputDisableStyleEmojisTextRss = form.querySelector('input[name="disableStyleEmojisTextRss"]');
        if(inputDisableStyleEmojisTextRss && values.disableStyleEmojisTextRss && values.disableStyleEmojisTextRss.value === 'disabled') {
            inputDisableStyleEmojisTextRss.checked = true;
        }

        //Disable style: Emojis in Email
        const inputDisableStyleEmojisEmail = form.querySelector('input[name="disableStyleEmojisEmail"]');
        if(inputDisableStyleEmojisEmail && values.disableStyleEmojisEmail && values.disableStyleEmojisEmail.value === 'disabled') {
            inputDisableStyleEmojisEmail.checked = true;
        }

        //Disable style: Emojis in Tiny MCE Plugins
        const inputDisableStyleEmojisTinyMcePlugins = form.querySelector('input[name="disableStyleEmojisTinyMcePlugins"]');
        if(inputDisableStyleEmojisTinyMcePlugins && values.disableStyleEmojisTinyMcePlugins && values.disableStyleEmojisTinyMcePlugins.value === 'disabled') {
            inputDisableStyleEmojisTinyMcePlugins.checked = true;
        }

        //Disable style: Emojis in DNS Cache
        const inputDisableStyleEmojisDns = form.querySelector('input[name="disableStyleEmojisDns"]');
        if(inputDisableStyleEmojisDns && values.disableStyleEmojisDns && values.disableStyleEmojisDns.value === 'disabled') {
            inputDisableStyleEmojisDns.checked = true;
        }
    }
}

/**
 * Get the form fields values
 * @param form The form
 * @param values The values model
 * @param lang string Settings language
 * @return object Form values
 */
function getFormValues(form, values, lang = 'all') {
    if (form && values) {

        //Enable theme SCSS compiler
        const inputEnableThemeScssCompiler = form.querySelector('input[name="enableThemeScssCompiler"]');
        if (inputEnableThemeScssCompiler) {
            if (inputEnableThemeScssCompiler.checked) {
                values.enableThemeScssCompiler.value = 'enabled';
            } else {
                values.enableThemeScssCompiler.value = 'disabled';
            }
        }

        //Enable theme SCSS compiler Lang and Group
        values.enableThemeScssCompiler.group = 'performance';
        values.enableThemeScssCompiler.lang = 'all';


        //Enable child theme SCSS compiler
        const inputEnableChildThemeScssCompiler = form.querySelector('input[name="enableChildThemeScssCompiler"]');
        if (inputEnableChildThemeScssCompiler) {
            if (inputEnableChildThemeScssCompiler.checked) {
                values.enableChildThemeScssCompiler.value = 'enabled';
            } else {
                values.enableChildThemeScssCompiler.value = 'disabled';
            }
        }

        //Enable child theme SCSS compiler Lang and Group
        values.enableChildThemeScssCompiler.group = 'performance';
        values.enableChildThemeScssCompiler.lang = 'all';

        //Disable jQuery
        const inputDisableJquery = form.querySelector('input[name="disableJquery"]');
        if (inputDisableJquery) {
            if (inputDisableJquery.checked) {
                values.disableJquery.value = 'disabled';
            } else {
                values.disableJquery.value = 'enabled';
            }
        }

        //Disable jQuery Lang and Group
        values.disableJquery.group = 'performance';
        values.disableJquery.lang = 'all';

        //Disable style: WP Block Library
        const inputDisableStyleWpBlockLibrary = form.querySelector('input[name="disableStyleWpBlockLibrary"]');
        if (inputDisableStyleWpBlockLibrary) {
            if (inputDisableStyleWpBlockLibrary.checked) {
                values.disableStyleWpBlockLibrary.value = 'disabled';
            } else {
                values.disableStyleWpBlockLibrary.value = 'enabled';
            }
        }

        //Disable style: WP Block Library Lang and Group
        values.disableStyleWpBlockLibrary.group = 'performance';
        values.disableStyleWpBlockLibrary.lang = 'all';

        //Disable style: WP Global styles
        const inputDisableStyleWpGlobalStyles = form.querySelector('input[name="disableStyleWpGlobalStyles"]');
        if (inputDisableStyleWpGlobalStyles) {
            if (inputDisableStyleWpGlobalStyles.checked) {
                values.disableStyleWpGlobalStyles.value = 'disabled';
            } else {
                values.disableStyleWpGlobalStyles.value = 'enabled';
            }
        }

        //Disable style: Global styles Lang and Group
        values.disableStyleWpGlobalStyles.group = 'performance';
        values.disableStyleWpGlobalStyles.lang = 'all';

        //Disable style: WP Block Library Theme
        const inputDisableStyleWpBlockLibraryTheme = form.querySelector('input[name="disableStyleWpBlockLibraryTheme"]');
        if (inputDisableStyleWpBlockLibraryTheme) {
            if (inputDisableStyleWpBlockLibraryTheme.checked) {
                values.disableStyleWpBlockLibraryTheme.value = 'disabled';
            } else {
                values.disableStyleWpBlockLibraryTheme.value = 'enabled';
            }
        }

        //Disable style: WP Block Library Theme Lang and Group
        values.disableStyleWpBlockLibraryTheme.group = 'performance';
        values.disableStyleWpBlockLibraryTheme.lang = 'all';

        //Disable style: Classic Theme
        const inputDisableStyleClassicTheme = form.querySelector('input[name="disableStyleClassicTheme"]');
        if (inputDisableStyleClassicTheme) {
            if (inputDisableStyleClassicTheme.checked) {
                values.disableStyleClassicTheme.value = 'disabled';
            } else {
                values.disableStyleClassicTheme.value = 'enabled';
            }
        }

        //Disable style: Classic Theme Lang and Group
        values.disableStyleClassicTheme.group = 'performance';
        values.disableStyleClassicTheme.lang = 'all';

        //Disable style: Dashicons
        const inputDisableStyleDashicons = form.querySelector('input[name="disableStyleDashicons"]');
        if (inputDisableStyleDashicons) {
            if (inputDisableStyleDashicons.checked) {
                values.disableStyleDashicons.value = 'disabled';
            } else {
                values.disableStyleDashicons.value = 'enabled';
            }
        }

        //Disable style: Dashicons Lang and Group
        values.disableStyleDashicons.group = 'performance';
        values.disableStyleDashicons.lang = 'all';

        //Disable style: Emojis
        const inputDisableStyleEmojis = form.querySelector('input[name="disableStyleEmojis"]');
        if (inputDisableStyleEmojis) {
            if (inputDisableStyleEmojis.checked) {
                values.disableStyleEmojis.value = 'disabled';
            } else {
                values.disableStyleEmojis.value = 'enabled';
            }
        }

        //Disable style: Emojis Lang and Group
        values.disableStyleEmojis.group = 'performance';
        values.disableStyleEmojis.lang = 'all';

        //Disable style: Emojis Content Feed
        const inputDisableStyleEmojisContentFeed = form.querySelector('input[name="disableStyleEmojisContentFeed"]');
        if (inputDisableStyleEmojisContentFeed) {
            if (inputDisableStyleEmojisContentFeed.checked) {
                values.disableStyleEmojisContentFeed.value = 'disabled';
            } else {
                values.disableStyleEmojisContentFeed.value = 'enabled';
            }
        }

        //Disable style: Emojis Content Feed Lang and Group
        values.disableStyleEmojisContentFeed.group = 'performance';
        values.disableStyleEmojisContentFeed.lang = 'all';

        //Disable style: Emojis Text RSS
        const inputDisableStyleEmojisTextRss = form.querySelector('input[name="disableStyleEmojisTextRss"]');
        if (inputDisableStyleEmojisTextRss) {
            if (inputDisableStyleEmojisTextRss.checked) {
                values.disableStyleEmojisTextRss.value = 'disabled';
            } else {
                values.disableStyleEmojisTextRss.value = 'enabled';
            }
        }

        //Disable style: Emojis Text RSS Lang and Group
        values.disableStyleEmojisTextRss.group = 'performance';
        values.disableStyleEmojisTextRss.lang = 'all';

        //Disable style: Emojis Email
        const inputDisableStyleEmojisEmail = form.querySelector('input[name="disableStyleEmojisEmail"]');
        if (inputDisableStyleEmojisEmail) {
            if (inputDisableStyleEmojisEmail.checked) {
                values.disableStyleEmojisEmail.value = 'disabled';
            } else {
                values.disableStyleEmojisEmail.value = 'enabled';
            }
        }

        //Disable style: Emojis Email Lang and Group
        values.disableStyleEmojisEmail.group = 'performance';
        values.disableStyleEmojisEmail.lang = 'all';

        //Disable style: Emojis Tiny MCE Plugins
        const inputDisableStyleEmojisTinyMcePlugins = form.querySelector('input[name="disableStyleEmojisTinyMcePlugins"]');
        if (inputDisableStyleEmojisTinyMcePlugins) {
            if (inputDisableStyleEmojisTinyMcePlugins.checked) {
                values.disableStyleEmojisTinyMcePlugins.value = 'disabled';
            } else {
                values.disableStyleEmojisTinyMcePlugins.value = 'enabled';
            }
        }

        //Disable style: Emojis Tiny MCE Plugins Lang and Group
        values.disableStyleEmojisTinyMcePlugins.group = 'performance';
        values.disableStyleEmojisTinyMcePlugins.lang = 'all';

        //Disable style: Emojis SNS Cache
        const inputDisableStyleEmojisDns = form.querySelector('input[name="disableStyleEmojisDns"]');
        if (inputDisableStyleEmojisDns) {
            if (inputDisableStyleEmojisDns.checked) {
                values.disableStyleEmojisDns.value = 'disabled';
            } else {
                values.disableStyleEmojisDns.value = 'enabled';
            }
        }

        //Disable style: Emojis DNS Cache Lang and Group
        values.disableStyleEmojisDns.group = 'performance';
        values.disableStyleEmojisDns.lang = 'all';
    }

    return values;
}

export {idtPerformanceGeneralSettings}