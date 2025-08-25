<?php

// Funkcja do ładowania plików stylów
function karynamotyw_dodaj_style() {
    // Rejestracja i ładowanie głównego pliku stylów motywu
    wp_enqueue_style('karynamotyw-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'karynamotyw_dodaj_style');


// Rejestracja menu nawigacyjnego
function karynamotyw_rejestruj_menu() {
    register_nav_menus(array(
        'menu-glowne' => 'Menu główne',
        'menu-stopka' => 'Menu stopki'
    ));
}
add_action('after_setup_theme', 'karynamotyw_rejestruj_menu');


// Rejestracja obszaru widgetów (sidebar)
function karynamotyw_register_sidebar() {
    register_sidebar(array(
        'name'          => 'Pasek boczny',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'karynamotyw_register_sidebar');


// Wsparcie dla WooCommerce
function karynamotyw_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'karynamotyw_add_woocommerce_support');