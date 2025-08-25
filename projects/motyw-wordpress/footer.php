<footer>
    <!-- Nawigacja w stopce -->
    <nav class="footer-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-stopka',
            'menu_class' => 'footer-menu'
        ));
        ?>
    </nav>

    <!-- Stopka strony: prawa autorskie -->
    <p class="footer-copy">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Wszystkie prawa zastrzeżone.
    </p>
</footer>

<?php
// WordPress ładuje tutaj skrypty JS i zamyka <body> i <html>
wp_footer();
?>
</body>
</html>
