<?php
/**
 * Listing "Quick View" template.
 *
 * @var   \MyListing\Src\Listing $listing
 * @since 1.0
 */
if ( ! defined('ABSPATH') ) {
	exit;
}

if ( ! ( $listing && $listing->type ) ) {
    return;
}

// preview/quick-view card options
$options = $listing->type->get_preview_options();
$is_caching = false;

$terms = $listing->get_field( 'tags' );

$listing_thumbnail = $listing->get_logo( 'thumbnail' ) ?: c27()->image( 'marker.jpg' );
$quick_view_template = $options['quick_view']['template'];
if ( ! ( $listing->get_data('geolocation_lat') && $listing->get_data('geolocation_long') ) ) {
	$quick_view_template = 'alternate';
}

if ( $listing->get_priority() >= 2 ) {
    $promotion_tooltip = _x( 'Promoted', 'Listing Preview Card: Promoted Tooltip Title', 'my-listing' );
} elseif ( $listing->get_priority() === 1 ) {
    $promotion_tooltip = _x( 'Featured', 'Listing Preview Card: Promoted Tooltip Title', 'my-listing' );
} else {
    $promotion_tooltip = '';
} ?>

<?php
if ( has_action( sprintf( 'mylisting/quick-view-template:%s', $quick_view_template ) ) ) {
    do_action( sprintf( 'mylisting/quick-view-template:%s', $quick_view_template ), $listing, $listing->type );
} elseif ( $_quick_view_template = locate_template( sprintf( 'templates/single-listing/quick-view/%s.php', $quick_view_template ) ) ) {
    require $_quick_view_template;
} else { ?>

<style>
.popup-grid-item {
    padding: 10px;
}
.mc-popup-left {
    display: inline-block;
    width: 59%;
}
.pop-up-side {
    display: inline-block;
    width: 40%;
}
.modal-content .lf-item-container {
    margin-bottom: -6px;
}
.modal-content {
    border: 0px solid rgba(0,0,0,.2);
}
.mc-popup-left .owl-carousel .lf-background {
    height: 500px;
}
.mc-popup-left .lf-item {
    height: 500px;
}
.modal-27 .modal-dialog {
    margin: auto;
}
h1#popup-listing-title{
	font-size:23px;
}
.popup-grid-item li>a {
    background: #e9e9e9;
    padding: 8px 10px;
    border-radius: 6px;
    font-size: 13px;
    margin: 3px;
    margin-right: -1px;
}
.popup-grid-item li>a:hover{
    background: #393c40;
}
.popup-grid-item li>a:active{
	background: #242429;
    color: white;
    outline: 2px solid #f26e1a;
}
.popup-grid-item ul.social-nav li{
    display: inline-block;
}
.popup-grid-item {    
    display: block;
    position: absolute;
    top: 0;
}
@media only screen and (max-width: 1200px){
.popup-grid-item {    
    position: inherit;
}
.mc-popup-left .gallery-nav{
	display:none;
}
.modal-content .lf-item-container {
    margin-bottom: 0px;
}
.mc-popup-left .owl-carousel .lf-background {
    height: 35vh;
}
.mc-popup-left .lf-item {
    height: 35vh;
}
.mc-popup-left {
    width: 100%;
}
.pop-up-side {
    width: 100%;
}}
/* owl dots */
.mc-popup-left .owl-dot {
    width: 12px;
    height: 3px;
    background: #f2f2f2;
    z-index: 99999;
    display: inline-block;
    margin: 0 4px;
    border-radius: 8px;
}
.mc-popup-left .owl-dot.active {
    background: #f26e1a;
}
.mc-popup-left .owl-dots {
    position: relative;
    bottom: 30px;
    text-align: center;
    background: linear-gradient(transparent, #ffffff);
    border-radius: 0;
    height: 30px;
}
.pop-up-side p#preview-card-address{
	position: relative!important;
    top: -5px!important;
    color: #000!important;
	max-width: 74%;
	display: inline-block;
}
.pop-up-side .sm-icon {
    top: -21px;
}
.pop-up-side .outlined-list.details-list.social-nav>li {
    height: 30px;
	margin-top: 8px;
}

.pop-up-side ul.outlined-list.social-nav{
    max-height: 100px;
    overflow: scroll;
	margin-top: 8px;
}
.pop-up-side span#carburant-preview svg {
    margin-right: 8px;
}




