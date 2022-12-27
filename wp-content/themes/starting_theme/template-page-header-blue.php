<?php
/*
*   Template Name: Template Page Header Blue
*/
get_header('blue'); ?>
<?php
$id = get_the_ID();
 ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
