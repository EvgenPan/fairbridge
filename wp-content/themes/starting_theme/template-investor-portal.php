<?php
/*
*   Template Name: Template Investor Portal
*/
get_header();


if ( ! post_password_required() ) { ?>
<?php
$invest_portal = get_field('block_investor_portal');
$data = get_field('content_data');
?>
<!--AJAX Video-->
<section class="ajax_acf mt110">
    <div class="container">
        <div class="title">
            <h1><?= _e('Investor Portal', 'themename'); ?></h1>
        </div>
        <?php
        $total_rows = count(get_field('content_data'));
        $count = 0;
        $number = 6;
        $i = 1;
        ?>
        <div class="ajax-container row mt110">
            <?php
            if (have_rows('content_data')) { ?>
                <?php
                while (have_rows('content_data')) {
                    the_row();
                    if ($count == $number) {
                        break;
                    } ?>
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
                    $i++;
                    $count++;
                } ?>
            <?php } ?>
        </div>
        <?php if( $count >= 6) { ?>
            <div class="bnt_wrapper acf-loadmore">
                <button class="btn_main btn_blue btn_blue-dark" onclick="javascript: acf_repeater_show_more();"
                    <?php if ($total_rows < $count) { ?> style="display: none;" <?php } ?>>
                    Load More
                </button>
            </div>
        <?php } ?>
    </div>
    <script>
        let my_repeater_field_post_id = <?php echo $post-> ID; ?>;
        let my_repeater_field_offset = <?php echo $number; ?>;
        let my_repeater_field_nonce = '<?php echo wp_create_nonce('my_repeater_field_nonce'); ?>';
        let my_repeater_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
        let my_repeater_more = true;
        function acf_repeater_show_more() {
            jQuery.post(my_repeater_ajax_url, {
                'action': 'acf_repeater_show_more',
                'post_id': my_repeater_field_post_id,
                'offset': my_repeater_field_offset,
                'nonce': my_repeater_field_nonce
            }, function (json) {
                jQuery('.ajax-container').append(json['content']);
                my_repeater_field_offset = json['offset'];
                if (!json['more']) {
                    jQuery('.acf-loadmore').css('display', 'none');
                }
            }, 'json');
        }
    </script>
</section>
<?php } ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
