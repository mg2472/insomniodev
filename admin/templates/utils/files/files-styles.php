<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Admin theme styles files
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

$configs = [
    'files' => null
];

if (isset($args) && !empty($args)) {
    $configs = array_merge($configs, $args);
}

$resources = new IdtResources();
?>
<?php if (isset($configs['files']) && !empty($configs['files'])): ?>
    <div class="idt-dashboard__input-group idt-dashboard__input-group--full-width idt-dashboard__bootstrap-import-styles-option">
        <ul class="idt-dashboard__checkbox-list">
            <?php $count = 0; ?>
            <?php foreach ($configs['files'] as $file): ?>
                <li>
                    <div class="idt-dashboard__input-group idt-dashboard__input-group--full-width">
                        <label for="idt-dashboard__input-file-name-<?php echo $count; ?>"
                               class="idt-dashboard__label"><?php echo $file; ?></label>
                        <label class="idt-dashboard__input-switch">
                            <input type="checkbox"
                                   id="idt-dashboard__input-file-name-<?php echo $count; ?>"
                                   name="files"
                                   data-value="true"
                                   value="<?php echo $file; ?>">
                            <span class="idt-dashboard__input-switch-slider idt-dashboard__input-switch-round"></span>
                        </label>
                    </div>
                </li>
                <?php $count++; ?>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif; ?>