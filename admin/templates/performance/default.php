<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

?>
<div class="idt-dashboard__component" id="idt-dashboard__component-performance">
    <h1 class="idt-dashboard__title-2"><?php _e('Performance', 'insomniodev');?></h1>
    <div class="idt-dashboard__tabs">
        <div class="idt-dashboard__tabs-header">
            <ul>
                <li>
                    <button class="idt-dashboard__tab active"
                            data-target="#idt-dashboard__tab-target-general-settings">
                        <?php _e('General settings', 'insomniodev'); ?>
                    </button>
                </li>
<!--                <li>-->
<!--                    <button class="idt-dashboard__tab"-->
<!--                            data-target="#idt-dashboard__tab-target-resources">-->
<!--                        --><?php //_e('Resources', 'insomniodev'); ?>
<!--                    </button>-->
<!--                </li>-->
                <li>
                    <button class="idt-dashboard__tab"
                            data-target="#idt-dashboard__tab-target-templates">
                        <?php _e('Templates', 'insomniodev'); ?>
                    </button>
                </li>
            </ul>
        </div>
        <div class="idt-dashboard__tabs-body">
            <div class="idt-dashboard__tab-target show"
                 id="idt-dashboard__tab-target-general-settings">
                <?php get_template_part('admin/templates/performance/performance','general-settings'); ?>
            </div>
<!--            <div class="idt-dashboard__tab-target"-->
<!--                 id="idt-dashboard__tab-target-resources">-->
<!--                --><?php //get_template_part('admin/templates/performance/performance','resources'); ?>
<!--            </div>-->
            <div class="idt-dashboard__tab-target"
                 id="idt-dashboard__tab-target-templates">
                <?php get_template_part('admin/templates/performance/performance','templates'); ?>
            </div>
        </div>
    </div>
</div>
