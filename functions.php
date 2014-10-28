<?php
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function person_func($attr, $content = null) {
    $user = get_user_by('login', $attr['nick']);
    $image = get_cupp_meta($user->ID, 'thumbnail');
    ob_start();
    ?>
        <section>
            <div style="background-image: url('<?=$image?>');"></div>
            <h3><?php echo $user->first_name . " " . $user->last_name; ?></h3>
            <span class="role"><?=$attr['role']?></span>
            <span><?=$user->user_email?></span>
        </section>
    <?php
    return ob_get_clean();
}
add_shortcode('person', 'person_func');

$n_emeritus = 0;
function emeritus_func($attr, $content = null) {
    global $n_emeritus;

    ob_start();

    $image = false;
    if (isset($attr['image']) && file_exists("wp-content/uploads/". $attr['image'])) {
        $attr['image'] = "wp-content/uploads/". $attr['image'];
        $image = true;
        if ($n_emeritus % 2 !== 0) {
            echo "</div><div>";
        }
    }
    if ($n_emeritus % 2 === 0) {
        echo "<div>";
    }
    ?>
        <section>
            <h3>styrIT <?=$attr['year']?></h3>
            <ul>
                <?php echo do_shortcode($content); ?>
            </ul>
        </section>
    <?php
    if ($image) {
        $n_emeritus++;
        ?>
        <section class="image">
            <a href="<?=$attr['image']?>" class="image" target="blank">
                <img src="<?=$attr['image']?>" />
            </a>
        </section>
        <?php
    }
    if (++$n_emeritus % 2 === 0) {
        echo "</div>";
    }
    return ob_get_clean();
}
add_shortcode('emeritus', 'emeritus_func');

function emeritusDone_func() {
    global $n_emeritus;
    return $n_emeritus % 2 === 0 ? "" : "</div>";
}
add_shortcode('emeritusDone', 'emeritusDone_func');

function emeritusPerson_func($attr, $content = null) {
    return "<li><strong>$content</strong> ({$attr['role']})</li>";
}
add_shortcode('emeritusPerson', 'emeritusPerson_func');

function document_func($attr, $content = null) {
    if (file_exists("wp-content/uploads/{$attr['file']}")) {
        $attr['file'] = "wp-content/uploads/{$attr['file']}";
    }
    return "<li><a href=\"{$attr['file']}\" target=\"blank\" />$content</a></li>";
}
add_shortcode('document', 'document_func');
?>
