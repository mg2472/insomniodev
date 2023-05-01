<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
/**
 * Template por defecto que muestra las entradas del sitio web
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */
?>
<div class="idt-page" id="idt-tpl-blog">
	<div id="idt-before">
		<div id="idt-before">
			<div id="idt-before-1">
				<section class="idt-section idt-blog-banner">
					<div class="idt-section-wrap">
						<?php get_template_part( 'sections/blog/banner' );?>
					</div>
				</section>
			</div>
		</div>
	</div>
	<div id="idt-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<main role="main" class="idt-section idt-main idt-blog-posts">
						<?php while( have_posts() ): the_post();?>
							<?php get_template_part( 'sections/posts/post/post-style-2' );?>
						<?php endwhile; wp_reset_query();?>
                        <?php get_template_part( 'sections/blog/pagination' );?>
					</main>
				</div>
				<div class="col-lg-4">
					<?php if ( is_active_sidebar( 'idt-sidebar-1' ) ) :?>
						<aside class="idt-blog-aside">
							<?php dynamic_sidebar( 'idt-sidebar-1' );?>
						</aside>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>