<?php
// Pasek boczny – wczytywany za pomocą get_sidebar()

if (is_active_sidebar('sidebar-1')) : ?>
    <aside class="sidebar">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
<?php endif; ?>
