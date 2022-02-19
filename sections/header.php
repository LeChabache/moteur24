<?php
$data = c27()->merge_options([
	'logo'                    => c27()->get_site_logo(),
    'skin'                    => c27()->get_setting('header_skin', 'dark'),
    'style'                   => c27()->get_setting('header_style', 'default'),
	'fixed'                   => c27()->get_setting('header_fixed', true),
    'scroll_skin'             => c27()->get_setting('header_scroll_skin', 'dark'),
    'scroll_logo'             => c27()->get_setting('header_scroll_logo') ? c27()->get_setting('header_scroll_logo')['sizes']['medium'] : false,
	'border_color'            => c27()->get_setting('header_border_color', 'rgba(29, 29, 31, 0.95)'),
	'menu_location'           => c27()->get_setting('header_menu_location', 'right'),
	'background_color'        => c27()->get_setting('header_background_color', 'rgba(29, 29, 31, 0.95)'),
	'show_search_form'        => c27()->get_setting('header_show_search_form', true),
	'show_call_to_action'     => c27()->get_setting('header_show_call_to_action_button', false),
	'scroll_border_color'     => c27()->get_setting('header_scroll_border_color', 'rgba(29, 29, 31, 0.95)'),
	'search_form_placeholder' => c27()->get_setting('header_search_form_placeholder', 'Type your search...'),
	'scroll_background_color' => c27()->get_setting('header_scroll_background_color', 'rgba(29, 29, 31, 0.95)'),
	'blend_to_next_section'   => false,
    'is_edit_mode'            => false,
], $data);

$header_classes = ['c27-main-header', 'header', "header-style-{$data['style']}", "header-{$data['skin']}-skin", "header-scroll-{$data['scroll_skin']}-skin", 'hide-until-load', 'header-scroll-hide'];

if ( $data['fixed'] ) {
	$header_classes[] = 'header-fixed';
}

$header_classes[] = sprintf( 'header-menu-%s', $data['menu_location'] === 'right' ? 'right' : 'left' );

$GLOBALS['case27_custom_styles'] .= '.c27-main-header .logo img { height: ' . c27()->get_setting( 'header_logo_height', 38 ) . 'px; }';
$GLOBALS['case27_custom_styles'] .= '@media screen and (max-width: 1200px) { .c27-main-header .logo img { height: ' . c27()->get_setting( 'header_logo_height_tablet', 50 ) . 'px; } }';
$GLOBALS['case27_custom_styles'] .= '@media screen and (max-width: 480px) { .c27-main-header .logo img { height: ' . c27()->get_setting( 'header_logo_height_mobile', 40 ) . 'px; } }';

if ($data['background_color']) {
	if (!isset($GLOBALS['case27_custom_styles'])) $GLOBALS['case27_custom_styles'] = '';

	$GLOBALS['case27_custom_styles'] .= '.c27-main-header:not(.header-scroll) .header-skin ';
	$GLOBALS['case27_custom_styles'] .= '{ background: ' . $data['background_color'] . ' }';
}

if ($data['border_color']) {
	if (!isset($GLOBALS['case27_custom_styles'])) $GLOBALS['case27_custom_styles'] = '';

	$GLOBALS['case27_custom_styles'] .= '.c27-main-header:not(.header-scroll) .header-skin { border-bottom: 1px solid ' . $data['border_color'] . ' } ';
}

if ($data['scroll_background_color']) {
	if (!isset($GLOBALS['case27_custom_styles'])) $GLOBALS['case27_custom_styles'] = '';

	$GLOBALS['case27_custom_styles'] .= '.c27-main-header.header-scroll .header-skin';
	$GLOBALS['case27_custom_styles'] .= '{ background: ' . $data['scroll_background_color'] . ' !important; }';
}

if ($data['scroll_border_color']) {
	if (!isset($GLOBALS['case27_custom_styles'])) $GLOBALS['case27_custom_styles'] = '';

	$GLOBALS['case27_custom_styles'] .= '.c27-main-header.header-scroll .header-skin { border-bottom: 1px solid ' . $data['scroll_border_color'] . ' !important; } ';
}
?>

