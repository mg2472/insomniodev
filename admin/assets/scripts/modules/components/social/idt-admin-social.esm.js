import {idtFetchRequest} from "../../../../../../assets/scripts/modules/idt-fetch.esm.js";
import {idtToast} from "../../idt-toast.esm.js";

/**
 * Init the component Social functions
 * @return void
 */
function idtAdminComponentSocialInit() {
    const component = document.getElementById('idt-dashboard__component-social');

    if(!component) return;

    const form = component.querySelector('.idt-dashboard__form');
    let lang = 'all';
    let settings = {
        linkedin: {
            url: '',
            lang: ''
        },
        facebook: {
            url: '',
            lang: ''
        },
        instagram: {
            url: '',
            lang: ''
        },
        tiktok: {
            url: '',
            lang: ''
        },
        twitter: {
            url: '',
            lang: ''
        },
        youtube: {
            url: '',
            lang: ''
        },
        pinterest: {
            url: '',
            lang: ''
        },
        spotify: {
            url: '',
            lang: ''
        },
        twitch: {
            url: '',
            lang: ''
        },
        reddit: {
            url: '',
            lang: ''
        },
        telegram: {
            url: '',
            lang: ''
        },
        whatsapp1: {
            url: '',
            lang: ''
        },
        whatsapp2: {
            url: '',
            lang: ''
        },
        whatsapp3: {
            url: '',
            lang: ''
        },
        whatsapp4: {
            url: '',
            lang: ''
        },
        customValues: []
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
                method: 'updateSocialSettings',
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

        getSettings(component, form, lang);
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
        method: 'getSocialSettings',
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
        const socialNetworks = values.socialNetworks ? values.socialNetworks : {};
        const customNetworks = values.customNetworks ? values.customNetworks : [];

        //Linkedin Url
        const inputLinkedinUrl = form.querySelector('input[name="linkedinUrl"]');
        if(inputLinkedinUrl && socialNetworks.linkedin) {
            inputLinkedinUrl.value = socialNetworks.linkedin.url ? socialNetworks.linkedin.url : '';
        }

        //Facebook Url
        const inputFacebookUrl = form.querySelector('input[name="facebookUrl"]');
        if(inputFacebookUrl && socialNetworks.facebook) {
            inputFacebookUrl.value = socialNetworks.facebook.url ? socialNetworks.facebook.url : '';
        }

        //Instagram Url
        const inputInstagramUrl = form.querySelector('input[name="instagramUrl"]');
        if(inputInstagramUrl && socialNetworks.instagram) {
            inputInstagramUrl.value = socialNetworks.instagram.url ? socialNetworks.instagram.url : '';
        }

        //TikTok Url
        const inputTiktokUrl = form.querySelector('input[name="tiktokUrl"]');
        if(inputTiktokUrl && socialNetworks.tiktok) {
            inputTiktokUrl.value = socialNetworks.tiktok.url ? socialNetworks.tiktok.url : '';
        }

        //Twitter Url
        const inputTwitterUrl = form.querySelector('input[name="twitterUrl"]');
        if(inputTwitterUrl && socialNetworks.twitter) {
            inputTwitterUrl.value = socialNetworks.twitter.url ? socialNetworks.twitter.url : '';
        }

        //Youtube Url
        const inputYoutubeUrl = form.querySelector('input[name="youtubeUrl"]');
        if(inputYoutubeUrl && socialNetworks.youtube) {
            inputYoutubeUrl.value = socialNetworks.youtube.url ? socialNetworks.youtube.url : '';
        }

        //Pinterest Url
        const inputPinterestUrl = form.querySelector('input[name="pinterestUrl"]');
        if(inputPinterestUrl && socialNetworks.pinterest) {
            inputPinterestUrl.value = socialNetworks.pinterest.url ? socialNetworks.pinterest.url : '';
        }

        //Spotify Url
        const inputSpotifyUrl = form.querySelector('input[name="spotifyUrl"]');
        if(inputSpotifyUrl && socialNetworks.spotify) {
            inputSpotifyUrl.value = socialNetworks.spotify.url ? socialNetworks.spotify.url : '';
        }

        //Twitch Url
        const inputTwitchUrl = form.querySelector('input[name="twitchUrl"]');
        if(inputTwitchUrl && socialNetworks.twitch) {
            inputTwitchUrl.value = socialNetworks.twitch.url ? socialNetworks.twitch.url : '';
        }

        //Reddit Url
        const inputRedditUrl = form.querySelector('input[name="redditUrl"]');
        if(inputRedditUrl && socialNetworks.reddit) {
            inputRedditUrl.value = socialNetworks.reddit.url ? socialNetworks.reddit.url : '';
        }

        //Telegram Url
        const inputTelegramUrl = form.querySelector('input[name="telegramUrl"]');
        if(inputTelegramUrl && socialNetworks.telegram) {
            inputTelegramUrl.value = socialNetworks.telegram.url ? socialNetworks.telegram.url : '';
        }

        //Whatsapp 1 Url
        const inputWhatsapp1Url = form.querySelector('input[name="whatsapp1Url"]');
        if(inputWhatsapp1Url && socialNetworks.whatsapp1) {
            inputWhatsapp1Url.value = socialNetworks.whatsapp1.url ? socialNetworks.whatsapp1.url : '';
        }

        //Whatsapp 2 Url
        const inputWhatsapp2Url = form.querySelector('input[name="whatsapp2Url"]');
        if(inputWhatsapp2Url && socialNetworks.whatsapp2) {
            inputWhatsapp2Url.value = socialNetworks.whatsapp2.url ? socialNetworks.whatsapp2.url : '';
        }

        //Whatsapp 3 Url
        const inputWhatsapp3Url = form.querySelector('input[name="whatsapp3Url"]');
        if(inputWhatsapp3Url && socialNetworks.whatsapp3) {
            inputWhatsapp3Url.value = socialNetworks.whatsapp3.url ? socialNetworks.whatsapp3.url : '';
        }

        //Whatsapp 4 Url
        const inputWhatsapp4Url = form.querySelector('input[name="whatsapp4Url"]');
        if(inputWhatsapp4Url && socialNetworks.whatsapp4) {
            inputWhatsapp4Url.value = socialNetworks.whatsapp4.url ? socialNetworks.whatsapp4.url : '';
        }
    }
}

