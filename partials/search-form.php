<?php
/**
 * Template for rendering a basic search form widget.
 *
 * @since 1.0
 */
if ( ! defined('ABSPATH') ) {
	exit;
} ?>
<style>
/* Hide tab 5,6,7.. */
li[role="presentation"]:nth-child(n+6) {
    position: absolute;
	display: none;

}
/* place tab 5,6,7.. on tab1 when active */
li[role="presentation"]:nth-child(n+6).active {
    position: absolute;
    width: 121px;
    display: block;
	z-index: 1;
}

/* Hide jumper in tab 2,3,4 */
div#tab19190 .jumper,div#tab19189 .jumper,div#tab19191 .jumper,div#tab20790 .jumper,
div#tab21692 .jumper, div#tab21693 .jumper, div#tab21694 .jumper{
	display:none;
}

/* New icon list Hide when tab 2,3,4 */
ul.xsdf li:nth-child(2),ul.xsdf li:nth-child(3),ul.xsdf li:nth-child(4),ul.xsdf li:nth-child(5) {
	display: none;
}
/*Syle bellow*/

ul.xsdf{
    overflow-x: auto;
    overflow-y: hidden;
    display: flex;
}
ul.xsdf li {
    display: inline-flex;
    margin-right: 6px;
}
ul.xsdf li>a {
    border-radius: 8px;
    width: 75px;
    height: 40px;
}

ul.xsdf li>a:hover {
    background: #dedee1;
}
ul.xsdf li.active a {
    background: #dedee1;
}
.jumper{
    margin-top: 10px;
    margin-bottom: 5px;
	width: 100%;
	background: #fff;
}
.featured-search .fs-tabs ul li a i {
    color: #7f7f7f;
}
.featured-search .fs-tabs ul li.active a i {
    color: #f35a01;
}
.fs-tabs .nav-tabs li:nth-child(6) {
    margin-right: 10px;
}
.featured-search .fs-tabs ul li:nth-child(2) a i,.featured-search .fs-tabs ul li:nth-child(3) a i,.featured-search .fs-tabs ul li:nth-child(4) a i,.featured-search .fs-tabs ul li:nth-child(5) a i {
    display:none;
}
/*Featured search table icons*/
ul.featured-srch-table {
    width: 100%;
}
li.featured-table-content {
    width: 100%;
    display: inline-block;
    background: white;
    border: 1px solid #dedee1;
    border-radius: 8px;
    padding: 5px;
    margin: 4px;
}
li.featured-table-content:hover {
    background: #dedee1;
    border: 1px solid #dedee1;
}
li.featured-table-content>a{
	display:block;
	padding:0;
}
img.vehicules-pro-icons{
	height:40px;
}
/*Condition */
div#vehicules-pro{
	margin-top:10px;
	width: 100%;
	display:none;
	opacity:1;
}

div#tab20747 div#vehicules-pro,
div#tab21691 div#vehicules-pro{
	display: block;
}
div#tab20747 .search {
    display: block;
    width: auto;
    width: 100%;
    display: none;
}
li.featured-table-content h4 {
    font-size: 12px;
}
a.quick-search-details {
    text-align: right;
    float: right;
    font-weight: 600;
    color: #7f7f7f;
    padding-top: 15px;
    padding-bottom: 7px;
}
a.quick-search-details:hover,a.quick-search-details:active{
    color: #f35a01;
}

/*Autres Categories*/
div#autres-categories-home-jumper {
    width: 100%;
	display:none;
}

