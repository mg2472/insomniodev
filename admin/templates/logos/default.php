<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

$placeholder = IDT_THEME_DIR . '/admin/assets/images/placeholder-4x4.webp';
?>
<div class="idt-dashboard__component" id="idt-dashboard__component-logos">
    <h1 class="idt-dashboard__title-2"><?php _e('Logos', 'insomniodev'); ?></h1>
    <form class="idt-dashboard__form idt-dashboard__form--style-2" novalidate>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-logo-1"
                   class="idt-dashboard__label"><?php echo __('Logo', 'insomniodev') . ' 1'; ?></label>
            <div class="idt-image-manager">
                <div class="idt-image-manager__preview">
                    <img class="idt-image-manager__preview-image"
                         src="<?php echo esc_url($placeholder); ?>"
                         alt="<?php echo __('Image', 'insomniodev') . ' 1'; ?>">
                </div>
                <button type="button"
                        class="idt-dashboard__button-1 idt-image-manager__button">
                    <?php _e( 'Select image', 'insomniodev' ); ?>
                </button>
                <input type="hidden"
                       class="idt-image-manager__input"
                       name="logo1"
                       id="idt-logo-id-1"
                       value="0">
            </div>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-logo-2"
                   class="idt-dashboard__label"><?php echo __('Logo', 'insomniodev') . ' 2'; ?></label>
            <div class="idt-image-manager">
                <div class="idt-image-manager__preview">
                    <img class="idt-image-manager__preview-image"
                         src="<?php echo esc_url($placeholder); ?>"
                         alt="<?php echo __('Image', 'insomniodev') . ' 2'; ?>">
                </div>
                <button type="button"
                        class="idt-dashboard__button-1 idt-image-manager__button">
                    <?php _e( 'Select image', 'insomniodev' ); ?>
                </button>
                <input type="hidden"
                       class="idt-image-manager__input"
                       name="logo2"
                       id="idt-logo-id-2"
                       value="0">
            </div>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-logo-3"
                   class="idt-dashboard__label"><?php echo __('Logo', 'insomniodev') . ' 3'; ?></label>
            <div class="idt-image-manager">
                <div class="idt-image-manager__preview">
                    <img class="idt-image-manager__preview-image"
                         src="<?php echo esc_url($placeholder); ?>"
                         alt="<?php echo __('Image', 'insomniodev') . ' 3'; ?>">
                </div>
                <button type="button"
                        class="idt-dashboard__button-1 idt-image-manager__button">
                    <?php _e( 'Select image', 'insomniodev' ); ?>
                </button>
                <input type="hidden"
                       class="idt-image-manager__input"
                       name="logo3"
                       id="idt-logo-id-3"
                       value="0">
            </div>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-logo-4"
                   class="idt-dashboard__label"><?php echo __('Logo', 'insomniodev') . ' 4'; ?></label>
            <div class="idt-image-manager">
                <div class="idt-image-manager__preview">
                    <img class="idt-image-manager__preview-image"
                         src="<?php echo esc_url($placeholder); ?>"
                         alt="<?php echo __('Image', 'insomniodev') . ' 4'; ?>">
                </div>
                <button type="button"
                        class="idt-dashboard__button-1 idt-image-manager__button">
                    <?php _e( 'Select image', 'insomniodev' ); ?>
                </button>
                <input type="hidden"
                       class="idt-image-manager__input"
                       name="logo4"
                       id="idt-logo-id-4"
                       value="0">
            </div>
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
