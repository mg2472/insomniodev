<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

$resources = new IdtResources();

$styles = [
    'css' => [
        'bootstrap' => $resources->getBootstrapStyleFiles('5.2', 'css'),
        'fontawesome' => $resources->getFontawesomeStyleFiles('6.3', 'css'),
        'additional' => $resources->getAdditionalStyleFiles(),
    ],
    'scss' => [
        'bootstrap' => $resources->getBootstrapStyleFiles('5.2', 'scss'),
        'fontawesome' => $resources->getFontawesomeStyleFiles('6.3', 'scss'),
        'theme' => $resources->getThemeStyleFiles(),
        'childTheme' => $resources->getThemeStyleFiles('child')
    ]
];
$scripts = [
    'bootstrap' => $resources->getBootstrapScriptsFiles('5.2'),
    'fontawesome' => $resources->getFontawesomeScriptsFiles('6.3'),
    'theme' => $resources->getThemeScriptsFiles(),
    'childTheme' => $resources->getThemeScriptsFiles(true),
    'additional' => $resources->getAdditionalScriptsFiles(),
];
?>
<div class="idt-dashboard__component" id="idt-dashboard__component-performance-template">
    <h2 class="idt-dashboard__title-2"><?php _e('Template settings', 'insomniodev'); ?></h2>
