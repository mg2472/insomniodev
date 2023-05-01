<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

?>
<div class="idt-dashboard__component" id="idt-dashboard__component-settings">
    <h1 class="idt-dashboard__title-2"><?php _e('Settings', 'insomniodev'); ?></h1>
    <form class="idt-dashboard__form idt-dashboard__form--style-2" novalidate>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-disable-gutenberg-editor"
                   class="idt-dashboard__label"><?php _e('Disable Gutenberg editor', 'insomniodev'); ?></label>
            <label class="idt-dashboard__input-switch">
                <input type="checkbox"
                       id="idt-dashboard__input-disable-gutenberg-editor"
                       name="disableGutenbergEditor"
                >
                <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
            </label>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-disable-widgets-block-editor"
                   class="idt-dashboard__label"><?php _e('Disable widgets block editor', 'insomniodev'); ?></label>
            <label class="idt-dashboard__input-switch">
                <input type="checkbox"
                       id="idt-dashboard__input-disable-widgets-block-editor"
                       name="disableWidgetsBlockEditor"
                >
                <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
            </label>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-copyright"
                   class="idt-dashboard__label"><?php _e('Copyright', 'insomniodev'); ?></label>
            <textarea class="idt-dashboard__input"
                      id="idt-dashboard__input-copyright"
                      name="copyright"
                      placeholder="<?php _e('Copyright', 'insomniodev'); ?>"></textarea>
        </div>
        <div class="idt-dashboard__submit">
            <button type="submit"
                    class="idt-dashboard__button-1">
                <?php _e('Save changes', 'insomniodev'); ?>
                <div class="idt-dashboard__loader hide">
                    <svg class="idt-dashboard__loader-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z"/></svg>
                </div>
            </button>
        </div>
    </form>
</div>
