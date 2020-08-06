<?php get_header();?>
<div class="single-post">
    <?php
    while( have_posts() ):

        global $post; 

        $slider_images = single_slider_images($post->ID);
    ?>
    <h1><?php the_title();?></h1>
    <div class="single-slider-container">
        <?php
            if(is_array($slider_images)):

                ?>
                <div class="single-slider">
                    <?php
                    foreach($slider_images as $image) {
                        ?>
                        <div class="slide-div">
                            <img src="<?php echo $image;?>" />
                        </div><!-- end slide-div -->
                        <?php
                    }
                    ?>
                </div><!-- end single-slider --> 
                <?php

            endif;
        ?>
    </div><!-- end single slider container -->
    
    <?php
    the_post();

    ?>
    <div class="content-div">
        <div class="left-content">
    <?php

    the_content();

    ?>
        </div><!-- end left-content -->
        <div class="right-content">

        </div><!-- end right-content -->
    </div><!-- end content-div -->
    <?php

    endwhile;
    wp_reset_postdata();
    ?>
   
</div>
<?php get_footer();?>