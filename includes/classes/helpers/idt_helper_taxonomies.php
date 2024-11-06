<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Return a post list
 *
 * @param $filters array The wp_query filters
 *
 * @return array Posts list
 */
function idtGetPostList(array $filters = []): array
{
    $items = [
        'posts' => [],
        'pagination' => [
            'totalPages' => 0
        ]
    ];

    $args = [
        'post_type' => 'post',
        'order' => 'DESC',
        'posts_per_page' => 12,
        'tax_query' => [],
        'meta_query' => [],
        'post_status' => 'publish',
        'paged' => 0
    ];

    if (isset($filters['postType']) && $filters['postType'] !== '') {
        $args['post_type'] = trim($filters['postType']);
    }

    if (isset($filters['postPerPage']) && $filters['postPerPage'] >= -1) {
        $args['posts_per_page'] = $filters['postPerPage'];
    }

    if (isset($filters['offset']) && $filters['offset'] > 0) {
        $args['offset'] = $filters['offset'];
    }

    if (isset($filters['search']) && $filters['search'] != '') {
        $args['s'] = trim($filters['search']);
    }

    if (!empty($filters['ids'])) {
        $args['post__in'] = $filters['ids'];
    }

    if (!empty($filters['terms']) && isset($filters['taxonomy']) && $filters['taxonomy'] !== '') {
        $args['tax_query'][] = [
            'taxonomy' => $filters['taxonomy'],
            'terms' => $filters['terms'],
            'include_children' => false // Remove if you need posts from term 7 child terms
        ];

    }

    if (!empty($filters['metaQuery'])) {
        $args['meta_query'] = $filters['metaQuery'];
    }

    if (isset($filters['postStatus']) && $filters['postStatus'] !== '') {
        $args['post_status'] = trim($filters['postStatus']);
    }

    if (isset($filters['paged']) && $filters['paged'] >= 0) {
        $args['paged'] = $filters['paged'];
    }

    if (isset($filters['orderBy']) && $filters['orderBy'] !== '') {
        $args['orderby'] = trim($filters['orderBy']);
        switch ($filters['orderBy']) {
            case 'meta_value_num':
            case 'meta_value':
                if (isset($filters['orderByMetaKey']) && $filters['orderByMetaKey'] !== '') {
                    $args['meta_key'] = $filters['orderByMetaKey'];
                }
                break;
            default:
                break;
        }

        if (isset($filters['orderBy']) && $filters['orderBy'] !== '') {
            $args['orderby'] = trim($filters['orderBy']);
        }
    }

    if (isset($filters['order']) && $filters['order'] !== '') {
        $args['order'] = trim($filters['order']);
    }

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        $items['pagination']['totalPages'] = $loop->max_num_pages;

        while ($loop->have_posts()) {
            $loop->the_post();
            $postID = get_the_ID();
            $item = [
                'id' => $postID,
                'parent' => get_post_parent(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'content' => get_the_content(),
                'permalink' => get_the_permalink(),
                'customFields' => [],
                'author' => get_the_author(),
                'date' => get_the_date(),
                'terms' => [],
                'comments' => null,
                'status' => get_post_status(),
            ];

            if (isset($filters['getPostComments']) && $filters['getPostComments']) {
                $item['comments'] = get_comments([
                    'post_id' => $postID,
                    'count' => true
                ]);
            }

            if (isset($filters['getPostTerms']) && $filters['getPostTerms']) {
                $postTaxonomy = isset($filters['taxonomy']) && $filters['taxonomy'] !== '' ? trim($filters['taxonomy']) : '';
                if ($postTaxonomy) {
                    $item['terms'] = get_the_terms($postID, $postTaxonomy);
                }
            }

            if (!empty($filters['customFields'])) {
                foreach ($filters['customFields'] as $customField) {
                    if (isset($customField['isAcf']) && $customField['isAcf'] && class_exists('ACF')) {
                        $item['customFields'][$customField['key']] = get_field($customField['key'], $postID);
                    } else {
                        $item['customFields'][$customField['key']] = get_post_meta($postID, $customField['key'], true);
                    }
                }
            }

            $items['posts'][] = $item;
        }

        wp_reset_query();
    }

    return $items;
}