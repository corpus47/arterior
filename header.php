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



//need_slider(get_the_ID());

//if(get_post_type() == "page") {
if(need_slider(get_the_ID())) {

    $dark_menu = "";
    $single_header = "";

} else {

    $dark_menu = " dark";
    $single_header = " single-header";

}

?>

<body>
<?php

if(function_exists('arterior_user_popup')) {
    arterior_user_popup();
}

?>
    <div class="main-container">
        
        <header>
            <div class="header-container<?php echo $single_header;?>">
                <div class="logo">
                    <a href="<?php echo home_url();?>">
                        <?php //if(get_post_type() == "page"):?>
                        <?php var_dump(get_field('logo_pic'));?>
                        <?php if(need_slider(get_the_ID()) == "page"):?>
                            
                            <img src="<?php echo get_template_directory_uri();?>/images/arterior-logo-footer-new.png" />
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
                <div class="right-container">
                    <div class="search_bar<?php echo $dark_menu;?>">
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/');?>">
                        <input id="s" name="s" class="search-input" type="text" />
                        <a href="javascript:void(0);" class="go-search"></a>
                    </form>
                    
                    </div>
                    <?php
                    if(is_user_logged_in()) {
                        $logged = 1;
                        if($dark_menu == "") {
                            $style_logged = " logged_white";
                        } else {
                            $style_logged = " logged_dark";
                        }
                        
                    } else {
                        $logged = 0;
                        $style_logged = "";
                    }
                    ?>
                    
                    <a class="user-menu<?php echo $dark_menu;echo $style_logged;?>" href="javascript:void(0);" data-user-logged="<?php echo $logged;?>" ></a>
                    <div class="langswitch-menu<?php echo $dark_menu;?>">
                        <ul>
                            <?php pll_the_languages([
                                'dropdown' => 0,
                                'show_names' => 0,
                                'show_flags' => 1,
                                'hide_current' => 1,
                            ]);?>
                        </ul>
                    </div>
                    <a class="mobile-search<?php echo $dark_menu;?>" href="javascript:void(0);"></a>
                    <a class="hambi-menu<?php echo $dark_menu;?>" href="javascript:void(0);"></a>
                </div>
            </div>
            <div class="mobile-search-container">
                <div class="search_bar<?php echo $dark_menu;?>">
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/');?>">
                        <input id="s" name="s" class="search-input" type="text" />
                        <a href="javascript:void(0);" class="go-search"></a>
                    </form>
            </div>
            </div>
            <?php 
            
            global $post;

            //var_export($post->post_name);

            /*if(is_front_page() || $post->post_name == "bimgo"):*/

            //var_dump(get_post_type());

            //if(get_post_type() == "page"):
            if(need_slider(get_the_ID())):
            
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

    