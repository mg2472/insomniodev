<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

?>

<form role="search" method="get" class="idt-search-form" action="<?php echo idtGetHomeUrl();?>">
    <div class="input-group">
        <label class="idt-label" for="s"><?php _e( 'Search', 'insomniodev' );?></label>
        <input type="text" class="form-control" name="s" id="s" placeholder="<?php _e( 'Search', 'insomniodev' );?>">
        <div class="input-group-append">
            <span class="input-group-text">
                <button type="submit" class="idt-search-submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
            </span>
        </div>
    </div>
</form>
