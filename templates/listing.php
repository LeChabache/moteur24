<?php

global $post;

$listing = MyListing\Src\Listing::get( $post );

if ( ! $listing->type ) {
    return;
}

// Get the layout blocks for the single listing page.
$layout = $listing->type->get_layout();
$tagline = $listing->get_field( 'tagline' );

$listing_logo = $listing->get_logo( 'medium' );

if ( ! defined('ABSPATH') ) {
	exit;
}

$author = $listing->get_author();
if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
	return;
}

?>
<div class="single-job-listing <?php echo ! $listing_logo ? 'listing-no-logo' : '' ?>" id="c27-single-listing">
    <input type="hidden" id="case27-post-id" value="<?php echo esc_attr( get_the_ID() ) ?>">
    <input type="hidden" id="case27-author-id" value="<?php echo esc_attr( get_the_author_meta('ID') ) ?>">

    <!-- <section> opening tag is omitted -->
        <?php
        /**
         * Cover section.
         */
        $cover_template_path = sprintf( 'partials/single/cover/%s.php', $layout['cover']['type'] );
        if ( $cover_template = locate_template( $cover_template_path ) ) {
            require $cover_template;
        } else {
            require locate_template( 'partials/single/cover/none.php' );
        } ?>

        <div class="main-infox-desktop">
            <div class="container listing-main-info">

                <div class="col-md-6">
                    <div class="profile-name <?php echo esc_attr( $tagline ? 'has-tagline' : 'no-tagline' ) ?> <?php echo esc_attr( $listing->get_rating() ? 'has-rating' : 'no-rating' ) ?>">
                        <?php if ( $listing_logo ): ?>
                            <a
                                class="profile-avatar open-photo-swipe"
                                href="<?php echo esc_url( $listing->get_logo( 'full' ) ) ?>"
                                style="background-image: url('<?php echo esc_url( $listing_logo ) ?>')"
                            ></a>
                        <?php endif ?>
                        <div style="margin-bottom:10px;">
                            <div class="header-author-identifier">
                                <a href="<?php echo esc_url( $author->get_link() ) ?>">
                                    <div class="avatar" style="margin-bottom:5px">
                                        <img src="<?php echo esc_url( $author->get_avatar() ) ?>">
                                    </div>
                                    <div class="post-auth-name" style="color:#fff;">
                                        <?php echo esc_html( $author->get_name() ) ?>
                                        <?php 
                                        $author = $listing->get_author();
                                        if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
                                            return;
                                        }
                                        $author_m24_badges = $author->get_author_m24_badges();
                                        $premium_customer = $author->get_premium_customer();


                                        ?>


                                        <?php if( $author_m24_badges ): ?>
                                            <span id="author-verificatio-badge"><img class="verified-author m-badge" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>"></span>
                                        <?php endif; ?>
                                     
                                    </div>


                                    <?php if ( $author instanceof \WP_User ):
                                        $roles = array_filter( array_map( [ c27(), 'get_role_name' ], (array) $author->roles ) );
                                        ?>
                                        <span id="role-header">
                                                <?php if ( ! empty( $roles ) ): ?>
                                                    <span class="auth_role"><?php echo join( ', ', $roles ) ?></span>
                                                <?php endif ?>
                                        </span>
                                    <?php endif ?>


                                    
                                </a>
                                        
                            </div>
                            
                            <h1 class="case27-primary-text">
                                <?php echo $listing->get_name() ?>
                                
                                
                                <?php if ( $listing->editable_by_current_user() && function_exists( 'wc_get_account_endpoint_url' ) ):
                                    $edit_link = add_query_arg( [
                                        'action' => 'edit',
                                        'job_id' => $listing->get_id(),
                                    ], wc_get_account_endpoint_url( \MyListing\my_listings_endpoint_slug() ) );
                                    ?>
                                    <a
                                        href="<?php echo esc_url( $edit_link ) ?>"
                                        class="edit-listing"
                                        data-toggle="tooltip"
                                        data-title="<?php echo esc_attr( _x( 'Editer', 'Single listing edit link title', 'my-listing' ) ) ?>"
                                    ><i class="mi edit"></i></a>
                                <?php endif ?>
                            </h1>


                           
                            
                            <?php if ( $listing->is_verified() ): ?>
                                <div class="lf-head-btn ad-badge bdg-header-trending ad-badge-pop" data-toggle="tooltip" data-placement="right" data-original-title="3">
                                    <span style="margin-top: -1px;margin-left: -7px;background: linear-gradient(90deg, #66d7f5 0%, #39bcef 100%);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 7px;font-size: 12px;padding-right: 9px; margin-right:10px;">
                                    <img style="margin-top:-1px;margin-right:3px;width: 19px;top: 0px;" class="verified-listing" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>">
                                    Annonce vérifié</span>
                                </div>
                            <?php endif ?>
                                                        
                            <?php if( $premium_customer ): ?>
                                <a style="color:#666974;" class="showroom-badge" href="<?php echo esc_url( $listing->author->get_link() ) ?>">
                                    <div class="lf-head-btn ad-badge bdg-header-trending" data-toggle="tooltip" data-placement="bottom" data-original-title="Boutique vérifiée">
                                        <span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
                                        <i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
                                        Showroom </span>
                                    </div>
                                </a>
                            <?php endif; ?>
                                        
                            <?php if ( $listing->get_priority() == 2 ): ?>
                                
                                <div class="lf-head-btn ad-badge bdg-header-trending ad-badge-pop" data-toggle="tooltip" data-placement="right"
                                    data-original-title="3">
                                    <span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
                                    <i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
                                    Promoted</span>
                                </div>
                            <?php endif ?>


                        </div>
                        
        
                        <div class="pa-below-title" style="margin-top:2px;">
                            <?php mylisting_locate_template( 'partials/star-ratings.php', [
                                'rating' => $listing->get_rating(),
                                'max-rating' => MyListing\Ext\Reviews\Reviews::max_rating( $listing->get_id() ),
                                'class' => 'listing-rating',
                            ] ) ?>

                            <?php if ( $tagline ): ?>
                                <h2 class="profile-tagline listing-tagline-field"><?php echo esc_html( $tagline ) ?></h2>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <?php
                /**
                 * Quick actions list.
                 *
                 * @since 2.0
                 */
                require locate_template( 'templates/single-listing/cover-details.php' );
                ?>
            </div>
        </div>
    </section>
    <div class="quick-actions-in-mobile" style="position: relative;top: -70px;margin-bottom: -70px;z-index: 12;">
           
    <?php
    /**
     * Quick actions list.
     *
     * @since 2.0
     */
    require locate_template( 'templates/single-listing/quick-actions/quick-actions.php' );
    ?>

    </div> 
    
    <div class="profile-header chide-mobile" style="z-index: 11;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-menu">
                        <ul class="cts-carousel">
                        <li class="go-back">
                            <a href="javascript:history.back()"><i style="margin-right:10px;" class="fa fa-arrow-left"></i></a>
                            </li>
                            <?php
                            $i = 0;
                            $tab_ids = [];
                            foreach ((array) $layout['menu_items'] as $key => $menu_item): $i++;
                                // @todo: move logic to Listing_Type class.
                                if ( ! empty( $menu_item['slug'] ) ) {
                                    $tab_id = $menu_item['slug'];
                                } else {
                                    $tab_id = sanitize_title( $menu_item['label'] );
                                }

                                $tab_ids[ $tab_id ] = isset( $tab_ids[ $tab_id ] ) ? $tab_ids[ $tab_id ]+1 : 1;
                                if ( $tab_ids[ $tab_id ] > 1 ) {
                                    $tab_id .= '-'.$tab_ids[ $tab_id ];
                                }

                                $layout['menu_items'][$key]['slug'] = $tab_id;

                                if (
                                    $menu_item['page'] == 'bookings' &&
                                    $menu_item['provider'] == 'timekit' &&
                                    ! $listing->has_field( $menu_item['field'] )
                                ) { continue; }

                                $tab_options = [];

                                // Store tab options.
                                if ( $menu_item['page'] === 'store' ) {
                                    // Get selected products.
                                    $tab_options['products'] = isset( $menu_item['field'] ) && $listing->get_field( $menu_item['field'] )
                                        ? (array) $listing->get_field( $menu_item['field'] )
                                        : [];

                                    // hide tab if empty.
                                    if ( empty( $tab_options['products'] ) && ! empty( $menu_item['hide_if_empty'] ) && $menu_item['hide_if_empty'] === true ) {
                                        continue;
                                    }
                                }

                                // Related listings tab options.
                                if ( $menu_item['page'] === 'related_listings' ) {
                                    $tab_options['field_key'] = ! empty( $menu_item['related_listing_field'] ) ? $menu_item['related_listing_field'] : '';
                                }

                                ?><li onclick="topFunction()" id="myBtn">
                                    <a id="<?php echo esc_attr( 'listing_tab_'.$tab_id.'_toggle' ) ?>" data-section-id="<?php echo esc_attr( $tab_id ) ?>" class="listing-tab-toggle <?php echo esc_attr( "toggle-tab-type-{$menu_item['page']}" ) ?>" data-options="<?php echo c27()->encode_attr( (object) $tab_options ) ?>">
                                        <?php echo esc_html( $menu_item['label'] ) ?>

                                        <?php if ($menu_item['page'] == 'comments'): ?>
                                            <span class="items-counter"><?php echo $listing->get_review_count() ?></span>
                                        <?php endif ?>

                                        <?php if ( $menu_item['page'] === 'related_listings' ): ?>
                                            <span class="items-counter hide"></span>
                                            <span class="c27-tab-spinner tab-spinner">
                                                <i class="fa fa-circle-o-notch fa-spin"></i>
                                            </span>
                                        <?php endif ?>

                                        <?php if ( $menu_item['page'] === 'store' ): ?>
                                            <span class="items-counter"><?php echo number_format_i18n( count( $tab_options['products'] ) ) ?></span>
                                        <?php endif ?>
                                    </a>
                                </li><?php
                            endforeach; ?>

                            <li class="cts-prev">prev</li>
                            <li class="cts-next">next</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="main-infox-mobile">
        <?php // .listing-main-info is moved here in mobile using JS ?>
    </div>
    
    <?php if ( ! empty( $_GET['review-submitted'] ) ): ?>
	    <div class="container listing-notifications">
	    	<div class="row">
	    		<div class="col-md-12">
					<div class="woocommerce-message" role="alert">
						<?php echo esc_html( __( 'Your review has been submitted.', 'my-listing' ) ) ?>
						<a href="#" class="button wc-forward hide-notification"><?php _e( 'Close', 'my-listing' ) ?></a>
					</div>
				</div>
	    	</div>
	    </div>
    <?php endif ?>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

    <div class="tab-content listing-tabs">
        
    
        <?php foreach ((array) $layout['menu_items'] as $key => $menu_item): ?>
            <section class="profile-body listing-tab tab-hidden <?php echo esc_attr( "tab-type-{$menu_item['page']}" ) ?> <?php echo esc_attr( sprintf( 'tab-layout-%s', ! empty( $menu_item['template'] ) ? $menu_item['template'] : 'masonry' ) ) ?> pre-init" id="listing_tab_<?php echo esc_attr( $menu_item['slug'] ) ?>">

                <?php if ($menu_item['page'] == 'main' || $menu_item['page'] == 'custom'):
                    if ( empty( $menu_item['template'] ) ) {
                        $menu_item['template'] = 'masonry';
                    }

                    if ( empty( $menu_item['layout'] ) ) {
                        $menu_item['layout'] = [];
                    }

                    if ( empty( $menu_item['sidebar'] ) ) {
                        $menu_item['sidebar'] = [];
                    }

                    // Column settings for each page template.
                    if ( $menu_item['template'] == 'two-columns' ) {
                        $columns = [
                            'main-col-wrap' => '<div class="col-md-6"><div class="row cts-column-wrapper cts-main-column">',
                            'main-col-end'  => '</div></div>',
                            'side-col-wrap' => '<div class="col-md-6"><div class="row cts-column-wrapper cts-side-column">',
                            'side-col-end'  => '</div></div>',
                            'block-class'   => 'col-md-12',
                        ];
                    } elseif ( $menu_item['template'] == 'full-width' ) {
                        $columns = [
                            'main-col-wrap' => '',
                            'main-col-end'  => '',
                            'side-col-wrap' => '',
                            'side-col-end'  => '',
                            'block-class'   => 'col-md-12',
                        ];
                    } elseif ( in_array( $menu_item['template'], ['content-sidebar', 'sidebar-content'] ) ) {
                        $columns = [
                            'main-col-wrap' => '<div class="col-md-%d"><div class="row cts-column-wrapper cts-left-column">',
                            'main-col-end'  => '</div></div>',
                            'side-col-wrap' => '<div class="col-md-%d"><div class="row cts-column-wrapper cts-right-column">',
                            'side-col-end'  => '</div></div>',
                            'block-class'   => 'col-md-12',
                        ];

                        $columns['main-col-wrap'] = sprintf( $columns['main-col-wrap'], $menu_item['template'] === 'content-sidebar' ? 7 : 5 );
                        $columns['side-col-wrap'] = sprintf( $columns['side-col-wrap'], $menu_item['template'] === 'content-sidebar' ? 5 : 7 );
                    } else {
                        // Masonry.
                        $columns = [
                            'main-col-wrap' => '',
                            'main-col-end'  => '',
                            'side-col-wrap' => '',
                            'side-col-end'  => '',
                            'block-class'   => 'col-md-6 col-sm-12 col-xs-12 grid-item',
                        ];
                    }

                    // For templates with two columns, merge the other column items into the main column.
                    // And divide them with an 'endcolumn' array item, which will later be used to contruct columns.
                    if ( in_array( $menu_item['template'], ['two-columns', 'content-sidebar', 'sidebar-content'] ) ) {
                        $first_col = $menu_item['template'] === 'sidebar-content' ? 'sidebar' : 'layout';
                        $second_col = $first_col === 'layout' ? 'sidebar' : 'layout';

                        $menu_item[ 'layout' ] = array_merge( $menu_item[ $first_col ], ['endcolumn'], $menu_item[ $second_col ] );
                    }
                    ?>

                    <div class="container <?php printf( 'tab-template-%s', $menu_item['template'] ) ?>">
                        <div class="row <?php echo $menu_item['template'] == 'masonry' ? 'listing-tab-grid' : '' ?>">

                            <?php echo $columns['main-col-wrap'] ?>

                            <?php foreach ( $menu_item['layout'] as $block ):
                                if ( $block === 'endcolumn' ) {
                                    echo $columns['main-col-end'];
                                    echo $columns['side-col-wrap'];
                                    $columns['main-col-end'] = $columns['side-col-end'];
                                    continue;
                                }

                                if ( empty( $block['type'] ) ) {
                                    $block['type'] = 'default';
                                }

                                if ( empty( $block['id'] ) ) {
                                    $block['id'] = '';
                                }

                                // Default block icons used on previous versions didn't include the icon pack name.
                                // Since they were all material icons, we just add the "mi" prefix to them.
                                $default_icons = ['view_headline', 'insert_photo', 'view_module', 'map', 'email', 'layers', 'av_timer', 'attach_file', 'alarm', 'videocam', 'account_circle'];
                                if ( ! empty( $block['icon'] ) && in_array( $block['icon'], $default_icons ) ) {
                                    $block['icon'] = sprintf( 'mi %s', $block['icon'] );
                                }

                                $block->add_wrapper_classes( $columns['block-class'] );
                                $block->set_listing( $listing );

                                $block_wrapper_class = $columns['block-class'];
                                $block_wrapper_class .= ' block-type-' . esc_attr( $block['type'] );

                                if ( ! empty( $block['show_field'] ) ) {
                                    $block_wrapper_class .= ' block-field-' . esc_attr( $block['show_field'] );
                                }

                                if ( ! empty( $block['class'] ) ) {
                                    $block_wrapper_class .= ' ' . esc_attr( $block['class'] );
                                }

                                // Get the block value if available.
                                if ( ! empty( $block['show_field'] ) && $listing->has_field( $block['show_field'] ) && ( $field = $listing->get_field( $block['show_field'], true ) ) ) {
                                    $block_content = $field->get_value();
                                } else {
                                    $block_content = false;
                                    $field = false;
                                }

                                // content block location path
                                $template_base = 'templates/single-listing/content-blocks/%s-block.php';

                                // first check if there's a template with the block type in it's name
                                if ( $template = locate_template( sprintf( $template_base, $block->get_type() ) ) ) {
                                    require $template;

                                // some block's type contains underscores; to keep consistency in file naming, support hyphenated versions too
                                } elseif ( $template = locate_template( sprintf( $template_base, str_replace( '_', '-', $block->get_type() ) ) ) ) {
                                    require $template;
                                }

                            endforeach ?>

                            <?php echo $columns['main-col-end'] ?>

                        </div>
                    </div>
                <?php endif ?>

                <?php if ($menu_item['page'] == 'comments'): ?>
                    <div>
                        <?php comments_template() ?>
                    </div>
                <?php endif ?>

                <?php if ($menu_item['page'] == 'related_listings'): ?>
                    <?php require locate_template( 'templates/single-listing/tabs/related-listings.php' ) ?>
                <?php endif ?>

                <?php if ($menu_item['page'] == 'store'): ?>
                    <?php require locate_template( 'templates/single-listing/tabs/store.php' ) ?>
                <?php endif ?>

                <?php if ($menu_item['page'] == 'bookings'): ?>
                    <?php require locate_template( 'templates/single-listing/tabs/bookings.php' ) ?>
                <?php endif ?>

            </section>
        <?php endforeach; ?>
    </div>

    <?php
    /**
     * Similar listings section.
     *
     * @since 2.0
     */
    if ( $layout['similar_listings']['enabled'] && apply_filters( 'mylisting/single/show-similar-listings', true ) !== false ) {
        require locate_template( 'templates/single-listing/similar-listings.php' );
    } ?>

