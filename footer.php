        </div><!-- end content -->
        <?php if(is_page()):?>
        <?php
            $image_contactbg = get_field('kapcsolatdoboz_hatterkep');
            if(!$image_contactbg) {
                $image_contactbg = get_template_directory_uri()."/images/contact-bg-belsoepiteszet.jpg";
            }
        ?>
        <section id="kapcsolat" class="kapcsolat-section" style="background:url('<?php echo $image_contactbg; ?>') center top no-repeat;background-size:cover;">
            <h1>Kapcsolat</h1>
            <p>www.arterior.hu | Győr 9011 Dózsa major 01052/16 | arterior@arterior.hu | +339725-714-467</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10743.109195954996!2d17.70224196845394!3d47.688744790292574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476bbf3d0bdfa323%3A0xe076bedcbfb673e2!2zR3nFkXIsIETDs3pzYSBtYWpvciwgOTAxMQ!5e0!3m2!1shu!2shu!4v1594906617108!5m2!1shu!2shu" width="100%" height="550" frameborder="0" style="border:0;padding:0;margin:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <script>
                    
                </script>
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
                    <p>Arterior &copy; 2020 | Minden jog fenntartva
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