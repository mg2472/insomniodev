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
		    __('The most visited posts of you site', 'insomniodev')   // Name
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
        $loop = new WP_Query([
            'post_type' => 'post',
            'meta_key' => 'post_views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page'  => 3,
            'post_status' => 'publish',
        ]);
        $i = 0;
        ?>
        <section class="idt-widget idt-widget-mpp">
            <?php if ($instance['idt_widget_title'] != ''): ?>
                <h2 class="idt-widget-title"><?php echo $instance['idt_widget_title']; ?></h2>
            <?php endif; ?>
            <ul>
                <?php
                    while ($loop->have_posts()): $loop->the_post();
                        $post = get_post();
                        $categories = get_the_category();
                ?>
                <li class="idt-widget-mpp__container">
                    <article itemscope
                             itemtype="http://schema.org/Article"
                             class="idt-widget-mpp__item">
                        <ul class="idt-widget-mpp__categories">
                            <?php foreach ($categories as $category): ?>
                                <li itemprop="about">
                                    <a href="<?php echo get_category_link($category); ?>"><?php echo $category->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo get_post_permalink($post->ID); ?>">
                            <h3 class="idt-widget-mpp__item-title">
                                <?php echo $post->post_title; ?>
                            </h3>
                            <meta itemprop="headline" content="<?php echo $post->post_title; ?>">
                        </a>
                        <footer class="idt-widget-mpp__footer">
                            <time class="idt-card-2__date"
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
    function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('idt_widget_title'); ?>">
                <?php _e('Title', 'insomniodev'); ?> :
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('idt_widget_title'); ?>"
                   name="<?php echo $this->get_field_name('idt_widget_title'); ?>"
                   type="text"
                   value="<?php echo esc_attr($instance['idt_widget_title']); ?>" />
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
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['idt_widget_title'] = strip_tags($new_instance['idt_widget_title']);
        // Repeat this for each widget setting.
        return $instance;
    }
}
