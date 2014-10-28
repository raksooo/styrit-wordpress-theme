<?php get_header(); ?>
    <main>
        <div id="content" role="main">
            
            <?php
                $title = is_front_page() ? get_bloginfo('name') : wp_title('', false);
                if ($title !== "") {
                    echo "<h2>" . $title . "</h2>";
                }
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
            ?>
        </div>
    </main>
<?php get_footer(); ?>
