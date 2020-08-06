<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title();?></title>

    <?php wp_head(); ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<?php

if(get_post_type() == "page") {

    $dark_menu = "";

} else {

    $dark_menu = " dark";

}

?>

<body>
    <div class="main-container">
        <header>
            <div class="header-container">
                <div class="logo">
                    <a href="<?php echo home_url();?>">
                        <?php if(get_post_type() == "page"):?>
                        <img src="<?php echo get_template_directory_uri();?>/images/arterior-logo-footer.png" />
                        <?php else:?>
                            <img src="<?php echo get_template_directory_uri();?>/images/arterior-logo-footer-black.png" />
                        <?php endif;?>
                    </a>
                </div>
                <nav class="navbar navbar-expand-md navbar-light bg-bone<?php echo $dark_menu;?>" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="#"></a>
                            <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'main_menu',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ) );
                            ?>
                    </div>
                </nav>
                <div class="search_bar">
                    <input name="search_bar" class="search-input" type="text" />
                </div>
                <a class="contact-menu scroll-to-target" href="#kapcsolat" ></a>
                <a class="langswitch-menu" href="#">hu</a>
            </div>
            <?php 
            
            global $post;

            //var_export($post->post_name);

            /*if(is_front_page() || $post->post_name == "bimgo"):*/

            //var_dump(get_post_type());

            if(get_post_type() == "page"):
            
            ?>
            <div class="slider-container"> 
                <!--<div class="slide-div" style="margin:0; padding:0;">
                    <h1><p>Slide 1</p></h1>
                    <img src="<?php echo get_template_directory_uri();?>/images/slide-1-1920.jpg" alt="" />
                        
                </div>
                <div class="slide-div" style="margin:0; padding:0;">
                    <h1><p>Slide 2</p></h1>
                    <img src="<?php echo get_template_directory_uri();?>/images/slide-2-1920.jpg" alt="" />
                        
                </div>
                <div class="slide-div" style="margin:0; padding:0;">
                    <h1><p>Slide 3</p></h1>
                    <img src="<?php echo get_template_directory_uri();?>/images/slide-3-1920.jpg" alt="" />    
                </div>-->

               

                <?php $loop = new WP_Query( array( 'post_type' => 'home_slider', 'posts_per_page' => 10 ) ); ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    
                    <div class="slide-div" style="margin:0; padding:0;">  
                        
                        <h1>
                            <?php 
                            echo the_content();
                            ?>
                        </h1>
                        <img src="<?php echo get_field('slide_picture');?>" />
                    </div>
                <?php endwhile; ?>

            </div>

            <?php endif;?>

        </header>
        <div class="content">

    