<?php
if ( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly.
global $idt_helper;
?>

<form role="search" method="get" class="idt-search-form" action="<?php echo $idt_helper->getHomeUrl();?>">
    <div class="input-group">
        <label class="idt-label" for="s"><?php _e( 'Search', 'insomniodev' );?></label>
        <input type="text" class="form-control" name="s" id="s" placeholder="<?php _e( 'Search', 'insomniodev' );?>">
        <div class="input-group-append">
            <span class="input-group-text">
                <button type="submit" class="idt-search-submit" ><i class="fas fa-search"></i></button>
            </span>
        </div>
    </div>
</form>
