<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Widget that shown a list of the most popular posts of the website
 *
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 *
 */

class IdtWidgetMostPopularPosts extends WP_Widget
{
    public $args = [];

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
	    parent::__construct(
		    'idt-most-popular-posts',  // Base ID
		    __('IDT - The most visited posts of you site', 'insomniodev')   // Name
	    );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        extract($args);
        $postsArgs = [
            'post_type' => 'post',
            'meta_key' => 'post_views',
            'orderby' => 'meta_post_views',
            'order' => 'DESC',
            'posts_per_page'  => 3,
            'post_status' => 'publish',
        ];

        if (isset($instance['order']) && $instance['order'] != '') {
            $postsArgs['order'] = $instance['order'];
        }
        if (isset($instance['post_type']) && $instance['post_type'] != '') {
            $postsArgs['post_type'] = $instance['post_type'];
        }
        if (isset($instance['posts_to_show']) && $instance['posts_to_show'] > 0) {
            $postsArgs['posts_to_show'] = $instance['posts_to_show'];
        }

        $loop = new WP_Query($postsArgs);

        $cssClass = (isset($instance['css_class'])
            && $instance['css_class'] != '') ? $instance['css_class'] : '';
        $cssID = (isset($instance['css_id'])
            && $instance['css_id'] != '') ? $instance['css_id'] : '';
        ?>
        <section class="idt-widget idt-widget-mpp <?php echo $cssClass; ?>" id="<?php echo $cssID; ?>">
            <?php if (isset($instance['title']) && $instance['title'] != ''): ?>
                <?php get_template_part('template-parts/utils/tags/title', 'v1', [
                    'title' => $instance['title'],
                    'tag' => isset($instance['title_tag']) && $instance['title_tag'] != '' ? $instance['title_tag'] : 'h3',
                    'cssClass' => 'idt-widget__title'
                ]); ?>
            <?php endif; ?>

            <ul>
                <?php
                    while ($loop->have_posts()): $loop->the_post();
                        $post = get_post();
                        $categories = get_the_category();
                        $postImage = idtGetPostThumbnail($post->ID);
                        $image = [];

                        if (!empty($postImage)) {
                            $image = [
                                'url' => $postImage['url'],
                                'alt' => $postImage['alt'],
                                'sizes' => [
                                    'width' => $postImage['width'],
                                    'height' => $postImage['height']
                                ],
                                'skipImageLazy' => false,
                            ];
                        }
                ?>
                <li class="idt-widget-mpp__container">
                    <article itemscope
                             itemtype="http://schema.org/Article"
                             class="idt-widget-mpp__item">

                        <?php if (isset($instance['posts_show_image']) && $instance['posts_show_image'] && !empty($image)): ?>
                            <div class="idt-widget-mpp__image-container">
                                <?php get_template_part('template-parts/utils/images/image', 'v1', $image); ?>
                            </div>
                        <?php endif; ?>

