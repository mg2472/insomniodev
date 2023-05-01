<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Theme templates performance configs
 * @since 1.0
 * @version 1.0
 */

?>
<div class="idt-dashboard__component" id="idt-dashboard__component-performance-templates">
    <div class="idt-dashboard__table-filters">
        <button type="button" class="idt-dashboard__button-1 idt-dashboard__action-add">
            <?php _e('New config', 'insomniodev'); ?>
        </button>
    </div>
    <table class="idt-dashboard__table">
        <thead class="idt-dashboard__table-head">
            <tr>
                <th><?php _e('ID', 'insomniodev'); ?></th>
                <th><?php _e('TPL Type', 'insomniodev'); ?></th>
                <th><?php _e('TPL Name', 'insomniodev'); ?></th>
                <th><?php _e('Status', 'insomniodev'); ?></th>
                <th><?php _e('Actions', 'insomniodev'); ?></th>
            </tr>
        </thead>
        <tbody class="idt-dashboard__table-body"></tbody>
    </table>
    <div class="idt-dashboard__table-pagination"></div>
    <div class="idt-dashboard__loader hide">
        <svg class="idt-dashboard__loader-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z"/></svg>
    </div>
</div>
