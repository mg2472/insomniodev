<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Front page template V1
 * @package WordPress
 * @subpackage InsomnioDev
 * @since 1.0
 * @version 1.0
 */

get_header('demo');
?>
<div class="idt-front-page-v1 idt-separator" id="idt-tpl-front-page-v1">
	<div id="idt-main">
		<div class="container">
			<main class="idt-section">
				<?php get_template_part('template-parts/banners/banner', 'demo-v1'); ?>
            </main>
		</div>
	</div>
</div>
<?php get_footer('demo'); ?>