                        <ul class="idt-widget-mpp__categories">
                            <?php foreach ($categories as $category): ?>
                                <li itemprop="about">
                                    <a href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo get_post_permalink($post->ID); ?>">
                            <?php get_template_part('template-parts/utils/tags/title', 'v1', [
                                'title' => $post->post_title,
                                'tag' => isset($instance['posts_title_tag']) && $instance['posts_title_tag'] != '' ? $instance['posts_title_tag'] : 'h4',
                                'cssClass' => 'idt-widget-mpp__item-title'
                            ]); ?>
                            <meta itemprop="headline" content="<?php echo $post->post_title; ?>">
                        </a>
                        <footer class="idt-widget-mpp__footer">
                            <time class="idt-widget-mpp__date"
                                  datetime="<?php echo get_the_date('y-m-d h:i'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </footer>
                    </article>
                </li>
                <?php
                    endwhile;
                    wp_reset_query();
                ?>
            </ul>
        </section>
        <?php
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $args = [
            'title' => (isset($instance['title'])) ? $instance['title'] : __('New title', 'insomniodev'),
            'title_tag' => (isset($instance['title_tag'])) ? $instance['title_tag'] : 'h2',
            'css_class' => (isset($instance['css_class'])) ? $instance['css_class'] : '',
            'css_id' => (isset($instance['css_id'])) ? $instance['css_id'] : '',
            'post_type' => (isset($instance['post_type'])) ? $instance['post_type'] : 'post',
            'posts_title_tag' => (isset($instance['posts_title_tag'])) ? $instance['posts_title_tag'] : 'h3',
            'posts_show_image' => (isset($instance['posts_show_image'])) ? $instance['posts_show_image'] : 'no',
            'posts_to_show' => (isset($instance['posts_to_show'])) ? $instance['posts_to_show'] : 3,
            'order' => (isset($instance['order'])) ? $instance['order'] : 'ASC',
        ];
        $postTypes = get_post_types();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title_tag'); ?>">
                <?php echo __('Title tag', 'insomniodev') . ':'; ?>
            </label>
            <select class="widefat tags-input"
                    id="<?php echo $this->get_field_id('title_tag'); ?>"
                    name="<?php echo $this->get_field_name('title_tag'); ?>">
                <option value=""><?php _e('Select a option', 'insomniodev'); ?></option>
                <option value="h1"
                    <?php echo (strtolower($args['title_tag']) == 'h1') ? 'selected' : ''; ?>>
                    <?php _e('H1', 'insomniodev'); ?>
                </option>
                <option value="h2"
                    <?php echo (strtolower($args['title_tag']) == 'h2') ? 'selected' : ''; ?>>
                    <?php _e('H2', 'insomniodev'); ?>
                </option>
                <option value="h3"
                    <?php echo (strtolower($args['title_tag']) == 'h3') ? 'selected' : ''; ?>>
                    <?php _e('H3', 'insomniodev'); ?>
                </option>
                <option value="h4"
                    <?php echo (strtolower($args['title_tag']) == 'h4') ? 'selected' : ''; ?>>
                    <?php _e('H4', 'insomniodev'); ?>
                </option>
                <option value="h5"
                    <?php echo (strtolower($args['title_tag']) == 'h5') ? 'selected' : ''; ?>>
                    <?php _e('H5', 'insomniodev'); ?>
                </option>
                <option value="h6"
                    <?php echo (strtolower($args['title_tag']) == 'h1') ? 'selected' : ''; ?>>
                    <?php _e('H6', 'insomniodev'); ?>
                </option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo __('Title', 'insomniodev') . ':'; ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text"
                   value="<?php echo esc_attr($args['title']); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_type'); ?>">
                <?php echo __('Post Type', 'insomniodev') . ':'; ?>
            </label>
            <select class="widefat tags-input"
                    id="<?php echo $this->get_field_id('post_type'); ?>"
                    name="<?php echo $this->get_field_name('post_type'); ?>">
                <option value=""><?php _e('Select a post_type', 'insomniodev'); ?></option>
                <?php foreach ($postTypes as $postType): ?>
                    <option value="<?php echo $postType;?>"
                        <?php echo ($postType == $args['post_type']) ? 'selected' : ''; ?>
                    >
                        <?php echo $postType; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_title_tag'); ?>">
                <?php echo __('Posts title tag', 'insomniodev') . ':'; ?>
            </label>
            <select class="widefat tags-input"
                    id="<?php echo $this->get_field_id('posts_title_tag'); ?>"
                    name="<?php echo $this->get_field_name('posts_title_tag'); ?>">
                <option value=""><?php _e('Select a option', 'insomniodev'); ?></option>
                <option value="h1"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h1') ? 'selected' : ''; ?>>
                    <?php _e('H1', 'insomniodev'); ?>
                </option>
                <option value="h2"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h2') ? 'selected' : ''; ?>>
                    <?php _e('H2', 'insomniodev'); ?>
                </option>
                <option value="h3"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h3') ? 'selected' : ''; ?>>
                    <?php _e('H3', 'insomniodev'); ?>
                </option>
                <option value="h4"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h4') ? 'selected' : ''; ?>>
                    <?php _e('H4', 'insomniodev'); ?>
                </option>
                <option value="h5"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h5') ? 'selected' : ''; ?>>
                    <?php _e('H5', 'insomniodev'); ?>
                </option>
                <option value="h6"
                    <?php echo (strtolower($args['posts_title_tag']) == 'h1') ? 'selected' : ''; ?>>
                    <?php _e('H6', 'insomniodev'); ?>
                </option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_show_image'); ?>">
                <?php echo __('Show posts image', 'insomniodev') . ':'; ?>
            </label>
            <select class="widefat tags-input"
                    id="<?php echo $this->get_field_id('posts_show_image'); ?>"
                    name="<?php echo $this->get_field_name('posts_show_image'); ?>">
                <option value=""><?php _e('Select a option', 'insomniodev'); ?></option>
                <option value="no"
                    <?php echo (strtolower($args['posts_show_image']) == 'no') ? 'selected' : ''; ?>>
                    <?php _e('No', 'insomniodev'); ?>
                </option>
                <option value="yes"
                    <?php echo (strtolower($args['posts_show_image']) == 'yes') ? 'selected' : ''; ?>>
                    <?php _e('Yes', 'insomniodev'); ?>
                </option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_to_show'); ?>">
                <?php echo __('Posts to show', 'insomniodev') . ':'; ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('posts_to_show'); ?>"
                   name="<?php echo $this->get_field_name('posts_to_show'); ?>"
                   type="number"
                   value="<?php echo esc_attr($args['posts_to_show']); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>">
                <?php echo __('Order', 'insomniodev') . ':'; ?>
            </label>
            <select class="widefat tags-input"
                    id="<?php echo $this->get_field_id('order'); ?>"
                    name="<?php echo $this->get_field_name('order'); ?>">
                <option value=""><?php _e('Select a order', 'insomniodev'); ?></option>
                <option value="ASC"
                    <?php echo (strtolower($args['order']) == 'asc') ? 'selected' : ''; ?>>
                    <?php _e('Asc', 'insomniodev'); ?>
                </option>
                <option value="DESC"
                    <?php echo (strtolower($args['order']) == 'desc') ? 'selected' : ''; ?>>
                    <?php _e('Desc', 'insomniodev'); ?>
                </option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('css_class'); ?>">
                <?php echo __('CSS Class', 'insomniodev') . ':'; ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('css_class'); ?>"
                   name="<?php echo $this->get_field_name('css_class'); ?>"
                   type="text"
                   value="<?php echo esc_attr($args['css_class']); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('css_id'); ?>">
                <?php echo __('CSS ID', 'insomniodev') . ':'; ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('css_id'); ?>"
                   name="<?php echo $this->get_field_name('css_id'); ?>"
                   type="text"
                   value="<?php echo esc_attr($args['css_id']); ?>"/>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title_tag'] = strip_tags($new_instance['title_tag']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        $instance['posts_title_tag'] = strip_tags($new_instance['posts_title_tag']);
        $instance['posts_show_image'] = strip_tags($new_instance['posts_show_image']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['posts_to_show'] = strip_tags($new_instance['posts_to_show']);
        $instance['css_class'] = strip_tags($new_instance['css_class']);
        $instance['css_id'] = strip_tags($new_instance['css_id']);

        return $instance;
    }
}
