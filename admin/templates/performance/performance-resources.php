<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Resources form template
 * @since 1.0
 * @version 1.0
 */

$options = [
    'enableBootstrap' => null,
    'bootstrapVersion' => null,
    'bootstrapImportStyles' => null,
    'bootstrapCssFiles' => null,
    'bootstrapScssFiles' => null
];

if (isset($args) && !empty($args)) {
    $options = array_merge($options, $args);
}

$idtResources = new IdtResources();
?>
<form class="idt-dashboard__form idt-dashboard__form--style-2" novalidate>
    <h3 class="idt-dashboard__title-3"><?php _e('Bootstrap', 'insomniodev'); ?></h3>
    <div class="idt-dashboard__input-group idt-dashboard__input-group--full-width">
        <label for="idt-dashboard__input-resource-enable-bootstrap"
               class="idt-dashboard__label"><?php _e('Enable bootstrap', 'insomniodev'); ?></label>
        <label class="idt-dashboard__input-switch">
            <input type="checkbox"
                   id="idt-dashboard__input-resource-enable-bootstrap"
                   name="enableBootstrap"
                <?php echo (isset($options['enableBootstrap'])
                    && $options['enableBootstrap'] == 'enabled') ? 'checked' : ''; ?>>
            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
        </label>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-resource-bootstrap-version"
               class="idt-dashboard__label"><?php _e('Select bootstrap version', 'insomniodev'); ?></label>
        <select class="idt-dashboard__select"
                id="idt-dashboard__input-resource-bootstrap-version"
                name="bootstrapVersion">
            <option value=""><?php _e('Select a version', 'insomniodev'); ?></option>
            <option value="5.1.3"
                <?php echo (isset($options['bootstrapVersion'])
                    && $options['bootstrapVersion'] == '5.1.3') ? 'selected' : ''; ?>>
                <?php echo __('Bootstrap', 'insomniodev') . ' 5.1.3'; ?>
            </option>
        </select>
    </div>
    <div class="idt-dashboard__input-group">
        <label for="idt-dashboard__input-resource-bootstrap-import-styles"
               class="idt-dashboard__label"><?php _e('Import styles', 'insomniodev'); ?></label>
        <select class="idt-dashboard__select"
                id="idt-dashboard__input-resource-bootstrap-import-styles"
                name="bootstrapImportStyles">
            <option value="cssBundle"
                <?php echo (isset($options['bootstrapImportStyles'])
                    && $options['bootstrapImportStyles'] == 'cssBundle')
                    ? 'selected' : '';?>><?php _e('CSS bundle', 'insomniodev'); ?></option>
            <option value="cssSelectedFiles"
                <?php echo (isset($options['bootstrapImportStyles'])
                    && $options['bootstrapImportStyles'] == 'cssSelectedFiles')
                    ? 'selected' : '';?>><?php _e('CSS selected files', 'insomniodev'); ?></option>
            <option value="scssSelectedFiles"
                <?php echo (isset($options['bootstrapImportStyles'])
                    && $options['bootstrapImportStyles'] == 'scssSelectedFiles')
                    ? 'selected' : '';?>><?php _e('SCSS selected files', 'insomniodev'); ?></option>
        </select>
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