<header class="<?php echo esc_attr( join( ' ', $header_classes ) ) ?>">
	<div class="header-skin"></div>
	
	<div class="header-container">
		<div class="header-top container-fluid">
			<div class="header-left">
			<div class="mobile-menu">
				<a href="#main-menu">
					<div class="mobile-menu-lines"><i class="mi menu"></i></div>
				</a>
			</div>
			<div class="logo">
				<?php if ( $data['logo'] ): ?>
					<?php if ( $data['scroll_logo'] ): ?>
						<a href="<?php echo esc_url( home_url('/') ) ?>" class="scroll-logo">
							<img src="<?php echo esc_url( $data['scroll_logo'] ) ?>"
								alt="<?php echo esc_attr( c27()->get_site_logo_alt_text() ) ?>">
						</a>
					<?php endif ?>

					<a href="<?php echo esc_url( home_url('/') ) ?>" class="static-logo">
						<img src="<?php echo esc_url( $data['logo'] ) ?>"
							alt="<?php echo esc_attr( c27()->get_site_logo_alt_text() ) ?>">
					</a>
				<?php else: ?>
					<a href="<?php echo esc_url( home_url('/') ) ?>" class="header-logo-text">
						<?php echo esc_attr( get_bloginfo('sitename') ) ?>
					</a>
				<?php endif ?>
			</div>
			<?php if ( $data['show_search_form'] ): ?>
				<?php c27()->get_partial( 'quick-search', [
					'instance-id' => 'c27-header-search-form',
					'placeholder' => $data['search_form_placeholder'],
					'align' => 'left',
				] ) ?>

				<?php add_action( 'mylisting/get-footer', function() use ( $data ) { ?>
					<div id="quicksearch-mobile-modal" class="modal modal-27">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<?php c27()->get_partial( 'quick-search', [
									'instance-id' => 'quicksearch-mobile',
									'placeholder' => $data['search_form_placeholder'],
									'align' => 'left',
									'focus' => 'always',
								] ) ?>
							</div>
						</div>
					</div>
				<?php } ) ?>
			<?php endif ?>
			</div>
			<div class="header-center">
			<div class="i-nav">
				<div class="mobile-nav-head">
					<div class="mnh-close-icon">
						<a href="#close-main-menu">
							<i class="mi close"></i>
						</a>
					</div>

					<?php if ( is_user_logged_in() ): $current_user = wp_get_current_user(); ?>
						<div class="user-profile-dropdown">
							<a class="user-profile-name" href="#">
								<div class="avatar">
									<?php echo get_avatar( $current_user->ID ) ?>
								</div>
								<?php echo esc_html( $current_user->display_name ) ?>
								<?php if ( class_exists('WooCommerce') ): ?>
									<div class="submenu-toggle"><i class="mi arrow_drop_down"></i></div>
								<?php endif; ?>
							</a>
						</div>
					<?php endif ?>
				</div>

				<?php if ( is_user_logged_in() ): ?>
					<div class="mobile-user-menu">
						<?php if ( has_nav_menu( 'mylisting-user-menu' ) ) : ?>
							<?php wp_nav_menu( [
								'theme_location' => 'mylisting-user-menu',
								'container' 	 => false,
								'depth'     	 => 0,
								'menu_class'	 => '',
								'items_wrap' 	 => '<ul class="%2$s">%3$s</ul>'
							] ) ?>
							<?php elseif ( class_exists( 'WooCommerce' ) ) : ?>
								<ul>
									<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
										<?php do_action( "case27/user-menu/{$endpoint}/before" ) ?>
										<li class="user-menu-<?php echo esc_attr( $endpoint ) ?>">
											<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
										</li>
										<?php do_action( "case27/user-menu/{$endpoint}/after" ) ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php endif ?>

					<?php echo str_replace(
						'<ul class="sub-menu"',
						'<div class="submenu-toggle"><i class="material-icons">arrow_drop_down</i></div><ul class="sub-menu i-dropdown"',
						wp_nav_menu( [
							'echo' => false,
							'theme_location' => 'primary',
							'container' => false,
							'menu_class' => 'main-menu',
							'items_wrap' => '<ul id="%1$s" class="%2$s main-nav">%3$s</ul>'
						]
					) ) ?>

					<div class="mobile-nav-button">
						<?php require locate_template( 'partials/header/call-to-action.php' ) ?>
					</div>
				</div>
				<div class="i-nav-overlay"></div>
				</div>
			<div class="header-right">
					
				<div class="addlisting-header-cta" style="margin-right:0px;">
					<a href="#" id="messages-modal-toggle" class="" data-toggle="modal" data-target="#mlx-messages-modal">
						<i class="fa fa-plus"></i>
					</a>
				</div>

				<div id="mlx-messages-modal" class="modal modal-27" role="dialog" style="height:100vh;width:100vw;margin: 0!important;">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							
							<div id="addlisting-tab1" class="sign-in-box" style="text-align:center;">
								<h4>Ajouter une Annonce</h4>
								<ul class="add-list-op">
									<li class="add-list-lvl-1" style="margin-bottom:15px;" >Choisissez une catégorie </li>
									
									<li class="add-list-lvl-1">
										<a href="#" id="messages-modal-toggle" class="block-chat" data-toggle="modal" data-target="#vendre-modal">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Vendre</button>
										</a>
									</li>
									<li class="add-list-lvl-1">
										<a href="/wordpress/add-a-listing/?listing_type=location-covoiturage">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Louer</button>
										</a>
									</li>
									<li class="add-list-lvl-1">
										<a href="/wordpress/add-a-listing/?listing_type=services">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Travailler</button>
										</a>
									</li>
									
									<li class="add-list-lvl-1" style="margin-top:20px;">Terms et conditions</li>
								</ul>
								
								
							</div>
						</div>
					</div>
				</div>

				
				<div id="vendre-modal" class="modal modal-27" role="dialog" style="height:100vh;width:100vw;margin: 0!important;">
					<div class="modal-dialog modal-md">
						<div class="modal-content" style="min-height: 50vh;padding: 20px;">			
							<div id="addlisting-tab2" class="sign-in-box" role="dialog" style="text-align:center;display: contents;">
								<h4 style="color:#f35a02">Voulez-vous Vendre?</h4>
								
								<ul class="add-list-op-2" style="margin-bottom:60px;">
									<li class="add-list-lvl-2">
									<p>Tip: 90% des annonces avec an moins 12 photos trouvent un acheteur en moins de 7jours!</p>
									<div class="explore-head fv">
										<div class="explore-types ctscarousel" style="margin-top:20px">
											<div class="finder-title">
												<h2 class="case27-primary-text">Voiture et location au maroc</h2>
											</div> 
											<div class="type-vehicules item">
											
												<a href="/wordpress/add-a-listing/?listing_type=automobiles">
													
													<div class="type-info">
														<i style="width:60px;" class="fa fa-car"></i> 
														<h4>Une Voitures</h4>
													</div>
												</a>
											</div> 
											<div class="type-motos item">
												<a href="/wordpress/add-a-listing/?listing_type=motos">
													<div class="type-info">
														<i style="width:60px;" class="fa fa-motorcycle"></i> 
														<h4>Une Motos</h4>
													</div>
												</a>
											</div>
											<div class="type-vehicules-professionnels item">
												<a href="/wordpress/add-a-listing/?listing_type=vehicules-professionnels">
													<div class="type-info">
														<i style="width:60px;" class="fa fa-bus"></i> 
														<h4>Un Véhicule Pro.</h4>
													</div>
												</a>
											</div> 
											<div class="type-pieces-auto item">
												<a href="/wordpress/add-a-listing/?listing_type=pieces-auto">
													<div class="type-info">
														<i style="width:60px;" class="icon-spray-bottle"></i> 
														<h4>Une Pièce ou Accessoire</h4>
													</div>
												</a>
											</div> 
											<div class="type-services item">
												<a href="/wordpress/add-a-listing/?listing_type=services">
													<div class="type-info">
														<i style="width:60px;" class="mi warning"></i> 
														<h4>Un Service</h4>
													</div>
												</a>
											</div> 
											
											<div dir="ltr" class="resize-sensor" style="position: absolute; inset: -10px 0px 0px -10px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;">
												<div class="resize-sensor-expand" style="position: absolute; left: -10px; top: -10px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%">
													<div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 100000px; height: 100000px;"></div>
												</div>
												<div class="resize-sensor-shrink" style="position: absolute; left: -10px; top: -10px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%">
													<div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
												</div>
											</div>
										</div>
									</div>	
								</li>	
								</ul>
								<a class="cd-pop" data-dismiss="modal" aria-label="Close">
								<span class="addlisting-goback" aria-hidden="true"><i class="fa fa-arrow-left"></i> Retour</span>
								</a>
								
							</div>
						</div>
					</div>
				</div>
				
				<div id="vendre-voiture-modal" class="modal modal-27" role="dialog" style="height:100vh;width:100vw;margin: 0!important;">
					<div class="modal-dialog modal-md">
						<div class="modal-content">			
							<div id="addlisting-tab3" class="sign-in-box" role="dialog" style="text-align:center">
								<i class="fa fa-car"></i>
								<h4>Vendre une Voiture</h4>
								<p>Tip: 90% des annonces avec an moins 12 photos et détails complèts trouve un acheteur en moins de 7jours!</p>
								<ul class="add-list-op-2">
									<li class="add-list-lvl-2">
										<a href="/wordpress/add-a-listing/?listing_type=vehicules">
											<button class="buttons button-2 right" style="width:100%;margin:5px;">Commencer<i class="fa fa-arrow-right"></i> </button>
										</a>
									</li>		
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div id="vendre-moto-modal" class="modal modal-27" role="dialog" style="height:100vh;width:100vw;margin: 0!important;">
					<div class="modal-dialog modal-md">
						<div class="modal-content">			
							<div id="addlisting-tab3" class="sign-in-box" role="dialog" style="text-align:center">
								<i class="fa fa-motorcycle"></i>
								<h4>Vendre une Moto</h4>
								<p>Tip: 90% des annonces avec an moins 12 photos et détails complèts trouve un acheteur en moins de 7jours!</p>
								<ul class="add-list-op-2">
									<li class="add-list-lvl-2">
										<a href="/wordpress/add-a-listing/?listing_type=motos">
											<button class="buttons button-2 right" style="width:100%;margin:5px;">Commencer<i class="fa fa-arrow-right"></i> </button>
										</a>
									</li>		
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div id="vendre-camion-modal" class="modal modal-27" role="dialog" style="height:100vh;width:100vw;margin: 0!important;">
					<div class="modal-dialog modal-md">
						<div class="modal-content">			
							<div id="addlisting-tab3" class="sign-in-box" role="dialog" style="text-align:center">
								<i class="fa fa-bus"></i>
								
								<h4>Vendre un Vehicule Professionnel</h4>
								<p>Tip: 90% des annonces avec an moins 12 photos et détails complèts trouve un acheteur en moins de 7jours!</p>
								<ul class="add-list-op-2">
									<li class="add-list-lvl-2">
										<a href="/wordpress/add-a-listing/?listing_type=vehicules-professionnels">
											<button class="buttons button-2 right" style="width:100%;margin:5px;">Commencer<i class="fa fa-arrow-right"></i> </button>
										</a>
									</li>		
								</ul>
							</div>
						</div>
					</div>
				</div>

				<?php if ( is_user_logged_in() ): $current_user = wp_get_current_user(); ?>
					<div class="user-area">
						<div class="user-profile-dropdown dropdown">
							<a class="user-profile-name" href="#" type="button" id="user-dropdown-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<div class="avatar">
									<?php echo get_avatar( $current_user->ID ) ?>
								</div>
								<?php echo esc_attr( $current_user->display_name ) ?>
								<?php if ( class_exists('WooCommerce') ): ?>
									<div class="submenu-toggle"><i class="material-icons">arrow_drop_down</i></div>
								<?php endif; ?>
							</a>

							<?php if ( has_nav_menu( 'mylisting-user-menu' ) ) : ?>
								<?php wp_nav_menu([
								    'theme_location' => 'mylisting-user-menu',
								    'container' 	 => false,
								    'depth'     	 => 0,
								    'menu_class'	 => 'i-dropdown dropdown-menu',
								    'items_wrap' 	 => '<ul class="%2$s" aria-labelledby="user-dropdown-menu">%3$s</ul>'
								    ]); ?>
							<?php elseif ( class_exists('WooCommerce') ) : ?>
								<ul class="i-dropdown dropdown-menu" aria-labelledby="user-dropdown-menu">
									<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
										<?php do_action( "case27/user-menu/{$endpoint}/before" ) ?>
										<li class="user-menu-<?php echo esc_attr( $endpoint ) ?>">
											<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
										</li>
										<?php do_action( "case27/user-menu/{$endpoint}/after" ) ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>

						<?php if ( c27()->get_setting( 'header_show_cart', true ) !== false ): ?>
							<?php c27()->get_partial( 'header-cart' ) ?>
						<?php endif ?>
						
						<?php if ( c27()->get_setting( 'messages_enabled', true ) !== false ): ?>
							<div class="messaging-center inbox-header-icon inbox-actions" style="margin-right:0px;">
								<a href="#" id="messages-modal-toggle" class="block-chat" data-toggle="modal" data-target="#ml-messages-modal">
									<i class="mi forum"></i>
									<div class="chat-counter-container" id="ml-chat-activities"></div>
								</a>
							</div>
						<?php endif ?>

					</div>
				<?php else: ?>
					<div class="user-area signin-area">
						
						<a href="<?php echo esc_url( \MyListing\get_login_url() ) ?>">
							<?php _e( 'Se connecter', 'my-listing' ) ?>
						</a>
					</div>
					<div class="user-area signin-area">
						
						<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ): ?>
							<a href="<?php echo esc_url( \MyListing\get_register_url() ) ?>">
								<?php _e( "S'enregistrer", 'my-listing' ) ?>
							</a>
						<?php endif ?>
					</div>
					<div class="mob-sign-in">
						<a href="<?php echo esc_url( \MyListing\get_login_url() ) ?>"><i class="mi person"></i></a>
					</div>

					<?php if ( c27()->get_setting( 'header_show_cart', true ) !== false ): ?>
						<?php c27()->get_partial( 'header-cart' ) ?>
					<?php endif ?>
				<?php endif ?>

				<?php require locate_template( 'partials/header/call-to-action.php' ) ?>

				<?php if ( $data['show_search_form'] ): ?>
					<div class="search-trigger" data-toggle="modal" data-target="#quicksearch-mobile-modal">
						<a href="#"><i class="mi search"></i></a>
					</div>
				<?php endif ?>
				
			</div>
		</div>
	</div>
