<?php
/**
 * Display stats for a single listing in user dashboard.
 *
 * @since 2.0
 */
if ( ! defined('ABSPATH') ) {
	exit;
}

// Get selected listing stats.
$stats = mylisting()->stats()->get_listing_stats( $listing->get_id() );
?>

<div class="row">
	<div class="col-md-9 mlduo-welcome-message">
		<h1>
			<?php printf(
				_x( '"%s" &mdash; Statistics', 'User dashboard', 'my-listing' ),
				$listing->get_name()
			) ?>
		</h1>
	</div>
	<div class="col-md-3">
		<?php require locate_template( 'templates/dashboard/stats/select-listing.php' ) ?>
	</div>
</div>


<div class="row">
	<div class="col-md-4">
		<?php if ( mylisting()->get( 'stats.show_views' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/views.php' ) ?>
		<?php endif ?>

		<?php if ( mylisting()->get( 'stats.show_uviews' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/unique-views.php' ) ?>
		<?php endif ?>

		<?php if ( mylisting()->get( 'stats.show_devices' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/devices.php' ) ?>
		<?php endif ?>

		<?php if ( mylisting()->get( 'stats.show_countries' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/countries.php' ) ?>
		<?php endif ?>
	</div>

	<div class="col-md-8">
		<?php if ( mylisting()->get( 'stats.enable_chart' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/visits-chart.php' ) ?>
		<?php endif ?>

		<?php if ( mylisting()->get( 'stats.show_referrers' ) !== false ): ?>
			<?php require locate_template( 'templates/dashboard/stats/widgets/referrers.php' ) ?>
		<?php endif ?>

		<div class="row custom-row">
			<?php if ( mylisting()->get( 'stats.show_platforms' ) !== false ): ?>
				<div class="col-md-6">
					<?php require locate_template( 'templates/dashboard/stats/widgets/platforms.php' ) ?>
				</div>
			<?php endif ?>

			<?php if ( mylisting()->get( 'stats.show_browsers' ) !== false ): ?>
				<div class="col-md-6">
					<?php require locate_template( 'templates/dashboard/stats/widgets/browsers.php' ) ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>
<style>
.mlduo-welcome-message h1 {
    font-size: 29px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
@media (max-width: 992px){
.mlduo-welcome-message h1 {
    font-size: 18px!important;
}
}
</style>