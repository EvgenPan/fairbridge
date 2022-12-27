<?php 
global $wp_query,$post;
get_header();
if ( have_posts() ) :	
			 if ( !is_front_page() && is_home() ) { 
			get_template_part( 'content', 'blog' );
                 get_footer('blog');
             }
		else   
			{ 
				the_content();
                get_footer();
            }

			   endif;

 ?>