</header>

<?php if ( ! $data['blend_to_next_section'] ): ?>
	<div class="c27-top-content-margin"></div>
<?php endif ?>

<?php if ( $data['is_edit_mode'] ): ?>
    <script type="text/javascript">case27_ready_script(jQuery);</script>
<?php endif ?>

<style>
span.addlisting-goback{
	color: #606060;
}
a.cd-pop {
    display: block;
    padding: 9px;
    cursor: pointer;
    width: 100%;
    background: #00000021;
    height: 38px;
    border-radius: 5px;
    margin-bottom: 10px;
    position: absolute;
    bottom: 10px;
    width: calc(100% - 40px);
}
a.cd-pop:active {
    background: #ccc;
}
a.cd-pop i.fa-arrow-left {
    position: relative;
    left: -10px;
}
.buttons.button-2.right i{
    float: right;
}

.addlisting-header-cta a {
    background: #fff0;
    width: 40px;
    height: 40px;
    border-radius: 50px;
    display: inline-block;
    text-align: center;
    padding: 10px;
}
.addlisting-header-cta a:active {
    background: black;
    
}
.header.header-menu-left .header-center {
    -webkit-box-pack: start;
    justify-content: flex-start;
    margin-left: 15px;
}
.mob-sign-in {
    padding-left: 10px;
	padding-right: 20px;
}
.inbox-actions .block-chat {
    margin-right: 20px!important;
    margin-left: 10px!important;
    float: right;
}
.header-container .modal-27:nth-child(3) {
    background: none;
}


/**Explore head  */
.explore-head.fv .explore-types>div>a {
    position: relative;
    bottom: -9px;
    color: #fff;
    background: #dedede;
    border-radius: 8px;
    margin-right: 20px;
}

.explore-head.fv .explore-types>div>a:focus-within {
    position: relative;
    bottom: -9px;
    color: #fff;
    background: #242429;
    border-radius: 8px;
    margin-right: 20px;
	color: #f35a01;
}

.explore-head.fv .explore-types>div>a:active i:before {
    filter:none;
}
.spin-box.bxn.light{
    display: inline-block;
    height: 20px!important;
    width: 20px!important;
    background: transparent;
    border-top: 3px solid #777;
    border-right: 3px solid #fff0;
    border-bottom: 3px solid #777;
    border-left: 3px solid #777;
    margin-bottom: -5px;
    margin-right: 5px;
}
.explore-types.ctscarousel {
    display: block;
    height: auto;
    max-height: 70vh;
    overflow-y: scroll;
}
.explore-types.ctscarousel .item {
    margin: 10px;
}
a.cd-pop:active {
    background: #f35a01;
}
a.cd-pop:active span.addlisting-goback {
    color: #ffffff;
}
</style>