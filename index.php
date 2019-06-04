<?php
/*
 *
 *
*/
get_header();
?>
<body>
    <?php get_template_part("parts/common", "header"); ?>
    <div id="rb-main">
        <div class="container">
            <?php if( have_posts() ): ?>
            <div class="posts-feed row">
                <?php while( have_posts() ): the_post();?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="post-box">
                        <div class="post-image-container">
                            <div class="post-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(null, 'full'); ?>')">
                            </div>
                        </div>
                        <div class="post-info">
                            <h4 class="post-title"><?php echo get_the_title(); ?></h4>
                            <?php if(has_excerpt()): ?>
                            <p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
                            <?php endif; ?>
                        </div>
                        <a class="post-link" href="<?php echo get_post_permalink(); ?>"></a>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata();?>
            </div>
            <?php endif; ?>
    	</div>
    </div>
    <?php get_template_part("parts/common", "footer"); ?>
</body>
<?php get_footer(); ?>
