<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Theme default header
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

?>
        <footer id="idt-footer">
            <div id="idt-footer-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <?php if (is_active_sidebar('idt-sidebar-footer-1')): ?>
                                <?php dynamic_sidebar('idt-sidebar-footer-1'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <?php if (is_active_sidebar('idt-sidebar-footer-2')): ?>
                                <?php dynamic_sidebar('idt-sidebar-footer-2'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <?php if (is_active_sidebar('idt-sidebar-footer-3')): ?>
                                <?php dynamic_sidebar('idt-sidebar-footer-3'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="idt-address">
                                <?php if (is_active_sidebar('idt-sidebar-footer-4')): ?>
                                    <?php dynamic_sidebar('idt-sidebar-footer-4'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		<?php wp_footer(); ?>
	</body>
</html>