<!--    <pre>--><?php //var_dump($scripts);?><!--</pre>-->
    <form class="idt-dashboard__form idt-dashboard__form--style-2" novalidate>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-template-type"
                   class="idt-dashboard__label"><?php _e('Template Type', 'insomniodev'); ?></label>
            <select class="idt-dashboard__input"
                    id="idt-dashboard__input-template-type"
                    name="templateType">
                <option><?php _e('Select a option', 'insomniodev'); ?></option>
                <option value="wordpressTPL"><?php _e('Wordpress TPL', 'insomniodev'); ?></option>
                <option value="customTPL"><?php _e('Custom TPL', 'insomniodev'); ?></option>
                <option value="postType"><?php _e('Post type', 'insomniodev'); ?></option>
                <option value="taxonomy"><?php _e('Taxonomy', 'insomniodev'); ?></option>
            </select>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-template-name"
                   class="idt-dashboard__label"><?php _e('Template Name', 'insomniodev'); ?></label>
            <select class="idt-dashboard__input"
                    id="idt-dashboard__input-template-name"
                    name="templateName">
                <option><?php _e('Select a option', 'insomniodev')?></option>
            </select>
        </div>
        <div class="idt-dashboard__input-group">
            <label for="idt-dashboard__input-status"
                   class="idt-dashboard__label"><?php _e('Status', 'insomniodev'); ?></label>
            <select class="idt-dashboard__input"
                    id="idt-dashboard__input-status"
                    name="templateStatus">
                <option value="enabled"><?php _e('Enabled', 'insomniodev'); ?></option>
                <option value="disabled"><?php _e('Disabled', 'insomniodev'); ?></option>
            </select>
        </div>

        <div class="idt-dashboard__accordion">
            <div class="idt-dashboard__accordion-header">
                <h3 class="idt-dashboard__accordion-header-title"><?php _e('Critical CSS', 'insomniodev'); ?></h3>
                <div class="idt-dashboard__accordion-header-icons">
                    <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                    <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                </div>
            </div>
            <div class="idt-dashboard__accordion-body hide">
                <!--Bootstrap files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Bootstrap', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-group">
                            <label for="idt-dashboard__input-bootstrapCriticalCssFilesType"
                                   class="idt-dashboard__label"><?php _e('Files type', 'insomniodev'); ?></label>
                            <select class="idt-dashboard__input idt-dashboard__input-toggle-files-type"
                                    id="idt-dashboard__input-bootstrapCriticalCssFilesType"
                                    name="bootstrapCriticalCssFilesType">
                                <option><?php _e('Select a option', 'insomniodev'); ?></option>
                                <option value="css"><?php _e('CSS', 'insomniodev'); ?></option>
                                <option value="scss"><?php _e('SCSS', 'insomniodev'); ?></option>
                            </select>
                        </div>
                        <div class="idt-dashboard__input-css-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['bootstrap']]); ?>
                        </div>
                        <div class="idt-dashboard__input-scss-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['bootstrap']]); ?>
                        </div>
                    </div>
                </div>

                <!--Fontawesome files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Fontawesome', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-group">
                            <label for="idt-dashboard__input-fontawesomeCriticalCssFilesType"
                                   class="idt-dashboard__label"><?php _e('Files type', 'insomniodev'); ?></label>
                            <select class="idt-dashboard__input idt-dashboard__input-toggle-files-type"
                                    id="idt-dashboard__input-fontawesomeCriticalCssFilesType"
                                    name="fontawesomeCriticalCssFilesType">
                                <option><?php _e('Select a option', 'insomniodev'); ?></option>
                                <option value="css"><?php _e('CSS', 'insomniodev'); ?></option>
                                <option value="scss"><?php _e('SCSS', 'insomniodev'); ?></option>
                            </select>
                        </div>
                        <div class="idt-dashboard__input-css-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['fontawesome']]); ?>
                        </div>
                        <div class="idt-dashboard__input-scss-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['fontawesome']]); ?>
                        </div>
                    </div>
                </div>

                <!--Theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-scss-files idt-dashboard__input-theme-critical-css-scss-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['theme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Child theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Child theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-scss-files idt-dashboard__input-child-theme-critical-css-scss-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['childTheme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Additional files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Additional files', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-scss-files idt-dashboard__input-additional-critical-css-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['additional']]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        -->

        <div class="idt-dashboard__accordion">
            <div class="idt-dashboard__accordion-header">
                <h3 class="idt-dashboard__accordion-header-title"><?php _e('CSS', 'insomniodev'); ?></h3>
                <div class="idt-dashboard__accordion-header-icons">
                    <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                    <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                </div>
            </div>
            <div class="idt-dashboard__accordion-body hide">
                <!--Bootstrap files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Bootstrap', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-group">
                            <label for="idt-dashboard__input-bootstrapCssFilesType"
                                   class="idt-dashboard__label"><?php _e('Files type', 'insomniodev'); ?></label>
                            <select class="idt-dashboard__input idt-dashboard__input-toggle-files-type"
                                    id="idt-dashboard__input-bootstrapCssFilesType"
                                    name="bootstrapCssFilesType">
                                <option><?php _e('Select a option', 'insomniodev'); ?></option>
                                <option value="css"><?php _e('CSS', 'insomniodev'); ?></option>
                                <option value="scss"><?php _e('SCSS', 'insomniodev'); ?></option>
                            </select>
                        </div>
                        <div class="idt-dashboard__input-css-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['bootstrap']]); ?>
                        </div>
                        <div class="idt-dashboard__input-scss-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['bootstrap']]); ?>
                        </div>
                    </div>
                </div>

                <!--Fontawesome files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Fontawesome', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-group">
                            <label for="idt-dashboard__input-fontawesomeCssFilesType"
                                   class="idt-dashboard__label"><?php _e('Files type', 'insomniodev'); ?></label>
                            <select class="idt-dashboard__input idt-dashboard__input-toggle-files-type"
                                    id="idt-dashboard__input-fontawesomeCssFilesType"
                                    name="fontawesomeCssFilesType">
                                <option><?php _e('Select a option', 'insomniodev'); ?></option>
                                <option value="css"><?php _e('CSS', 'insomniodev'); ?></option>
                                <option value="scss"><?php _e('SCSS', 'insomniodev'); ?></option>
                            </select>
                        </div>
                        <div class="idt-dashboard__input-css-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['fontawesome']]); ?>
                        </div>
                        <div class="idt-dashboard__input-scss-files hide">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['fontawesome']]); ?>
                        </div>
                    </div>
                </div>

                <!--Theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-scss-files idt-dashboard__input-theme-css-scss-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['theme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Child theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Child theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-scss-files idt-dashboard__input-child-theme-css-scss-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['scss']['childTheme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Additional files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Additional files', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-additional-css-files">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $styles['css']['additional']]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        -->

        <div class="idt-dashboard__accordion">
            <div class="idt-dashboard__accordion-header">
                <h3 class="idt-dashboard__accordion-header-title"><?php _e('Header Scripts', 'insomniodev'); ?></h3>
                <div class="idt-dashboard__accordion-header-icons">
                    <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                    <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                </div>
            </div>
            <div class="idt-dashboard__accordion-body hide">
                <!--Bootstrap files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Bootstrap', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-bootstrap-header-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['bootstrap']]); ?>
                        </div>
                    </div>
                </div>

                <!--Fontawesome files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Fontawesome', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-fontawesome-header-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['fontawesome']]); ?>
                        </div>
                    </div>
                </div>

                <!--Theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-theme-header-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['theme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Child theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Child theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-child-theme-header-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['childTheme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Additional files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Additional files', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-additional-header-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['additional']]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        *******************************************************
        -->

        <div class="idt-dashboard__accordion">
            <div class="idt-dashboard__accordion-header">
                <h3 class="idt-dashboard__accordion-header-title"><?php _e('Footer Scripts', 'insomniodev'); ?></h3>
                <div class="idt-dashboard__accordion-header-icons">
                    <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                    <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                </div>
            </div>
            <div class="idt-dashboard__accordion-body hide">
                <!--Bootstrap files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Bootstrap', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-bootstrap-footer-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['bootstrap']]); ?>
                        </div>
                    </div>
                </div>

                <!--Fontawesome files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Fontawesome', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-fontawesome-footer-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['fontawesome']]); ?>
                        </div>
                    </div>
                </div>

                <!--Theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-theme-footer-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['theme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Child theme files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Child theme', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-child-theme-footer-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['childTheme']]); ?>
                        </div>
                    </div>
                </div>

                <!--Additional files-->
                <div class="idt-dashboard__accordion">
                    <div class="idt-dashboard__accordion-header">
                        <h4 class="idt-dashboard__accordion-header-title"><?php _e('Additional files', 'insomniodev'); ?></h4>
                        <div class="idt-dashboard__accordion-header-icons">
                            <svg class="idt-dashboard__icon-show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg>
                            <svg class="idt-dashboard__icon-hide hide" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 256c0 17.7-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                        </div>
                    </div>
                    <div class="idt-dashboard__accordion-body hide">
                        <div class="idt-dashboard__input-additional-footer-scripts">
                            <?php get_template_part('admin/templates/utils/files/files', 'styles', ['files' => $scripts['additional']]); ?>
                        </div>
                    </div>
                </div>
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