<?php
// Ładujemy nagłówek
get_header();
?>

<main class="pojedynczy-wpis">
    <?php
    // Sprawdzamy, czy jest zawartość wpisu
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>

        <article class="wpis">
            <!-- Tytuł wpisu -->
            <h1><?php the_title(); ?></h1>

            <!-- Obrazek wyróżniający, jeśli istnieje -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="obrazek-wpisu">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Treść wpisu -->
            <div class="tresc-wpisu">
                <?php the_content(); ?>
            </div>
        </article>

    <?php
        endwhile;
    else :
        echo "<p>Nie znaleziono wpisu.</p>";
    endif;
    ?>
</main>

<?php
// Ładujemy stopkę
get_footer();
?>
