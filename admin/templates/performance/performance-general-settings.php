<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * General performance settings child template
 * @since 1.0
 * @version 1.0
 */

?>
<form class="idt-dashboard__form idt-dashboard__form--style-2" novalidate>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-enable-theme-scss-compiler"
               class="idt-dashboard__label"><?php _e('Enable theme SCSS compiler', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-enable-theme-scss-compiler"
                   name="enableThemeScssCompiler"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-enable-theme-child-scss-compiler"
               class="idt-dashboard__label"><?php _e('Enable theme child SCSS compiler', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-enable-theme-child-scss-compiler"
                   name="enableChildThemeScssCompiler"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-disable-jquery"
               class="idt-dashboard__label"><?php _e('Disable jQuery', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-disable-jquery"
                   name="disableJquery"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-disable-style-wp-block-library"
               class="idt-dashboard__label"><?php _e('Disable style: WP Block Library', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-disable-style-wp-block-library"
                   name="disableStyleWpBlockLibrary"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-disable-style-wp-block-library-theme"
               class="idt-dashboard__label"><?php _e('Disable style: WP Block Library Theme', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-disable-style-wp-block-library-theme"
                   name="disableStyleWpBlockLibraryTheme"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-disable-style-classic-theme"
               class="idt-dashboard__label"><?php _e('Disable style: Classic Theme', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-disable-style-classic-theme"
                   name="disableStyleClassicTheme"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-disable-style-classic-theme"
               class="idt-dashboard__label"><?php _e('Disable style: Dashicons', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-disable-style-dashicons"
                   name="disableStyleDashicons"
            >
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
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
