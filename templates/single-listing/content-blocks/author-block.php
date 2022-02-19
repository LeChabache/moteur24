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
					<div class="auth-avatar-singl">
						<div class="avatar">
							<img src="<?php echo esc_url( $author->get_avatar() ) ?>">
						</div>
					</div>
					<div class="auth-det-sngl" style="margin-top: 20px;margin-left: 4px;">
						<div class="host-name">
							<?php echo esc_html( $author->get_name() ) ?>
						</div>

						<?php 
							$author = $listing->get_author();
							if ( ! ( $author instanceof \MyListing\Src\User && $author->exists() ) ) {
								return;
							}
							$author_m24_badges = $author->get_author_m24_badges();
							$premium_customer = $author->get_premium_customer();
							$score_du_publicateur = $author->get_score_du_publicateur();

						?>
							
						<?php if( $author_m24_badges ): ?>
							<span id="author-verificatio-badge" style="top:-5px;"><img class="verified-author m-badge" data-toggle="tooltip" src="<?php echo esc_url( c27()->image('tick.svg') ) ?>"></span>
						<?php endif; ?>
						
						
						<?php if ( $author instanceof \WP_User ):
							$roles = array_filter( array_map( [ c27(), 'get_role_name' ], (array) $author->roles ) );
							?>
							<div class="auth_details">
								<div class="auth_role">
									<?php if ( ! empty( $roles ) ): ?>
										<span class="auth_role"><?php echo join( ', ', $roles ) ?></span>
									<?php endif ?>
								</div>
							</div>
						<?php endif ?>
					</div>
					<div class="authr-bdg-sgl">
						<?php if( ! $author_m24_badges ): ?>
							<div class="auth_verification-badge">
								<span data-toggle="tooltip" data-placement="right" data-original-title="Utilisateur non vérifié"><i style="color: #b3b3b3;font-size: 10px;position: relative;top: 1px;right: -5px;" class="fa fa-user-slash"></i></span>
							</div>
						<?php endif; ?>
					</div>
							

				</a>
				 
			</div>

			<span style="position: absolute;left: 30px;color: #9b9b9b;">Succès du client: </span>
			<div class="progress" style="margin:20px;margin-top: 24px;">
				
				<div class="progress-bar bg-success" role="progressbar" style="background-color: #8bc34a;width: <?php echo esc_html( $author->get_score_du_publicateur() ) ?>%;" aria-valuenow="<?php echo esc_html( $author->get_score_du_publicateur() ) ?>" aria-valuemin="0" aria-valuemax="100"><?php echo esc_html( $author->get_score_du_publicateur() ) ?>% </div>
				</div>
			<?php if ( $links ) : ?>
				<?php mylisting_locate_template(
					'templates/single-listing/content-blocks/lists/outlined-list.php', [
					'items' => $links
				] ) ?>
			<?php endif; ?>

			<ul class="outlined-list details-block-content" style="padding: 0 20px 20px;">
			<?php if( $premium_customer ): ?>
				<li>
					<span class="wp-editor-content">
						<div style="border-top: 1px solid #cbcbcb;padding-top: 12px;font-weight: 500;margin-bottom: 5px;color: #f48509;">
							<i class="mi turned_in" style="display:inline-block;    color: #f58909;position:relative;top:5px;margin-right:10px;"></i> Top Fiabilité Plus:
						</div>
						<div style="margin-left:31px;">
							Vendeur fiable, livraison rapide et retours facilités.<a href="#">En savoir plus</a>
						</div>
					</span>
				</li>
			<?php endif; ?>
			<?php if( $author_m24_badges ): ?>
				<li>
					<span class="wp-editor-content">
						<div style="border-top: 1px solid #cbcbcb;padding-top: 12px;font-weight: 500;margin-bottom: 5px;color: #f48509;">
							<i class="mi turned_in" style="display:inline-block;    color: #f58909;position:relative;top:5px;margin-right:10px;"></i> Utilisateur vérifié:
						</div>
						<div style="margin-left:31px;">
							Vendeur fiable, livraison rapide et retours facilités.<a href="#">En savoir plus</a>
						</div>
					</span>
				</li>
			<?php endif; ?>

			<?php if ( $listing->is_verified() ): ?>
				<li>
					<span class="wp-editor-content">
						<div style="border-top: 1px solid #cbcbcb;padding-top: 12px;font-weight: 500;margin-bottom: 5px;color: #f48509;">
							<i class="mi turned_in" style="display:inline-block;    color: #f58909;position:relative;top:5px;margin-right:10px;"></i> Annonce vérifié:
						</div>
						<div style="margin-left:31px;">
							Vendeur fiable, livraison rapide et retours facilités.<a href="#">En savoir plus</a>
						</div>
					</span>
				</li>
			<?php endif; ?>
				<li>
					<span class="wp-editor-content">
						<div style="border-top: 1px solid #cbcbcb;padding-top: 12px;font-weight: 500;margin-bottom: 5px;color: #f48509;">
							<i class="mi turned_in" style="display:inline-block;    color: #f58909;position:relative;top:5px;margin-right:10px;"></i> Garantie client Moteur24:
						</div>
						<div style="margin-left:31px;">
							Obtenez un remboursement si vous ne recevez pas le bien que vous avez commandé. <a href="#">En savoir plus</a>
						</div>
					</span>
				</li>
				
                
            </ul>

		</div>
	</div>
</div>
