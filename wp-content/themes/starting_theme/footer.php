</div>
<footer <?php if(!is_404()){ ?>  class="mt110" <?php } ?>>
    <div class="container-fluid footer_fluid footer_top_fluid pt68">
        <div class="container">
            <div class="row">
                <div class="col-menu-f  col-lg-4 col-md-6 col-sm-12 footer_logo">
					<?php dynamic_sidebar( 'footer_logo' ); ?>
                    <div class="footer_w-text"><?php dynamic_sidebar( 'footer_text' ); ?></div>
                    <div class="mailchimp"><?php echo do_shortcode( ' [mc4wp_form id="119"] ' ); ?></div>
                </div>
                <div class="col-menu-f col-lg-3 col-md-6 col-sm-12 footer_center pb6">
                    <?php
                    if (has_nav_menu('footer_menu-center')) {
                        wp_nav_menu(array(
                            'theme_location' 	=> 'footer_menu-center',
                            'menu_class' 	 	=> 'footer_menu',
                            'container'		 	=> '',
                            'container_class' 	=> '',
                            'walker' 			=> new Main_Submenu_Class()
                        ));
                    }
                    ?>
                </div>
                <div class="col-menu-f col-lg-5 col-md-6 col-sm-12 footer_right">
                    <div class="insta_info">
                        <span class="insta_t"><?= _e('Follow us on instagram:', 'themename'); ?></span>
                        <a href="https://www.instagram.com/fairbridgeamllc/" target="_blank">@fairbridgeamllc</a></div>
                        <?php echo do_shortcode( '[instagram-feed feed=1]'); ?>
                </div>
            </div>
        </div>
    </div>
        <div class="container-fluid footer_fluid footer_bottom_fluid pb68">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 footer_bottom">
                    <?php
                    if (has_nav_menu('footer_menu-onehalf')) {
                        wp_nav_menu(array(
                            'theme_location' 	=> 'footer_menu-onehalf',
                            'menu_class' 	 	=> 'footer_menu footer-half',
                            'container'		 	=> '',
                            'container_class' 	=> '',
                            'walker' 			=> new Main_Submenu_Class()
                        ));
                    }
                    ?>
                    <div class="copyright_f"><?php dynamic_sidebar( 'footer_copyright' ); ?><span><?php echo date('Y');?></span></div>
                 <?php dynamic_sidebar( 'footer_design' ); ?>
                </div>
                <div class="col-lg-5 footer_bottom footer_right">
                    <?php
                    if (has_nav_menu('footer_social')) {
                        wp_nav_menu(array(
                            'theme_location' 	=> 'footer_social',
                            'menu_class' 	 	=> 'footer_menu',
                            'container'		 	=> '',
                            'container_class' 	=> '',
                            'walker' 			=> new Main_Submenu_Class()
                        ));
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>