div#tab20790 div#autres-categories-home-jumper{
	display: block;
}
div#tab20790 .search {
    display: block;
    width: auto;
    width: 100%;
    display: none;
}
</style>
<div class="mylisting-basic-form text-center hide-until-load" :class="tabMode==='dark'?'featured-light':tabMode"
	data-listing-types="<?php echo esc_attr( wp_json_encode( $types_config ) ) ?>"
	data-config="<?php echo esc_attr( wp_json_encode( $config ) ) ?>"
	v-cloak>
	<div class="featured-search wide">
		<div class="fs-tabs">
			<?php if ( $config['types_display'] !== 'dropdown' ): ?>
				<ul class="nav nav-tabs cts-carousel" role="tablist" id="tab-src-home">
					<li v-for="listingType, key in types" role="presentation" :class="activeType.id===listingType.id?'active':''">
						<a role="tab" @click="activeType=listingType">
							<i :class="listingType.icon"></i>
							{{ listingType.name }}
						</a>
						
					</li>

					
				</ul>
				
			<?php endif ?>

			<div class="tab-content" :class="boxShadow?'add-box-shadow':''">
			
				<?php foreach ( $types as $key => $type ):
					$filters = $type->get_basic_filters(); ?>
					<div role="tabpanel" id="tab<?php echo $type->get_id() ?>" class="tab-pane fade in filter-count-<?php echo count($filters)+($config['types_display']==='dropdown'?2:1) ?>"
						:class="activeType.id===<?php echo $type->get_id() ?>?'active':''">

						<form method="GET">
							<div class="jumper">
								
								<ul class="xsdf" role="y">
									<li v-for="listingType, key in types" role="" :class="activeType.id===listingType.id?'active':''">
										<a id="" role="tab" @click="activeType=listingType">
											<i :class="listingType.icon"></i>
											
										</a>
									</li>

								</ul>
							</div>	
							
							<div id="vehicules-pro">
							
								<ul class="featured-srch-table">
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=caravane-camping-car-mobile-home-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('caravane-maroc.svg') ) ?>">
											<h4>Caravane, Camping-car, Mobile home</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=fourgon-fourgonnette-camion-jusqua-75t-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('van-maroc.svg') ) ?>">
											<h4>Fourgon, Fourgonnette, Camion jusqu'à 7,5t</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=camion-plus-de-75t-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('camion-icon-moteur24-maroc.svg') ) ?>">
											<h4>Camion plus de 7,5t</h4>
										</a>
										
									</li>
									
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=camion-semi-remorque-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('camion 6roues-maroc.svg') ) ?>">
											<h4>Camion semi-remorque</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=remorque-camion-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('remorque-maroc.svg') ) ?>">
											<h4>Remorque</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=camion-semi-remorque-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('semi-remorque-maroc.svg') ) ?>">
											<h4>Semi-remorque</h4>
										</a>
										
									</li>
									
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=autobus-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('tobis-maroc.svg') ) ?>">
											<h4>Autobus</h4>
										</a>
										
									</li>
									
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=machine-de-manutention-levage-cranes-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('forkleaver-maroc.svg') ) ?>">
											<h4>Manutention, levage</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=engin-de-chantier-et-de-construction-btp-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('excavator-maroc.svg') ) ?>">
											<h4>Engin de chantier</h4>
										</a>
										
									</li>
									<li class="featured-table-content">
										<a id="" href="/wordpress/annonce-maroc/?type=vehicules-professionnels&category=machinisme-agricole-au-maroc">
											<img class="vehicules-pro-icons" src="<?php echo esc_url( c27()->image('tracteur-maroc.svg') ) ?>">
											<h4>Machinisme agricole</h4>
										</a>
										
									</li>

									<a class="quick-search-details" href="annonce-maroc/?type=vehicules-professionnels">
										Recherche détaillées 
										<i aria-hidden="true" class="fas fa-angle-right" style="margin-left:10px"></i>
									</a>
									
									
									
								</ul>
							</div>
							<div id="autres-categories-home-jumper">
							
							
								<ul class="add-list-op-2">
									<li class="add-list-lvl-2">
										<a href="#" id="messages-modal-toggle" class="block-chat" data-toggle="modal" data-target="#vendre-camion-modal">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Evenements</button>
										</a>
									</li>
									<li class="add-list-lvl-2">
										<a href="#" id="messages-modal-toggle" class="block-chat" data-toggle="modal" data-target="#vendre-camion-modal">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Places</button>
										</a>
									</li>
									<li class="add-list-lvl-2">
										<a href="#" id="messages-modal-toggle" class="block-chat" data-toggle="modal" data-target="#vendre-voiture-modal">
											<button class="buttons button-2" style="width:100%;margin:5px 0;">Demandes</button>
										</a>
									</li>
									<li class="add-list-lvl-2">
										<button class="buttons button-2" style="width:100%;margin:5px 0;">Offres de travail</button>
									</li>
									
									<li class="add-list-lvl-2">
										<button class="buttons button-2" style="width:100%;margin:5px 0;">Gratuité</button>
									</li>
									
								</ul>
							</div>
							


							<?php if ( $config['types_display'] === 'dropdown' ): ?>
								<div class="form-group explore-filter md-group dropdown-filter listing-types-dropdown">
								    <select @select:change="typeDropdownChanged( $event.detail.value )" required="true" class="custom-select" ref="types-dropdown-<?php echo absint( $type->get_id() ) ?>">
								    	<option v-for="listingType, key in types" :value="key">{{ listingType.name }}</option>
								    </select>
								    <label><?php _ex( 'Listing Type', 'Basic Form > Listing types dropdown', 'my-listing' ) ?></label>
								</div>
							<?php endif ?>

							<?php foreach ( $filters as $filter ): ?>
								<?php mylisting_locate_template( sprintf( 'templates/explore/filters/%s.php', $filter->get_type() ), [
									'filter' => $filter,
									'location' => 'basic-form',
									'onchange' => 'filterChanged',
								] ) ?>
							
							<?php endforeach ?>
							
							<div class="form-group">
								<button class="buttons button-2 search" @click.prevent="submit">
									<i class="material-icons">search</i>
									<?php _e( 'Afficher', 'my-listing' ) ?>
								</button>
							</div>
							
						</form>
						
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
