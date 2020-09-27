        </div><!-- end content -->
        <?php if(is_page()):?>
        <?php
            $image_contactbg = get_field('kapcsolatdoboz_hatterkep');
            if(!$image_contactbg) {
                $image_contactbg = get_template_directory_uri()."/images/contact-bg-belsoepiteszet.jpg";
            }
        ?>
        <?php
        $lang = get_bloginfo('language');
        if($lang == 'hu') {
            $contact_id = 'kapcsolat';
            $contact_h1 = 'Kapcsolat';
        } else {
            $contact_id = 'contact';
            $contact_h1 = 'Contact';
        }
        ?>
        <section id="<?php echo $contact_id;?>" class="kapcsolat-section" style="background:url('<?php echo $image_contactbg; ?>') center top no-repeat;background-size:cover;">
        <center>
        
        <h1><?php echo $contact_h1;?></h1>
        <p>www.arterior.hu&nbsp;&nbsp;|&nbsp;&nbsp;Budapest, Reitter Ferenc u. 132.&nbsp;&nbsp;|&nbsp;&nbsp;<a style="color:black;text-decoration:none;" href="mailto:arterior@arterior.hu">arterior@arterior.hu</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a style="color:black;text-decoration:none;" href="tel:+36704527572">tel. +36 70 452 75 72</a></p>
        </center>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2693.4033890928304!2d19.0886974158699!3d47.540477200536166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dbbbab73f62f%3A0xa36657ce44afa195!2sBudapest%2C%20Reitter%20Ferenc%20u.%20132%2C%201131!5e0!3m2!1shu!2shu!4v1601190192153!5m2!1shu!2shu" width="1920" height="600" frameborder="0" style="border:0;margin0;padding:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </section>
        <?php
            $image = get_field('lablec_hatterkep');
            //echo "Itt"; var_dump($image);
            if(!$image) {
                $image = get_template_directory_uri()."/images/footer-bg-belsoepiteszet.jpg";
            }
        ?>
        <?php else: ?>
            <?php $image = get_template_directory_uri()."/images/footer-bg-belsoepiteszet.jpg"; ?>
        <?php endif;?>
        <footer style="background:url('<?php echo $image; ?>')center top no-repeat;background-size:cover;">
            <div class="top-container">
                <div class="top-container-left">
                    <?php
                        wp_nav_menu( array( 
                            'theme_location' => 'footer_menu', 
                            'container_class' => 'footer-menu-container' ) ); 
                    ?>
                </div>
                <div class="top-container-right">
                    <div class="social">
                        <a href="https://www.instagram.com/arteriorkomplexkft/?hl=hu" target="_blank" class="insta">&nbsp;</a>
                        <a href="https://www.facebook.com/Arterior-Komplex-Kft-105355624465129" target="_blank" class="face">&nbsp;</a>
                        <!--<a href="" class="youtube">&nbsp;</a>-->
                    </div>
                </div>
            </div>
            <div class="info-container">
                <!--<div class="cell placeholder-left">
                    <p>&nbsp;</p>
                </div>-->
                <div class="cell footer-logo">
                    <a href=""><img src="<?php echo get_template_directory_uri();?>/images/arterior-logo-footer-2.png" /></a>
                </div>
                <div class="cell copy">
                    <p>Arterior &copy; 2020 | Minden jog fenntartva | Jogi nyilatkozat | Adatvédelem
                </div>
            </div>
        </footer>
        <?php /*if(is_front_page()):*/?>
        <a class="scroll-to-top"></a>
        <?php /*endif;*/?>
    </div><!-- end main-container -->
    <div class="mobile-menu-container">
        <span class="close"></span>
        <?php
        wp_nav_menu( array( 
            'theme_location' => 'mobile_menu', 
            'container_class' => 'mobile-menu-class' ) 
        ); 
        ?>
    </div>
<?php wp_footer();?>

</body>
</html>