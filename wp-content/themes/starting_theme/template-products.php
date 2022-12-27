<?php
/*
*   Template Name: Template Products
*/
get_header(); ?>
<?php
$id = get_the_ID();
$title = get_field('the_title_top',$id) ?: '';
$subtitle = get_field('the_subtitle_top',$id) ?: '';
$background_image = get_field('background_image',$id) ?: '';
$link_btn = get_field('link_btn_top',$id) ?: '';
$text_btn = get_field('button_text_top',$id) ?: '';
$m_x_full = get_field('content_width',$id) ?: '';
?>
<section class="block_hero product_tmp">
    <div class="top_section p110 border_none" style="background-image: url(<?=$background_image?>);">
        <div class="container">
            <div class="content_hero <?php if($m_x_full) { ?>title_w_full<?php } ?>">
                <?=$title ?>
                <?php if($subtitle) { ?>
                    <p class="subtitle h5"><?=$subtitle ?></p>
                <?php }?>

                <?php if($link_btn && $text_btn) { ?>
                    <div class="pt42">
                        <a class="btn_main btn_white" target="_blank" href="<?php echo $link_btn; ?>"><?=$text_btn ?></a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>
<?php
$id = get_the_ID();
$product_card = get_field('product_card',$id);
$pr_id = 1;
if ($product_card): ?>
    <div class="wrapper_products mt110">
        <div class="container">
        <div class="row">
        <?php foreach ($product_card as $key => $value) { ?>
            <div class="product_card col-lg-6">
                <div class="item_product_card">
                <div class="number_card">
                    <div class="count h1"><?php if($pr_id >= 10) { echo $pr_id; } else { echo '0'. $pr_id;} ?></div>
                </div>
                <div class="product_content">
                    <h2><?= $value['product_title']; ?></h2>
                    <h3><?= $value['product_description']; ?></h3>
                </div>
                <div class="image_prod"><img src="<?= $value['product_image']['url']; ?>" alt="<?= $value['product_image']['url']; ?>"></div>
            </div>
            </div>
        <?php $pr_id++; } ?>
        </div>
        </div>
    </div>
<?php endif; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
