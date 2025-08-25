<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <?php
    // WordPress ładuje tutaj wszystkie style i skrypty
    wp_head();
    ?>
</head>
<body>

<header>
    <!-- Nagłówek strony -->
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
   

</header>




<nav class="menu-glowne">
    <?php
    // Wyświetlamy menu z lokalizacji „menu-glowne”, z klasami CSS
    wp_nav_menu(array(
        'theme_location' => 'menu-glowne',
        'menu_class' => 'menu',
    ));
    ?>
</nav>