.mc-popup-left .owl-dot {
    width: 100%;
    height: 3px;
    background: #f2f2f2;
    z-index: 99999;
    display: inline-flex;
    margin: -3px 2px;
    border-radius: 8px;
    max-width: 12px;
    width: 100%;
}
.mc-popup-left .owl-dots {
    width: 100%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
	padding-left: 10px;
	padding-right: 10px;
}
.mc-popup-left .owl-dots {
    bottom: 80px;
    height: 80px;
}
.mc-popup-left .owl-dot {
    margin-top: 43px;
}
.modal-content:active{
    outline: 2px solid #f58806;
}
</style>
<div class="listing-quick-popup view-popup-container listing-popup-preview <?php echo esc_attr( "quick-pop-view-{$quick_view_template} quick-pop-view type-{$listing->type->get_slug()} tpl-{$quick_view_template}" ) ?>">
	<div class="mc-popup-left">
		<div class="lf-item-container">
			<div class="lf-item">
			    <a href="<?php echo esc_url( $listing->get_link() ) ?>">
		            

		            <?php if ($options['background']['type'] == 'gallery' && ( $gallery = $listing->get_field( 'gallery' ) ) ): ?>
	                    <div class="owl-carousel lf-background-carousel">
		                    <?php foreach ($gallery as $gallery_image): ?>
		                        <div class="item">
		                            <div
		                                class="lf-background"
		                                style="background-image: url('<?php echo esc_url( c27()->get_resized_image( $gallery_image, 'large' ) ) ?>');">
		                            </div>
		                        </div>
		                    <?php endforeach ?>
	                    </div>
            		<?php else: $options['background']['type'] = 'image'; endif; // Fallback to cover image if no gallery images are present ?>

		            <?php if ($options['background']['type'] == 'image' && ( $cover = $listing->get_cover_image( 'large' ) ) ): ?>
		                <div
		                    class="lf-background"
		                    style="background-image: url('<?php echo esc_url( $cover ) ?>');">
		                </div>
		            <?php endif ?>

		           	
					<?php require locate_template( 'templates/single-listing/previews/partials/head-buttons.php' ) ?>
			        
		        </a>

		        <?php if ( $options['background']['type'] === 'gallery' ): ?>
					<?php require locate_template( 'templates/single-listing/previews/partials/gallery-nav.php' ) ?>
		        <?php endif ?>
			</div>
		</div>
		
	</div>

	<div class="pop-up-side">
	<div>
    

    </div>
		<div id="pic-nbr"><div id="pic-nbr-results">33</div><i class="mi photo_camera"></i></div>
		<div class="popup-grid-item">
			<a style="color:#666974;" href="<?php echo esc_url( $listing->author->get_link() ) ?>">
				<?php if ( $listing->is_verified() ): ?>
					<img class="verified-listing" style="display: inline-block;width: 17px;position: relative;top: -3px;margin-right: 7px;" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>">
				<?php endif ?>
			</a>
			<h1 id="popup-listing-title" style="display: inline;"><?php echo apply_filters( 'the_title', $listing->get_name(), $listing->get_id() ) ?></h1>					
			<div style="margin-top: 14px;border-top: 1px solid #dedee1;padding-top: 20px;border-bottom: 1px solid #dedee1">
				<?php require locate_template( 'templates/single-listing/previews/partials/info-fields.php' ) ?>
			</div>
						
			<?php mylisting_locate_template(
				'templates/single-listing/content-blocks/lists/outlined-list.php', [
				'items' => array_filter( array_map( function( $term ) {
					if ( ! $term = \MyListing\Src\Term::get( $term ) ) {
						return false;
					}

					return [
						'link' => $term->get_link(),
						'name' => $term->get_name(),
						'color' => $term->get_color(),
						'text_color' => $term->get_text_color(),
						'icon' => $term->get_icon( [ 'background' => false, 'color' => false ] ),
					];
				}, $terms ) )
			] ) ?>
	
		</div>
		
   
		<div class="pop-up-submit">
			<a href="<?php echo esc_url( $listing->get_link() ) ?>" class="buttons button-2 c27-explore-search-button" style="line-height: 1;width: calc(100% - 20px);margin: 5px 10px;text-align: center;font-size:13.7px">Voir l'annonce<i class="fa fa-arrow-right" style="font-size:14px;margin-left:10px;"></i></a>
		</div>
	</div>
	
</div>
<?php }
