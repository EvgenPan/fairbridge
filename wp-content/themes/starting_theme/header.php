<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(''); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <?php
    global $wp_query;
    wp_head();
    ?>
</head>
<body <?php if (is_front_page()) { print ' class="front_page" '; }
elseif (is_single()){
    print ' class="single_page" ';
}
elseif (is_page_template( 'template-investor-portal.php' )){
    print ' class="investor_portal" ';
}
else { print ' class="inner_page" '; }?>>
	<div id="root">
		<div class="app">
			<div class="app_main">
                <header class="header_1">
                    <div class="header_fluid">
                        <div class="container">
                            <div class="row head_menu valign-wrapper">
                               <button id="hamb_button" class="hamburger hamburger--collapse" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
                                <div class="col-auto header_logo">
                                    <?php if ( !is_front_page()) { print '<a href="'.get_home_url().'">'; dynamic_sidebar('header_logo'); print '</a>'; }
                                    else {
                                        dynamic_sidebar('header_logo');
                                    }
                                    ?>
                                </div>
                                <div class="col head_menu_col">
                                    <?php
                                    if (has_nav_menu('header_menu')) {
                                        wp_nav_menu(array(
                                            'theme_location' 	=> 'header_menu',
                                            'menu_class' 	 	=> 'menu-menu-container',
                                            'container'		 	=> '',
                                            'container_class' 	=> '',
                                            'walker' 			=> new Main_Submenu_Class()
                                        ));
                                    }
                                    ?>
                                </div>
                                <div class="col-auto call">
                                    <?php dynamic_sidebar('header_call'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                   <div class="mobile_menu ">
                        <?php
                           if (has_nav_menu('header_menu')) {
                            wp_nav_menu(array(
                                'theme_location' 	=> 'mobile_menu',
                                'menu_class' 	 	=> 'menu_mobile',
                                'menu_id'         => 'mob',
                                'container'		 	=> '',
                                'container_class' 	=> '',
                                'walker' 			=> new Main_Submenu_Class()
                            ));
                        }
                        ?>
                        <?php dynamic_sidebar('header_call'); ?>
                    </div>
                    <div class="bg "></div>
                </header>