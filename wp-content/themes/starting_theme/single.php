<?php

get_header();

?>
    <div class="single_post-page pt110">
        <div class="container">
            <article>
                <?php if (have_posts())  :  while (have_posts()) :  the_post(); ?>
                    <div class="content_single mt42 mb68">
                        <div class="content_single-top">
                            <div class="title_wrapper">
                                <h1 class="m26 h2"><?php the_title();?></h1>
                                <?php $date = get_the_date('M j, Y');?>
                                <span class="date p-small"><i class="fa-regular fa-calendar"></i> <?php echo $date; ?></span>
                            </div>
                            <?php
                            $id = get_the_ID();
                            $page_for_posts = get_option( 'page_for_posts' );
                            $image = get_field('post_banner',$id);
                            if( !empty( $image ) ): ?>
                                <div class="banner_wrapper mt42">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row mt42">
                        <div class="col-lg-9 content mb42">
                            <?php the_content();?></div>
                            <?php endwhile;
                            wp_reset_query();
                            endif; ?>
                        <div class="related_posts col-lg-3">
                            <h3>Related Posts:</h3>
                            <?php
                            $categories = get_the_category($post->ID);
                            if ($categories) {
                                $category_ids = array();
                                foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                                $args1 = array(
                                    'category__in' => $category_ids,
                                    'showposts'=>5,
                                    'orderby'=>'rand',
                                    'caller_get_posts'=>1
                                );
                                $my_query = new wp_query($args1);
                                $i=0;
                                if ($my_query->have_posts()) {
                                    echo '<div class="row_slider-img news_block">';
                                    while ($my_query->have_posts()) {
                                        $permalink = get_the_permalink();
                                        $title = get_the_title();
                                        $excerpt = get_the_excerpt();
                                        $content = get_the_content();
                                        $img = get_the_post_thumbnail();
                                        $my_query->the_post();
                                        ?>
                                        <div class="mb26 item item_<?php echo $i; ?> <?php if($individual_category->term_id == 10){ ?> item_career-b <?php } ?>">
                                            <?php
                                            if($img){ ?>
                                                <div class="images">
                                                    <?= $img; ?>
                                                </div>
                                           <?php }
                                            ?>
                                            <div class="location">
                                                <div class="address h4"><?= $title; ?></div>
                                                <div class="city"><p><?=  $excerpt; ?></p></div>
                                            </div>
                                            <a href="<?= $permalink; ?>" class="link_post">Link Post</a>
                                        </div>
                                        <?php
                                        $i++;  }
                                    echo '</div>';
                                }
                            }  wp_reset_query();
                            ?>
                            <div class="btn_chevron">
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        </div>
                    </div>

            </article>
            <a class="mt42 link_back"  href="/press/"><i class="fa-solid fa-chevron-left"></i> Back to <span style="font-weight: 700">Inside Fairbridge</span></a>
        </div>
    </div>
<?php get_footer();