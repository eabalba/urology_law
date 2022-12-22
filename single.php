<?php get_header(); 
if ( have_posts() ): while ( have_posts() ) : the_post();
?>
<main id="main">
	<article>
		<?php the_content(); ?>
	</article>
    <aside>
    <?php
        global $post;
        $related_posts = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'post__not_in' => array( $post->ID ), 'posts_per_page' => 3 ) );
        ?>
        <h2>Related Articles</h2>
        <?php
        foreach ( $related_posts as $post ):
            setup_postdata($post);
            ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <figure>
                    <?php if(get_the_post_thumbnail()){
                        the_post_thumbnail(); 
                    } else { ?>
                        <img class="placeholder" src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.png">
                    <?php }?>
                </figure>  
                <h3><?php the_title(); ?></h3>
            </a>
            <?php
            wp_reset_postdata();
        endforeach; ?>

    </aside>    
</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>