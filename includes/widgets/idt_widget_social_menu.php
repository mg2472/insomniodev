<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

class IdtWidgetSocialMenu extends WP_Widget
{

    public $args = [];

    function __construct()
    {
	    parent::__construct(
		    'idt-social-menu', // Base ID
		    __('IDT - Social menu', 'insomniodev') // Name
	    );
    }

    public function widget($args, $instance)
    {
        extract($args);

        $templatePart = (isset($instance['custom_template_part'])
            && $instance['custom_template_part'] != '') ? $instance['custom_template_part'] : 'template-parts/widgets/widget-social-menu/widget-social-menu-v1';
        $cssClass = (isset($instance['css_class'])
            && $instance['css_class'] != '') ? $instance['css_class'] : '';
        $cssID = (isset($instance['css_id'])
            && $instance['css_id'] != '') ? $instance['css_id'] : '';
        ?>
        <section class="idt-widget idt-widget-social-menu <?php echo $cssClass; ?>" id="<?php echo $cssID; ?>">
            <?php if (isset($instance['title']) && $instance['title'] != '' ): ?>
                <h2 class="idt-widget__title"><?php echo $instance['title']; ?></h2>
            <?php endif; ?>
            <?php get_template_part($templatePart); ?>
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
            'css_class' => (isset($instance['css_class'])) ? $instance['css_class'] : '',
            'css_id' => (isset($instance['css_id'])) ? $instance['css_id'] : ''
        ];
        ?>
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
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['css_class'] = strip_tags($new_instance['css_class']);
        $instance['css_id'] = strip_tags($new_instance['css_id']);

        return $instance;
    }
}
