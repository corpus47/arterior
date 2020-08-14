        </div><!-- end content -->
        <?php if(is_page()):?>
        <?php
            $image_contactbg = get_field('kapcsolatdoboz_hatterkep');
            if(!$image_contactbg) {
                $image_contactbg = get_template_directory_uri()."/images/contact-bg-belsoepiteszet.jpg";
            }
        ?>
        <!--<section id="kapcsolat" class="kapcsolat-section" style="background:url('<?php //echo $image_contactbg; ?>') center top no-repeat;background-size:cover;">
            
        </section>-->
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
            <?php
                wp_nav_menu( array( 
                    'theme_location' => 'footer_menu', 
                    'container_class' => 'footer-menu-container' ) ); 
            ?>
            <div class="info-container">
                <div class="cell footer-logo">
                    <a href=""><img src="<?php echo get_template_directory_uri();?>/images/arterior-logo-footer.png" /></a>
                </div>
                <div class="cell copy">
                    <p>Arterior &copy; 2020 | Minden jog fenntartva | Jogi nyilatkozat | Adatvédelem
                </div>
                <div class="cell social">
                    <a href="" class="insta">&nbsp;</a>
                    <a href="" class="face">&nbsp;</a>
                    <a href="" class="youtube">&nbsp;</a>
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