/**
 * Set the form fields values
 * @param form The form
 * @param values The values model
 * @param lang string Settings language
 * @return object Form values
 */
function getFormValues(form, values, lang = 'all') {
    if(form && values) {

        //Linkedin Url
        const inputLinkedinUrl = form.querySelector('input[name="linkedinUrl"]');
        if(inputLinkedinUrl) {
            values.linkedin.url = inputLinkedinUrl.value;
        }

        //Linkedin Lang
        values.linkedin.lang = lang;

        //Facebook Url
        const inputFacebookUrl = form.querySelector('input[name="facebookUrl"]');
        if(inputFacebookUrl) {
            values.facebook.url = inputFacebookUrl.value;
        }

        //Facebook Lang
        values.facebook.lang = lang;

        //Instagram Url
        const inputInstagramUrl = form.querySelector('input[name="instagramUrl"]');
        if(inputInstagramUrl) {
            values.instagram.url = inputInstagramUrl.value;
        }

        //Instagram Lang
        values.instagram.lang = lang;

        //Tiktok Url
        const inputTiktokUrl = form.querySelector('input[name="tiktokUrl"]');
        if(inputTiktokUrl) {
            values.tiktok.url = inputTiktokUrl.value;
        }

        //Tiktok Lang
        values.tiktok.lang = lang;

        //Twitter Url
        const inputTwitterUrl = form.querySelector('input[name="twitterUrl"]');
        if(inputTwitterUrl) {
            values.twitter.url = inputTwitterUrl.value;
        }

        //Twitter Lang
        values.twitter.lang = lang;

        //Youtube Url
        const inputYoutubeUrl = form.querySelector('input[name="youtubeUrl"]');
        if(inputYoutubeUrl) {
            values.youtube.url = inputYoutubeUrl.value;
        }

        //Youtube Lang
        values.youtube.lang = lang;

        //Pinterest Url
        const inputPinterestUrl = form.querySelector('input[name="pinterestUrl"]');
        if(inputPinterestUrl) {
            values.pinterest.url = inputPinterestUrl.value;
        }

        //Pinterest Lang
        values.pinterest.lang = lang;

        //Spotify Url
        const inputSpotifyUrl = form.querySelector('input[name="spotifyUrl"]');
        if(inputSpotifyUrl) {
            values.spotify.url = inputSpotifyUrl.value;
        }

        //Spotify Lang
        values.spotify.lang = lang;

        //Twitch Url
        const inputTwitchUrl = form.querySelector('input[name="twitchUrl"]');
        if(inputTwitchUrl) {
            values.twitch.url = inputTwitchUrl.value;
        }

        //Twitch Lang
        values.twitch.lang = lang;

        //Reddit Url
        const inputRedditUrl = form.querySelector('input[name="redditUrl"]');
        if(inputRedditUrl) {
            values.reddit.url = inputRedditUrl.value;
        }

        //Reddit Lang
        values.reddit.lang = lang;

        //Telegram Url
        const inputTelegramUrl = form.querySelector('input[name="telegramUrl"]');
        if(inputTelegramUrl) {
            values.telegram.url = inputTelegramUrl.value;
        }

        //Telegram Lang
        values.telegram.lang = lang;

        //Whatsapp 1 Url
        const inputWhatsapp1Url = form.querySelector('input[name="whatsapp1Url"]');
        if(inputWhatsapp1Url) {
            values.whatsapp1.url = inputWhatsapp1Url.value;
        }

        //Whatsapp 1 Lang
        values.whatsapp1.lang = lang;

        //Whatsapp 2 Url
        const inputWhatsapp2Url = form.querySelector('input[name="whatsapp2Url"]');
        if(inputWhatsapp2Url) {
            values.whatsapp2.url = inputWhatsapp2Url.value;
        }

        //Whatsapp 2 Lang
        values.whatsapp2.lang = lang;

        //Whatsapp 3 Url
        const inputWhatsapp3Url = form.querySelector('input[name="whatsapp3Url"]');
        if(inputWhatsapp3Url) {
            values.whatsapp3.url = inputWhatsapp3Url.value;
        }

        //Whatsapp 3 Lang
        values.whatsapp3.lang = lang;

        //Whatsapp 4 Url
        const inputWhatsapp4Url = form.querySelector('input[name="whatsapp4Url"]');
        if(inputWhatsapp4Url) {
            values.whatsapp4.url = inputWhatsapp4Url.value;
        }

        //Whatsapp 4 Lang
        values.whatsapp4.lang = lang;
    }

    return values;
}

export {idtAdminComponentSocialInit}