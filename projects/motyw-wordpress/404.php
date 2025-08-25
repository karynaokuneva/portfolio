<?php
// Ładujemy nagłówek motywu
get_header();
?>

<main class="blad-404">
    <h1>404 — Nie znaleziono strony</h1>
    <p>Ups! Strona, której szukasz, nie istnieje.</p>
    <a href="<?php echo home_url(); ?>" class="btn">Wróć na stronę główną</a>
</main>

<?php
// Ładujemy stopkę
get_footer();
?>