</div>

<style>

#vendre-en-ligne .details-block-content>li>i {
    display: none;
}
#vendre-en-ligne .details-block-content>li {
    display: block;
}
#vendre-en-ligne .element {
    background: #8bc34a;
    border: 1px solid #8bc34a;
    box-shadow: 0 2px 4px rgb(45 47 59 / 12%);
    border-radius: 8px;
}
/*vendre en ligne bloack end */
.single .quick-listing-actions .cts-next, .quick-listing-actions .cts-prev {
    margin: 0;
    padding-left: 25px;
    padding-right: 0;
    background-image: -webkit-gradient(linear,left top, right top,from(hsla(0,0%,100%,0)),color-stop(80%, #07090e));
    background-image: linear-gradient(90deg,hsla(0,0%,100%,0),#07090e 80%);
}
.single .profile-name i.mi.star.empty {
    color: #adadad38!important;
}
.single .profile-name .ad-badge {
    margin-top: 10px;
}
.single .single-listing .verified-listing {
    max-height: 19px!importnt;
    top: -1px!important;
}
.single i.fa.fa-times {
    color: #f44336!important;
}
.single i.fa.fa-info {
    color: #ff9800!important;
}
@media only screen and (max-width: 1200px){
.profile-name.no-tagline {
    padding-top: 0;
    padding-bottom: 0px;
}

.single .header-dark-skin .search-trigger a, .single .header-dark-skin .inbox-actions .block-chat {
    background: #00000000;
}
.single i.fa.fa-plus {
    color: #fff!important;
}
.single .header-scroll-active i.fa.fa-plus, .single .header-scroll-active i.mi.forum {
    color: #242429!important;
}

.single .logox {
    display: none!important;
}

.single .header-scroll-active .logo {
    display: flex!important;
}

.single .price-or-date .lmb-label {
    display: none;
}
.single .price-or-date .value {
    font-size: 18px;
    font-weight: 500;
    color: #fff5ef;
}
.single .price-or-date span.suffix {
    font-size: 13px;
    color: #b1b1b1;
}
ul>.price-or-date:nth-child(2) .value {
    font-size: 13px;
    position: relative;
    top: 5px;
    color: #9d9d9d;
}
li.lmb-calltoaction {
    display: none;
}
}
.quick-listing-actions {
    margin-top: 17px;
}
section.featured-section.profile-cover.profile-cover-image.hide-until-load {
    padding-bottom: 33vh!important;
}
.profile-name h1 {
    font-size: 28px;
}
.price-or-date .value {
    text-transform: capitalize;
}

li.lmb-calltoaction {
    display: none;
}
.single-job_listing .profile-name .edit-listing i {
    color: #f58509;
    border-color: #bac1c1;
    top: -2px;
}
.field-type-radio .md-checkbox:first-child {
    display: none;
}
@media only screen and (max-width: 1200px){

.main-infox-desktop {
    position: relative;
    height: 100%;
    top: 60px;
}
.listing-main-info {
    position: relative;
    background: #fff0;
    top: 0px;
    left: 0;
    margin-bottom: 0px;
    padding-bottom: 15px;
}
section.featured-section.profile-cover.profile-cover-image.hide-until-load {
    padding-bottom: 85px!important;
}}
.listing-main-info {
    margin-bottom: 30px;
}
.single .post-auth-name:hover,
.single .post-auth-name:active {
    text-decoration: underline;
}

.single .post-auth-name {
    position: absolute;
    top: 10px;
    left: 60px;
}
.single .avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
}
</style>

<script>
// Output media nbr
window.addEventListener('load', function () {
    var x = document.querySelectorAll('.photoswipe-gallery .owl-item').length;
    document.getElementById('nbr-of-media').innerHTML = (x);
    })


//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>


<script>
    window.addEventListener('load', function () {
    let x = document.getElementById("success-meter").innerHTML;
    document.getElementById("success-meter").innerHTML = 10 * x + "%";
})
</script>