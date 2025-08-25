<?php 
// Ładuje górną część strony (nagłówek), jeśli plik header.php istnieje w motywie
get_header(); 
?>

<main>
    <!-- Główna zawartość strony -->
    <h1>To jest mój pierwszy motyw WordPress!</h1>
    <p>Wkrótce pojawi się tutaj piękna strona.</p>

<a href="http://localhost/karynamotyw/kontakt/" class="btn">Skontaktuj się z nami</a>


    <section class="sekcja-karty">
    <h2>Nasze produkty</h2>

    <div class="kontener-kart">
        <?php
        // Sprawdzamy, czy są dostępne wpisy
        if (have_posts()) :
            // Pętla WordPress: przechodzi przez każdy wpis
            while (have_posts()) : the_post();
        ?>
            <div class="karta">
                <?php if (has_post_thumbnail()) : ?>
                    <!-- Obrazek wyróżniający (jeśli istnieje) -->
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                <?php endif; ?>

                <!-- Tytuł wpisu -->
                <h3><?php the_title(); ?></h3>

                <!-- Skrócona treść wpisu (20 słów) -->
                <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>

                <!-- Przycisk do pełnego wpisu -->
                <a href="<?php the_permalink(); ?>" class="btn">Zobacz więcej</a>
            </div>
        <?php
            endwhile;
        else :
            // Wiadomość, jeśli brak wpisów
            echo "<p>Brak produktów do wyświetlenia.</p>";
        endif;
        ?>
    </div>
</section>





</main>

<?php 
// Ładuje dolną część strony (stopkę), jeśli plik footer.php istnieje w motywie
get_footer(); 
?>


