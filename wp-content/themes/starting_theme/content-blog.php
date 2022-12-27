<?php
/*Hero fields*/
$id = get_the_ID();
$page_for_posts = get_option('page_for_posts');
$title = get_field('the_title_top', $page_for_posts) ?: '';
$subtitle = get_field('the_subtitle_top', $page_for_posts) ?: '';
$background_image = get_field('background_image', $page_for_posts) ?: '';
$rows = get_field('btn_content');
$m_x_full = get_field('content_width', $page_for_posts) ?: '';
?>
    <section class="block_hero page_<?php echo $page_for_posts ?>">
        <div class="top_section-page p110 border_none" style="background-image: url(<?= $background_image ?>);">
            <div class="container">
                <div class="content_hero <?php if ($m_x_full) { ?>title_w_full<?php } ?>">
                    <?= $title ?>
                    <?php if ($subtitle) { ?>
                        <p class="subtitle"><?= $subtitle ?></p>
                    <?php } ?>
                    <div class="btn_content_h mt68">
                        <?php if ($rows): ?>
                            <div class="numbers">
                                <div class="numbers_wrapper">
                                    <?php foreach ($rows as $key => $value) { ?>
                                        <div class="number_item">
                                            <?php if ($value['btn_text'] && $value['btn_link']) { ?>
                                                <img class="number" src="<?= $value['btn_number'] ?>" alt="number">
                                                <h6><?= $value['btn_text'] ?></h6>
                                                <a href="<?= $value['btn_link'] ?>" class="btn-cube"></a>
                                                <a href="<?= $value['btn_link'] ?>" class="wrapper_l"></a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php if (have_posts()) : ?>
    <?php query_posts('cat=9'); ?>
    <?php if (query_posts('cat=9')) { ?>
        <section class="mt110 section_blog-main section_public_deals">
            <div class="row_slider-img">
                <div class="container">
                    <h2><?= _e('Previous Transactions', 'themename'); ?></h2>
                    <div class="slider_images slider_blog">
                        <?php while (have_posts()) : the_post();
                            $permalink = get_the_permalink();
                            $title = get_the_title();
                            $date = get_the_date('M j, Y');
                            $excerpt = get_the_excerpt();
                            $content = get_the_content();
                            $img = get_the_post_thumbnail();
                            ?>
                            <div class="item">
                                <div class="images">
                                    <?= $img; ?>

                                </div>
                                <div class="location">
                                    <div class="address h4"><?= $title; ?></div>
                                    <div class="city"><p><?= $excerpt ?></p></div>
                                </div>
                                <a href="<?= $permalink; ?>" class="link_post">Link Post</a>
                            </div>
                        <?php
                        endwhile; ?>

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php endif; ?>
<?php wp_reset_query();
?>
<?php
$show_career = get_field('show_block_careers', 102);
if ($show_career) { ?>
    <section class="mt110 section_blog-main section_сareer">
        <div class="container">
            <h2><?= _e('Career Opportunities', 'themename'); ?></h2>
            <div class="row row_career">
                <?php
                $myposts = get_posts(array(
                    'category' => 10,
                    'posts_per_page' => 6,
                ));
                if ($myposts){
                foreach ($myposts as $post) {
                    $id = get_the_ID();
                    $permalink = get_the_permalink();
                    $title = get_the_title();
                    $excerpt = get_the_excerpt();
                    $content = get_the_content();
                    $img = get_the_post_thumbnail();
                    $req = get_field('requirement', $id);
                    setup_postdata($post); ?>
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
                    <?php wp_reset_postdata(); ?>
                <?php } ?></div>
            <div class="wrapper_btn-career">
                <a class="btn_main btn_blue" style="margin-left: auto; margin-right: auto" href="/careers/">Learn
                    More</a>
            </div>
            <?php } else { ?>
                <div class="wrapper_btn-career">
                    <h3>Unfortunately, right now there are no carreer opportunities available</h3>
                </div>
            <?php }
            ?>
        </div>
    </section>
<?php } ?>

<?php if (have_posts()) : ?>
    <?php query_posts('cat=11'); ?>
    <?php
    if (query_posts('cat=11')) { ?>
        <section class="mt110 section_blog-main section_talks">
            <div class="row_slider-img">
                <div class="container">
                    <h2><?= _e('Talks/Conferences', 'themename'); ?></h2>
                    <div class="slider_images slider_blog">
                        <?php
                        while (have_posts()) : the_post();
                            $permalink = get_the_permalink();
                            $title = get_the_title();
                            $date = get_the_date('M j, Y');
                            $excerpt = get_the_excerpt();
                            $content = get_the_content();
                            $img = get_the_post_thumbnail();
                            ?>
                            <div class="item">
                                <div class="images">
                                    <?= $img; ?>
                                </div>
                                <div class="location">
                                    <div class="address h4"><?= $title; ?></div>
                                    <div class="city"><p><?= $excerpt ?></p></div>
                                </div>
                                <a href="<?= $permalink; ?>" class="link_post">Link Post</a>
                            </div>
                        <?php
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }
    ?>
<?php endif; ?>
<?php wp_reset_query();
?>
<?php if (have_posts()) : ?>
    <?php query_posts('cat=12');
    if (query_posts('cat=12')) { ?>
        <section class="mt110 section_blog-main section_press">
            <div class="row_slider-img">
                <div class="container">
                    <h2><?= _e('Press', 'themename'); ?></h2>
                    <div class="slider_images slider_blog slider_press">
                        <?php while (have_posts()) : the_post();
                            $id = get_the_ID();
                            $permalink = get_the_permalink();
                            $title = get_the_title();
                            $date = get_the_date('M j, Y');
                            $excerpt = get_the_excerpt();
                            $content = get_the_content();
                            $img = get_the_post_thumbnail();
                            $link_press = get_field('url_press', $id);
                            ?>
                            <div class="item_press">
                                <div class="item">
                                    <div class="images">
                                        <?= $img; ?>
                                    </div>
                                    <div class="location">
                                        <div class="address h4"><?= $title; ?></div>
                                        <div class="city"><p><?= $excerpt; ?></p></div>
                                    </div>
                                    <a href="<?= $permalink; ?>" class="link_post">Link Post</a>
                                </div>
                                <a class="link_back link_more" href="<?php echo $link_press; ?>">Read More</a>
                            </div>
                        <?php
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php endif; ?>
<?php wp_reset_query();
?>