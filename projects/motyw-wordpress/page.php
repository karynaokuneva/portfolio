<?php
// Ładujemy nagłówek motywu
get_header();
?>

<main class="szablon-strony">
    <?php
    // Sprawdzamy, czy jest zawartość strony
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>

        <article class="strona">
            <!-- Tytuł strony -->
            <h1><?php the_title(); ?></h1>

            <!-- Treść główna strony -->
            <div class="tresc-strony">
                <?php the_content(); ?>
            </div>
        </article>

    <?php
        endwhile;
    else :
        echo "<p>Brak zawartości do wyświetlenia.</p>";
    endif;
    ?>
</main>

<?php
// Ładujemy stopkę motywu
get_footer();
?>



