<?php
/**
 * Quick View button for the preview card template.
 *
 * @since 2.2
 */
if ( ! defined('ABSPATH') ) {
	exit;
} ?>
<li class="item-preview">
    <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="<?php echo esc_attr( $listing->get_id() ) ?>">
    	<i class="fab fa-sistrix"></i>
    </a>
</li>