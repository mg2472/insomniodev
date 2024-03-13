<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Pagination template part
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */

$configs = [
    'total_pages' => null
];
$totalPages = 0;

if (!empty($args)) {
    $configs = array_merge($configs, $args);
}

if (isset($configs['total_pages'])) {
    $totalPages = $configs['total_pages'];
} else {
    global $wp_query;
    $totalPages = $wp_query->max_num_pages;
}

$currentPage = 0;

if (get_query_var('page')) {
    $currentPage = get_query_var('page');
} else {
    $currentPage = get_query_var('paged');
}

if (!$currentPage) {
    $currentPage = 1;
}
?>
<?php if ($totalPages > 1): ?>
    <div class="idt-pagination">
        <?php
        echo paginate_links( [
            'current' => $currentPage,
            'prev_next' => true,
            'prev_text' => __('<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"/></svg>'),
            'next_text' => __('<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>'),
            'total' => $totalPages,
            'mid_size' => 1,
            'end_size' => 3,
            'type' => 'list'
        ] );
        ?>
    </div>
<?php endif; ?>