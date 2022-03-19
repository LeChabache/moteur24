<?php
/**
 * In listing creation flow, this template shows above the creation form.
 *
 * @since 1.6.3
 */

if ( ! defined('ABSPATH') ) {
	exit;
}

if ( is_user_logged_in() ) {
	return;
}

$account_required = mylisting_get_setting( 'submission_requires_account' );
if ( $account_required ) {
	$message = __( 'Vous devez être connecté pour publier de nouvelles annonces.', 'my-listing' );
} elseif ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
	$message = __( 'Vous pouvez vous connecter à votre compte existant ou en créer un nouveau.', 'my-listing' );
} else {
	$message = __( 'Si vous avez déjà un compte, vous pouvez vous connecter ci-dessous.', 'my-listing' );
}
?>

<div class="form-section-wrapper active" id="form-section-auth">
	<div class="element form-section">
		<div class="pf-head round-icon">
			<div class="title-style-1">
				<i class="mi account_circle"></i>
				<h5><?php _ex( 'Compte', 'Add listing form', 'my-listing' ) ?></h5>
			</div>
		</div>
		<div class="pf-body">
			<fieldset class="fieldset-login_required">
				<p><?php echo $message ?></p>
				<p>
					<a href="<?php echo esc_url( \MyListing\get_login_url() ) ?>" class="buttons button-5">
						<i class="mi person"></i>
						<?php _e( 'Se connecter', 'my-listing' ) ?>
					</a>
					<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ): ?>
						<span>ou</span>
						<a href="<?php echo esc_url( \MyListing\get_register_url() ) ?>" class="buttons button-5">
							<i class="mi person"></i>
							<?php _e( "S'enregistrer", 'my-listing' ) ?>
						</a>
					<?php endif ?>
				</p>
			</fieldset>
		</div>
	</div>
</div>
