<?php
/**
 * Single author template.
 *
 * @since 2.6
 */
if ( ! defined('ABSPATH') ) {
	exit;
}

get_header();
$author = new \MyListing\Src\User( get_user_by( 'slug', get_query_var( 'author_name' ) ) );
$description = $author->get_description();
$author_m24_badges = $author->get_author_m24_badges();
$premium_customer = $author->get_premium_customer();
$score_du_publicateur = $author->get_score_du_publicateur();
$background_image = $author->get_background_image();
$gallery_dimages = $author->get_gallery_dimages();
$links = $author->get_social_links();
?>

<style>
.user-profile-cover .listing-main-info {
    background: var(--accent);
}
.price-or-date .lmb-label {
    display: inline-block;
}
.user-profile-cover .listing-main-info .profile-name h1, .user-profile-cover .listing-main-info .profile-name h2 {
    color: #ffffff!important;
	margin-left: 10px;
	width: auto;
	padding-top: 0;
}
.price-or-date .value {
    font-size: 18px;
    width: auto;
    display: inline-flex;
    color: #fff;
}
.listing-main-buttons>ul>li {
    margin: 0;
}
.listing-main-buttons>ul>li:last-child {
    margin-top: 10px;
}
.lmb-calltoaction>a {
    background: #242429;
}
.listing-main-buttons {
    display: block;
    height: auto;
    min-height: auto;
    margin-top: 10px;
    margin-left: 1px;
    margin-bottom: 13px;
}
.profile-avatar {
    background: #dde5e600 50% no-repeat;
    background-size: cover;
}
.m-badge{
	width:18px;
}
</style>
<section class="user-profile-cover">
    <div class="main-info-desktop">
        <div class="container listing-main-info">
            <div class="col-md-6">
                <div class="profile-name no-tagline no-rating">
                	<?php if ( $avatar = get_avatar_url( $author->get_id() ) ): ?>
						<a
						    class="profile-avatar open-photo-swipe"
						    href="<?php echo esc_url( $avatar ) ?>"
						    style="background-image: url('<?php echo esc_url( $avatar ) ?>')"
						></a>
                	<?php endif ?>

                    <h1 class="case27-primary-text">
                        <?php echo esc_html( $author->get_display_name() ) ?>
						
						<?php if( $author_m24_badges ): ?>
									<span id="author-verificatio-badge"><img class="verified-author m-badge" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>"></span>
							<?php endif; ?>

						<ul>

							<?php if( $premium_customer ): ?>
								<li id="author-premium-badge">
									<span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
										<i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
									Professionnel vérifié</span>
								</li>
							<?php endif; ?>
							
								<li id="author-premium-badge">
									<span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
										<i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
										Succès: <?php echo esc_html( $author->get_score_du_publicateur() ) ?>%</span>
									
									<div class="container listing-main-info" alt="<?php echo $background_image['title']; ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
								</li>
							
							<?php if( $background_image ): ?>
								<li id="author-premium-badge">
									<span style="margin-top: -1px;margin-left: -7px;background: var(--accent);width: fit-content;height: 29px;color: #fff;font-weight: 600;border-radius: 5px;padding: 2px;font-size: 12px;padding-right: 7px;">
										<i style="font-size: 21px;position: relative;top: 6px;margin-left: 4px;color: #fff;margin-right: 3px;" class="mi stars"></i>
									Has BG</span>
									
									<div class="container listing-main-info" alt="<?php echo $background_image['title']; ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
								</li>
							<?php endif; ?>
							
							
						<ul>

         
						<?php if ( $author instanceof \WP_User ):
							$roles = array_filter( array_map( [ c27(), 'get_role_name' ], (array) $author->roles ) );
							?>
							<div class="auth_details" style="display: block;position: absolute;bottom: 7px;left: 83px;color: #858585;width: max-content;">
								<div class="auth_role">
									<?php if ( ! empty( $roles ) ): ?>
										<span class="auth_role"><?php echo join( ', ', $roles ) ?></span>
									<?php endif ?>
								</div>
							</div>
						<?php endif ?>



						<h2>Backgroud: <?php echo esc_html( $author->get_background_image() ) ?>%</h2>
						<h2>Gallery: <?php echo esc_html( $author->get_gallery_dimages() ) ?>%</h2>

						
						<?php if ( absint( $author->get_id() ) === absint( get_current_user_id() ) ): ?>
	                        <a
	                        	href="<?php echo esc_url( wc_get_account_endpoint_url('edit-account') ) ?>"
	                        	class="edit-listing"
	                        	data-toggle="tooltip"
	                        	data-title="<?php echo esc_attr( _x( 'Edit account', 'Author page', 'my-listing' ) ) ?>"
	                        >
	                        	<i class="mi edit"></i>
	                        </a>
                        <?php endif ?>
                    </h1>
                </div>
            </div>

            <div class="col-md-6">
			    <div class="listing-main-buttons detail-count-1">
			        <ul>
						
					<?php if ( $author_about = $author->get_description() ) : ?>
							<div class="author-bio-listing">
								<span class="verified-badge" data-toggle="tooltip" data-title="<?php echo esc_attr( _x( 'Annonce vérifié', 'Single listing', 'my-listing' ) ) ?>">
										<img style="width: 18px;position: absolute;top: -27px;z-index: 20;" class="verified-listing" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>">
								</span>
								<div style="display:none">
								<?php echo wpautop( $author_about );?>
								</div>
							</div>
						<?php endif; ?>

						
			        	<li class="price-or-date">
    	                    <div class="lmb-label">
    	                    	<?php echo esc_html( _x( 'Inscrit depuis le:', 'Author page', 'my-listing' ) ) ?>
    	                    </div>
    	                    <div class="value">
    	                    	<?php echo esc_html( date_i18n(
    	                    		get_option('date_format'),
    	                    		strtotime( $author->user_registered )
    	                    	) ) ?>
	                    	</div>
			        	</li>
			        	<?php if ( $count = count_user_posts( $author->get_id(), 'job_listing', true ) ): ?>
				        	<li class="price-or-date">
	    	                    <div class="lmb-label"><?php echo esc_html( _x( 'Annonces actives:', 'Author page', 'my-listing' ) ) ?></div>
	    	                    <div class="value"><?php echo number_format_i18n( $count ) ?></div>
				        	</li>
			        	<?php endif ?>

						<?php if ( c27()->get_setting( 'messages_enabled', true ) !== false ): ?>
							<li id="cta-549f5e" class="lmb-calltoaction">
							    <a href="#" class="cts-open-chat" data-user-id="<?php echo absint( $author->get_id() ) ?>">
							    	<i class="icon-chat-bubble-square-add"></i>
							    	<span><?php echo esc_html( _x( 'Message', 'Author page', 'my-listing' ) ) ?></span>
							    </a>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
    </div>
    <div class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-menu">
                        <ul class="cts-carousel">
                            <li class="active">
                            	<a href="#" class="profile-tab-toggle" data-section-id="listings">
                            		<?php echo esc_html( _x( 'Offres', 'Author page', 'my-listing' ) ) ?>
                            	</a>
                            </li>

                            
                            <li class="cts-prev">prev</li>
                            <li class="cts-next">next</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="tab-content listing-tabs">
    <section class="profile-body listing-tab tab-hidden" id="profile_tab_about">
        <div class="container">
            <div class="row">
            	<?php if ( $description ): ?>
                	<div class="col-md-6">
                		<div class="element content-block block-type-text">
            				<div class="pf-head">
            					<div class="title-style-1">
            						<i class="mi view_headline"></i>
            						<h5><?php echo esc_html( _x( 'About', 'Author page', 'my-listing' ) ) ?></h5>
            					</div>
            				</div>
            				<div class="pf-body">
								<p><?php echo $description ?></p>
            				</div>
                		</div>
                	</div>
            	<?php endif ?>

				<?php if ( $links ) : ?>
	            	<div class="col-md-6">
	            		<div class="element">
	        		        <div class="pf-head">
	        					<div class="title-style-1">
	        						<i class="mi view_module"></i>
	        						<h5><?php echo esc_html( _x( 'Follow', 'Author page', 'my-listing' ) ) ?></h5>
	        					</div>
	        		        </div>
	        		        <div class="pf-body">
								<?php mylisting_locate_template( 'templates/single-listing/content-blocks/lists/outlined-list.php', [
									'items' => array_map( function( $network ) {
										return [
											'name' => $network['name'],
											'icon' => sprintf( '<i class="%s"></i>', esc_attr( $network['icon'] ) ),
											'link' => $network['link'],
											'color' => $network['color'],
											'text_color' => '#fff',
											'target' => '_blank',
										];
									}, $links ) ] ) ?>
	        		        </div>
	        		    </div>
	        		</div>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section class="profile-body listing-tab tab-active" id="profile_tab_listings">
        <div class="container">
			<?php if ( have_posts() ): ?>
   				<div class="row section-body grid">
   					<?php while ( have_posts() ): the_post(); ?>
   						<?php if ( get_post_type() === 'job_listing' ): ?>
   							<?php printf(
   								'<div class="%s">%s</div>',
   								'col-md-4 col-sm-6 col-xs-12',
   								\MyListing\get_preview_card( get_the_ID() )
   							) ?>
   						<?php endif ?>
   					<?php endwhile ?>
   				</div>

   				<div class="blog-footer">
   					<div class="row project-changer">
   						<div class="text-center">
   							<?php echo paginate_links() ?>
   						</div>
   					</div>
   				</div>
			<?php else: ?>
			<div class="no-results-wrapper">
				<i class="no-results-icon mi mood_bad"></i>
				<p class="text-center">
					<?php echo esc_html( _x( "Cet utilisateur n'a pas plublié d'annonces.", 'Author page', 'my-listing' ) ) ?>
				</p>
			</div>
			<?php endif ?>
        </div>
    </section>
</div>

<?php get_footer() ?>
