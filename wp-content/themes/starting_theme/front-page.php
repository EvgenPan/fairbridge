<?php get_header();
/*Hero fields*/
$id = get_the_ID();
$title = get_field('the_title_top',$id) ?: '';
$subtitle = get_field('the_subtitle_top',$id) ?: '';
$background_image = get_field('background_image',$id) ?: '';
$rows = get_field('btn_content');
$m_x_full = get_field('content_width',$id) ?: '';
 ?>
    <section class="block_hero page_<?php echo $id ?>">
            <div class="top_section p110 border_none" style="background-image: url(<?=$background_image?>);">
                <div class="container">
                    <div class="content_hero <?php if($m_x_full) { ?>title_w_full<?php } ?>">
                        <?=$title ?>
                        <?php if($subtitle) { ?>
                            <p class="subtitle"><?=$subtitle ?></p>
                        <?php }?>
                        <div class="btn_content_h mt68">
                            <?php if($rows): ?>
                                <div class="numbers">
                                    <div class="numbers_wrapper">
                                        <?php foreach ($rows as $key => $value) { ?>
                                            <div class="number_item">
                                                <?php if($value['btn_text'] && $value['btn_link'] ) { ?>
                                                    <img class="number" src="<?=$value['btn_number'] ?>" alt="number">
                                                    <h6><?=$value['btn_text'] ?></h6>
                                                    <a href="<?=$value['btn_link'] ?>" class="btn-cube"></a>
                                                    <a href="<?=$value['btn_link'] ?>" class="wrapper_l"></a>
                                                <?php } ?>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>