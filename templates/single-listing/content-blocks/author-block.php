<?php
/**
 * Template for rendering an `author` block in single listing page.
 *
 * @since 1.0
 */
if ( ! defined('ABSPATH') ) {
	exit;
}

$author = $listing->get_author();
if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
	return;
}

$social_links = $author->get_social_links();
$links = [];
if ( ! empty( $social_links ) ) {
	$links = array_map( function( $network ) {
		return [
			'name' => $network['name'],
			'icon' => sprintf( '<i class="%s"></i>', esc_attr( $network['icon'] ) ),
			'link' => $network['link'],
			'color' => $network['color'],
			'text_color' => '#fff',
			'target' => '_blank',
		];
	}, $social_links );
}
?>

<div class="<?php echo esc_attr( $block->get_wrapper_classes() ) ?>" id="<?php echo esc_attr( $block->get_wrapper_id() ) ?>">
	<div class="element related-listing-block">
		<div class="pf-head">
			<div class="title-style-1">
				<i class="<?php echo esc_attr( $block->get_icon() ) ?>"></i>
				<h5><?php echo esc_html( $block->get_title() ) ?></h5>
			</div>
		</div>
		

		

		
		<div class="pf-body">
			<div class="event-host">
				<a href="<?php echo esc_url( $author->get_link() ) ?>">
					<div class="avatar">
						<img src="<?php echo esc_url( $author->get_avatar() ) ?>">
					</div>
					<div class="host-name">
						<?php echo esc_html( $author->get_name() ) ?>
						<?php 
						$author = $listing->get_author();
						if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
							return;
						}
						$author_m24_badges = $author->get_author_m24_badges();


						?>


						<?php if( $author_m24_badges ): ?>
							<span id="author-verificatio-badge"><img class="verified-author m-badge" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>"></span>
						<?php endif; ?>

					</div>
					
					
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


					<?php if( ! $author_m24_badges ): ?>
						<span data-toggle="tooltip" data-placement="right" data-original-title="Utilisateur non vérifié"><i style="color: #b3b3b3;font-size: 10px;position: relative;top: 1px;right: -5px;" class="fa fa-user-slash"></i></span>

					<?php endif; ?>

						

				</a>
			</div>
			
			<?php if ( $links ) : ?>
				<?php mylisting_locate_template(
					'templates/single-listing/content-blocks/lists/outlined-list.php', [
					'items' => $links
				] ) ?>
			<?php endif; ?>
		</div>
	</div>
</div>
