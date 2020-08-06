<?php get_header();?>
<div class="single-post">
    <?php
    
    global $post;

    var_dump($post);

    ?>
    <?php
    while( have_posts() ):
        the_post();
        the_content();
    endwhile; wp_reset_postdata();
    ?>
</div>
<?php get_footer();?>