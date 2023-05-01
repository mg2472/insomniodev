/**
 * Lazy load images.
 * @return void
 */
function idtLazyLoadImages() {
    const lazyImages = document.querySelectorAll('.idt-lazy');

    if(!lazyImages.length) return;

    if('IntersectionObserver' in window) {
        let lazyImageObserver = new IntersectionObserver(entries => {

            entries.forEach(entry => {
                let lazyImage = entry.target;

                if(entry.isIntersecting && lazyImage.classList.contains('idt-lazy')) {

                    if(lazyImage.classList.contains( 'idt-holder')) {
                        lazyImage.setAttribute('style', `background-image: url(${lazyImage.dataset.src})`);
                    }else {
                        lazyImage.src = lazyImage.dataset.src;
                    }

                    lazyImage.classList.remove('idt-lazy');
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(lazyImage => {
            lazyImageObserver.observe(lazyImage);
        });
    }
}

/**
 * WordPress media handler.
 * @return void
 */
function idtWpMediaImage() {
    const items = document.querySelectorAll('.idt-image-manager');

    if (!items.length) return;

    for (let item of items) {
        const preview = item.querySelector('.idt-image-manager__preview-image');
        const button = item.querySelector('.idt-image-manager__button');
        const input = item.querySelector('.idt-image-manager__input');

        if (preview && button && input) {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                let fileFrame;
                let wpMediaPostId = wp.media.model.settings.post.id;
                let setToPostId = input.value;

                if (fileFrame) {
                    // Set the post ID to what we want
                    fileFrame.uploader.uploader.param('post_id', setToPostId);
                    // Open frame
                    fileFrame.open();
                    return;
                } else {
                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                    wp.media.model.settings.post.id = 0;
                }

                // Create the media frame.
                fileFrame = wp.media.frames.file_frame = wp.media({
                    title: 'Select a image',
                    button: {
                        text: 'Select a image'
                    },
                    multiple: false	// Set to true to allow multiple files to be selected
                } );

                // When an image is selected, run a callback.
                fileFrame.on('select', () => {
                    // We set multiple to false so only get one image from the uploader
                    let attachment = fileFrame.state().get( 'selection' ).first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    preview.src = attachment.url;
                    input.value = attachment.id;
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wpMediaPostId;
                });

                // Finally, open the modal
                fileFrame.open();
            });
        }
    }
}

export {idtLazyLoadImages, idtWpMediaImage};