<?php
/**
 * Display "Head Buttons" in the listing preview card template.
 *
 * @since 1.0
 */
if ( ! defined('ABSPATH') ) {
    exit;
} ?>
<div style="width: 38%;" class="lf-head <?php echo esc_attr( $priority_class ) ?>">
    
    <?php if ( $listing->get_priority() == 20 ): ?>
        <a style="color:#666974;" class="showroom-badge" href="<?php echo esc_url( $listing->author->get_link() ) ?>">
        <div class="lf-head-btn ad-badge bdg-header-trending" data-toggle="tooltip" data-placement="right" data-original-title="Garage Pro.">
            <span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
            <i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
            Promoted</span>
        </div>
        </a>
    <?php endif ?>
   
    
    <?php if ( $listing->is_verified() ): ?>
        <div class="lf-head-btn ad-badge bdg-header-trending ad-badge-pop hide-popup" data-toggle="tooltip" data-placement="right" data-original-title="Annonce vérifié">
            <img class="verified-listing" style="display: inline-block;width: 25px;position: relative;top: 0px;margin-right: -1px;margin-left: 0px;margin-right: -7px;" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>">
        </div>
    <?php endif ?>
    
    
    
</div>  
<div class="lf-head-2 <?php echo esc_attr( $priority_class ) ?>">
    <?php if ( ! empty( $options['buttons'] ) ) {
        foreach ( (array) $options['buttons'] as $button ) {
            $string = $button['label'];
            $attributes = [];
            $classes = [ 'lf-head-btn', has_shortcode( $button['label'], '27-format' ) ? 'formatted' : '' ];

            if ( $is_caching ) {
                list( $string, $attributes, $cls ) = \MyListing\prepare_string_for_cache( $string, $listing );
                $classes += $cls;
            } elseif ( \MyListing\str_contains( $string, '[[work_hours]]' ) ) {
                $classes[] = 'open-status listing-status-'.$listing->schedule->get_status();
            }

            if ( \MyListing\str_contains( $string, '[[:reviews-stars]]' ) ) {
                $classes[] = 'listing-rating rating-preview-card';
            }

            $content = do_shortcode( $listing->compile_string( $string ) );
            if ( ! empty( $content ) ) { ?>
                <div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>" <?php echo join( ' ', $attributes ) ?>>
                    <?php echo $content ?>
                </div>
            <?php }
        }
    } ?>
</div>
<div id="milouda" style="position: absolute;bottom: 8px;right: 4px;z-index: 9;">
    
<?php 
    $author = $listing->get_author();
    if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
        return;
    }
    $premium_customer = $author->get_premium_customer();


    ?>
    <?php if( $premium_customer ): ?>
        <a style="color:#666974;" class="showroom-badge" href="<?php echo esc_url( $listing->author->get_link() ) ?>">
            <div class="lf-head-btn ad-badge bdg-header-trending">
                <span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 7px;font-size: 12px;padding-right: 7px;margin-right: -9px;">
                Showroom</span>
            </div>
        </a>
    <?php endif; ?>

</div>