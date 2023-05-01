<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage insomniodev
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<div class="idt-tpl-search" id="idt-tpl-search">
    <div id="idt-before">
        <div id="idt-before">
            <div id="idt-before-1">
                <section class="idt-section idt-search-banner">
                    <div class="idt-section-wrap">
						<?php get_template_part( 'sections/banners/search' );?>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div id="idt-main">
        <div class="container">
            <main class="idt-section idt-main-content">
                <div class="idt-section-wrap">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="idt-search-results">
                                <div class="title-result">
		                            <?php if ( have_posts() ) :?>
                                        <h1 class="idt-section-title"><?php printf( __( "Results for: '%s'", 'insomniodev' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
		                            <?php else :?>
                                        <h1 class="idt-section-title"><?php _e( 'No result found', 'insomniodev' ); ?></h1>
		                            <?php endif;?>
                                </div>
                                <div class="content-result">
		                            <?php if( have_posts() ):?>
			                            <?php while( have_posts() ): the_post();?>
				                            <?php get_template_part( 'sections/posts/post/post-style-2' );?>
			                            <?php endwhile;?>
		                            <?php endif; ?>
                                </div>
                            </div>
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
            </main>
        </div>
    </div>
</div>
<?php get_footer(); ?>
