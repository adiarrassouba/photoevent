<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body>
<div class="header-container">
            

        <nav class="nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-title">
                <a href="<?php echo home_url('/'); ?>">
                    <img class="logo" src="<?php echo get_template_directory_uri(); ?>./photos/Logo.png" alt="Logo">
                </a>
                </div>
            </div>
            <div class="nav-btn burger-menu-logo">
                
            </div>
            
                <?php wp_nav_menu([
                    'theme_location' => 'main',
                    'menu_class' => 'navbar nav-list closed-nav-list',
                    'container' => false
                ]); ?>
                
        </nav>
</div>
        <?php get_template_part( 'template_parts/modal' ); ?>
       