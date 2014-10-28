<?php
    $pages = Array("/" => "styrIT", "emeritus" => "EmerITus", "dokument" => "Dokument");
    $file = trim($_SERVER['REQUEST_URI'], '/') ?: "/";
?>
<!DOCTYPE html>
<html lang="sv" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?=$pages[$file]?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" />
    <link href="http://fonts.googleapis.com/css?family=Oxygen:300,400,700" rel="stylesheet" type="text/css" />
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />
    <?php wp_head(); ?>
</head>
<body>
<div>
    <h1>StyrIT</h1>
    <header>
        <img src="<?php bloginfo('template_directory'); ?>/images/it.svg" height="90" alt="Informationstekniks logga" />
        <nav>
            <ul>
<?php foreach($pages as $url => $page):
    if ($url == $file): ?>
                <li><?=$page?></li>
    <?php else: ?>
                <li><a href="<?=$url?>"><?=$page?></a></li>
    <?php endif;
endforeach; ?>
                <li><a href="https://chalmers.it" target="blank">chalmers.it</a></li>
            </ul>
        </nav>
    </header>
