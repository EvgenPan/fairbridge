<?php
add_theme_support('post-thumbnails');
add_filter('jpeg_quality', function () {
    return 100;
});
function _remove_script_version($src)
{
    $parts = explode('?', $src);
    if ($parts[0] == 'https://fonts.googleapis.com/css') {
        $parts[0] = $src;
    }
    if ($parts[0] == 'https://maps.googleapis.com/maps/api/js') {
        $parts[0] = $src;
    }
    return $parts[0];
}
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);
/*Add style or scripts files*/
function load_theme_styles()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), null, 'all');
    wp_register_style('slick', get_template_directory_uri() . '/css/slick.css', array(), null, 'all');
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), time(), 'all');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('slick');
    wp_enqueue_style('style');
    $js_directory_uri = get_template_directory_uri() . '/js/';
    wp_register_script('slick', $js_directory_uri . 'slick.js', array('jquery'), null, true);
    wp_register_script('script', $js_directory_uri . 'script.js', array('jquery'), null, true);
    wp_enqueue_script('slick');
    wp_enqueue_script('script');
    wp_enqueue_script('script-landing', get_template_directory_uri() . '/js/ScrollMagic.min.js', array('jquery'), NULL, true);
}
add_action('wp_enqueue_scripts', 'load_theme_styles', 100);
/*REGISTER MENU*/
function menulang_setup()
{
    load_theme_textdomain('themename', get_template_directory() . '/languages');
    register_nav_menus(array('header_menu' => __('Menu', 'themename')));
    register_nav_menus(array('mobile_menu' => __('Mobile Menu', 'themename')));
    register_nav_menus(array('footer_menu-onehalf' => __('footer menu one half', 'themename')));
    register_nav_menus(array('footer_social' => __('footer social', 'themename')));
    register_nav_menus(array('footer_menu-center' => __('footer menu-center', 'themename')));
}
add_action('after_setup_theme', 'menulang_setup');
function theme_sidebars()
{
    register_sidebar(array('name' => __('Header logo', 'themename'),
        'id' => 'header_logo',
        'description' => __('Header logo', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Header button', 'themename'),
        'id' => 'header_button',
        'description' => __('Header button', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Header Call Us', 'themename'),
        'id' => 'header_call',
        'description' => __('Header phone', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer logo', 'themename'),
        'id' => 'footer_logo',
        'description' => __('Footer logo', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Developed', 'themename'),
        'id' => 'footer_developed',
        'description' => __('Footer Developed', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Phone', 'themename'),
        'id' => 'footer_phone',
        'description' => __('Footer phone', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Text', 'themename'),
        'id' => 'footer_text',
        'description' => __('Footer Text', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Copyright', 'themename'),
        'id' => 'footer_copyright',
        'description' => __('Footer copyright', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Website Design', 'themename'),
        'id' => 'footer_design',
        'description' => __('Footer Website Design', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array('name' => __('Footer Contact 2', 'themename'),
        'id' => 'footer_contact_2',
        'description' => __('Footer contact', 'themename'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
}
add_action('widgets_init', 'theme_sidebars');
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
class    Main_Submenu_Class extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $classes = array('sub-menu', 'list-unstyled', 'child-navigation');
        $class_names = implode(' ', $classes);
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names_arr = array();
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        if (is_single()) {
            $curr_post_type = get_post_type(get_the_ID());
            if (in_array($curr_post_type, $classes)) {
                $classes[] = 'current_page_parent';
                $classes[] = 'current-menu-item';
            } else {
                if (($key = array_search('current_page_parent', $classes)) !== false) {
                    unset($classes[$key]);
                }
                if (($key = array_search('current-menu-item', $classes)) !== false) {
                    unset($classes[$key]);
                }
            }
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names_arr[] = esc_attr($class_names);
        $class_names_arr[] = 'menu-item-id-' . $item->ID;
        if ($args->has_children) {
            $class_names_arr[] = 'has-child';
        }
        $class_names = ' class="' . implode(' ', $class_names_arr) . '"';
        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        $attributes = '';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . $item->url . '"' : '';
        $item_output = $args->before;
        $item_output .= '<div class="parent"><a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ($args->has_children) {
            $item_output .= '<span data-id="' . $item->ID . '"><i class="fa-solid fa-chevron-left"></i></span>';
        }
        $item_output .= '</div>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
// Numbered pagination
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<div class='paginate'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        }
        if ($paged > 1 && $showitems < $pages) {
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"pag_item current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"pag_item inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) {
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        }
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        }
        echo "</div>\n";
    }
}
/*SHORT CODE SLIDER-IMAGE*/
add_shortcode('slider-images', 'shortcode_slider');
function shortcode_slider()
{
    $slider_img = get_field('slider_images'); ?>
    <?php if ($slider_img): ?>
    <div class="slider_images">
        <?php foreach ($slider_img as $value) { ?>
            <div class="item">
                <div class="images">
                    <img src="<?= $value['image']['url']; ?>" alt="image slider">
                </div>
                <div class="location">
                    <div class="address h4"><?= $value['location_n']; ?></div>
                    <div class="city"><p><?= $value['city_n']; ?></p></div>
                </div>
                <a href="<?= $value['link_n']; ?>" class="link_post">Link Post</a>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>
<?php }
/*SHORT CODE FORM SECTION*/
add_shortcode('form_section', 'shortcode_form');
function shortcode_form()
{
    $id = get_the_ID();
    $title_t = get_field('title_t', 7);
    $subtitle_f = get_field('subtitle_f', 7);
    $card_title_f = get_field('card_title_f', 7);
    $button_text_f = get_field('button_text_f', 7);
    $button_link_f = get_field('button_link_f', 7);
    $card_image_f = get_field('card_image_f', 7); ?>
    <div class="row">
        <div class="col-lg-6 col_card-f">
            <h2><?= $title_t; ?></h2>
            <p><?= $subtitle_f; ?></p>
            <div class="card_form" style="background-image: url(<?= $card_image_f ?>);">
                <div class="wrapper">
                    <h3><?= $card_title_f; ?></h3>
                    <a class="btn_main btn_white-f" target="_blank"
                       href="<?= $button_link_f; ?>"><?= $button_text_f; ?></a></div>
            </div>
        </div>
        <div class="col-lg-6 cold_form-f">
            <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"] '); ?>
        </div>
    </div>
<?php }
/*SLIDER TEAM*/
add_shortcode('slider_team', 'shortcode_slider_team');
function shortcode_slider_team()
{
    $slider_team = get_field('content_slider', 96); ?>
    <div class="row_sl">
        <div class="block_text_container">
            <div class="container">
                <div class="block block-text">
                    <div class="bl_body_sl row">
                        <div class="content_text col-lg-8">
                            <h2><?php echo get_field('title_team', 96); ?></h2>
                            <p><?php echo get_field('subtitle_team', 96); ?></p>
                        </div>
                        <div class="col-lg-4 btn_wrapper"><a class="btn_main btn_blue" href="<?php echo get_field('link_fairbridge_team', 96); ?>"><?php echo get_field('fairbridge_team', 96); ?></a>
                        </div>
                    </div>
                </div>
                <div class="block block-img_sl">
                    <?php if ($slider_team): ?>
                        <div id="slider_reviews_8" class="slider_reviews_8 mt68">
                            <?php foreach ($slider_team as $key => $value) { ?>
                                <div class="wrapper_card">
                                    <div class="col-img">
                                        <div class="person_info">
                                            <span class="name"><?= $value['name']; ?></span>
                                            <span class="position"><?= $value['position']; ?></span></div>
                                        <img class="photo" src="<?= $value['photo_team']['url']; ?>"
                                             alt="<?php echo $value['photo_team']['alt'] ?>">
                                    </div>
                                    <div class="col-content">
                                        <div class="col_slider_rew"><?= $value['description']; ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php }
/*SLIDER TEAM*/
add_shortcode('leadership', 'shortcode_leadership');
function shortcode_leadership()
{
    $slider_team = get_field('content_slider', 96); ?>
        <div class="main_wrapp">
    <div class="row row_leader">
    <?php if ($slider_team): ?>
    <?php foreach ($slider_team as $key => $value) { ?>
            <div class="col-item_leader col-lg-6 mb26">
                <div class="leader-wrapper wrapper_card">
                    <div class="col-img">
                        <div class="person_info">
                            <span class="name"><?= $value['name']; ?></span>
                            <span class="position"><?= $value['position']; ?></span></div>
                        <img class="photo" src="<?= $value['photo_team']['url']; ?>"
                             alt="<?php echo $value['photo_team']['alt'] ?>">
                    </div>
                <div class="col-content">
                    <div class="col_slider_rew"><?= $value['description']; ?></div>
                </div
                </div>

            </div>
        <div class="wrapper_button-e">
            <a class="btn_mail" target="_blank"
               href="<?= $value['email']; ?>"><?= $value['text_email_button']; ?></a>
            <a class="btn_linkdn" target="_blank"
               href="<?= $value['inkedin']; ?>">Connect on LinkedIn <i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        </div>
        <?php } ?>
    <?php endif; ?>
    </div>
    </div>
<?php }
/*AJAX CUSTOM FIELDS*/
add_action('wp_ajax_acf_repeater_show_more', 'acf_repeater_show_more');
add_action('wp_ajax_nopriv_acf_repeater_show_more', 'acf_repeater_show_more');

function acf_repeater_show_more()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'my_repeater_field_nonce')) {
        exit;
    }
    if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
        return;
    }
    $show = 3;
    $start = $_POST['offset'];
    $end = $start + $show;
    $post_id = $_POST['post_id'];
    ob_start();
    if (have_rows('content_data', $post_id)) {
        $total = count(get_field('content_data', $post_id));
        $count = 0; ?>
        <?php while (have_rows('content_data', $post_id)) {
            the_row();
            if ($count < $start) {
                $count++;
                continue;
            }
            ?>
            <?php $data = get_sub_field('acf_repeater_field'); ?>
            <?php if($data['select_data'] == 'Video'){ ?>
                <div class="col-lg-4 col-md-6 col-sm-6 card_data card-video">
                    <div class="img_top-data video-data">
                        <?php if($data['preview_for_video']){ ?>
                            <img src="<?php echo $data['preview_for_video'];?>" alt="overllay img">
                        <?php  } ?>
                        <span class="label-data">VIDEO</span>
                        <a data-fancybox="" class="link_video" href="<?php echo  $data['link_download']; ?>"><i class="fas fa-play"></i></a>
                    </div>
                    <div class="wrapper-data">
                        <h6><?php echo $data['file_name'];?></h6>
                        <a class="link_download" href="<?php echo $data['link_download'];?>" download="download video" title="">Download <i class="fa-solid fa-download"></i></a>
                    </div>
                </div>
            <?php }
            elseif ($data['select_data'] == 'JPEG'){ ?>
                <div class="col-lg-4 col-md-6 col-sm-6 card_data card-jpg">
                    <div class="img_top-data jpg-data">
                        <?php if($data['link_download']){ ?>
                            <img src="<?php echo $data['link_download'];?>" alt="overllay img">
                        <?php  } ?>
                        <img src="<?php echo $data['link_download'];?>" alt="overllay img">
                        <span class="label-data">JPEG</span>
                    </div>
                    <div class="wrapper-data">
                        <h6><?php echo $data['file_name'];?></h6>
                        <a class="link_download" href="<?php echo $data['link_download'];?>" download="download jpg" title="">Download <i class="fa-solid fa-download"></i></a>
                    </div>
                </div>
            <?php }
            elseif ($data['select_data'] == 'PDF'){ ?>
                <div class="col-lg-4 col-md-6 col-sm-6 card_data card-doc">
                    <div class="img_top-data doc-data">
                        <img src="/wp-content/uploads/2022/10/pdf-1.svg" alt="overllay img">
                        <span class="label-data">PDF</span>
                    </div>
                    <div class="wrapper-data">
                        <h6><?php echo $data['file_name'];?></h6>
                        <a class="link_download" href="<?php echo $data['link_download'];?>" download="download pdf" title="">Download <i class="fa-solid fa-download"></i></a>
                    </div>
                </div>
            <?php }
            elseif ($data['select_data'] == 'DOC'){ ?>
                <div class="col-lg-4 col-md-6 col-sm-6 card_data card-doc">
                    <div class="img_top-data doc-data">
                        <img src="/wp-content/uploads/2022/10/doc-2.svg" alt="overllay img">
                        <span class="label-data">DOC</span>
                    </div>
                    <div class="wrapper-data">
                        <h6><?php echo $data['file_name'];?></h6>
                        <a class="link_download" href="<?php echo $data['link_download'];?>" download="download doc" title="">Download <i class="fa-solid fa-download"></i></a>
                    </div>
                </div>
            <?php } ?>
            <?php
            $count++;
            if ($count == $end) {
                break;
            }
        } ?>
    <?php }
    $content = ob_get_clean();
    $more = false;
    if ($total > $count) {
        $more = true;
    }
    echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
    exit;
} ?>
<?php function show_careers(){ ?>
<section class="mt110 section_blog-main section_сareer">
        <div class="container">
<div class=" row row_career">
    <?php global $wp_query;
    $args = [

        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'cat' => 10
    ];
    $temp_query = $wp_query;
    $query = new WP_Query($args);

    if (isset($query->posts)) {
    foreach ($query->posts as $key => $val) {
            $id = $val->ID;
            $permalink = get_the_permalink($id);
            $title = get_the_title($id);
            $req = get_field('requirement',$id);
            ?>
            <div class="wrapper_career col-lg-4">
                <div class="item_career">
                    <h4><?= $title; ?></h4>
                    <?php if ($req): ?>
                        <ul class="req">
                            <?php foreach ($req as $value) { ?>
                                <li><?= $value['requirement_t']; ?></li>
                            <?php } ?>
                        </ul>
                    <?php endif; ?>
                    <a class="btn_main btn_white-f" href="<?= $permalink; ?>">Details</a>
                </div>
            </div>

        <?php }
        wp_reset_postdata();
        $wp_query = NULL;
        $wp_query = $temp_query; ?>
    <?php  }

    else{ ?>
        <h3>Unfortunately, right now there are no carreer opportunities available</h3>
    <?php  }
    ?>
</div>
</div>
</section>
<?php }
add_shortcode('careers', 'show_careers');
