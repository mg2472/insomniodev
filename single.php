<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
/**
 * Template por defecto que muestra las entradas del sitio web
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */
get_header();
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
                    <main role="main" class="idt-section idt-main idt-single-post">
						<?php while( have_posts() ): the_post();?>
							<?php
                            $post = get_post();
                            $categories = wp_get_post_categories( $post->ID );
                            ?>
                            <?php the_content();?>
                            <div class="idt-post-footer">
                                <span class="idt-post-author"><?php echo __( 'Upload by', 'insomniodev' ) . ': ';?><?php the_author();?></span>
	                            <?php if ( $categories ) :?>
                                    <ul class="idt-post-categories">
                                        <li><?php _e( 'Categories', 'insomniodev' );?>:</li>
			                            <?php foreach ( $categories as $category ) :?>
				                            <?php $category = get_category( $category );?>
                                            <li itemprop="category"><a href="<?php echo get_category_link( $category );?>"><?php echo $category->name;?></a></li>
			                            <?php endforeach; ?>
                                    </ul>
	                            <?php endif;?>
                            </div>
						<?php endwhile; wp_reset_query();?>
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
<?php get_footer(); ?>
