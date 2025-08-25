<form role="search" method="get" class="form-szukaj" action="<?php echo home_url('/'); ?>">
    <input type="search" name="s" placeholder="Szukaj..." value="<?php echo get_search_query(); ?>">
    <button type="submit" class="btn">Szukaj</button>
</form>
