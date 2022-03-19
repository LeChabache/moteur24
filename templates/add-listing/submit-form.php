<?php
/**
 * Listing submission form template.
 *
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_script( 'mylisting-listing-form' );
wp_enqueue_style( 'mylisting-add-listing' );
$can_post = is_user_logged_in() || ! mylisting_get_setting( 'submission_requires_account' );
?>

<div class="add-listing-nav">
	<ul></ul>
</div>
<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>
<div class="i-section">
	<div class="container">
		
		<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form light-forms c27-submit-listing-form" enctype="multipart/form-data">

			<?php
			/**
			 * Display login/register message at
			 * the top of the add-listing form.
			 *
			 * @since 1.0
			 */
			require locate_template( 'templates/add-listing/auth.php' ) ?>

			<?php if ( $can_post || \MyListing\Src\Listing::user_can_edit( $job_id ) ) : ?>
				<div class="form-section-wrapper dftr" id="form-section-general">
					<div class="element form-section">
						<div class="pf-head round-icon">
							<div class="title-style-1">
								<i class="icon-pencil-2"></i>
								<h5><?php _ex( 'General', 'Add listing form', 'my-listing' ) ?></h5>
							</div>
						</div>
						<div class="pf-body">

						<?php do_action( 'mylisting/add-listing/form-fields/start' ) ?>

						<?php foreach ( $fields as $key => $field ) : ?>

						<?php if ( $field->get_type() === 'form-heading' ): ?>
						</div></div></div>
						<div class="form-section-wrapper" id="form-section-<?php echo esc_attr( ! empty( $key ) ? $key : \MyListing\Utils\Random_Id::generate(7) ) ?>">
							<div class="element form-section">
								<div class="pf-head round-icon">
									<div class="title-style-1">
										<i class="<?php echo esc_attr( $field->get_prop('icon') ?: 'icon-pencil-2' ) ?>"></i>
										<h5><?php echo esc_html( $field->get_label() ) ?></h5>
									</div>
								</div>
							<div class="pf-body">
							<?php else:
								$classes = [];
								if ( $field->get_type() === 'term-select' ) {
									$classes[] = 'term-type-'.$field->get_prop('terms-template');
								}
								?>
								<div id="<?php echo esc_attr( $key ) ?>-<?php echo esc_attr( 'field-type-'.$field->get_type() ) ?>" class="fieldset-<?php echo esc_attr( $key ) ?> <?php echo esc_attr( 'field-type-'.$field->get_type() ) ?> form-group <?php echo join( ' ', array_map( 'esc_attr', $classes ) ) ?>">
									<div class="field-head">
										<label for="<?php echo esc_attr( $key ) ?>">
											<?php
												echo $field->get_label();
												echo apply_filters(
													'mylisting/submission/required-field-label',
													$field->is_required()
														? ' <small style="color:#f35a01;">'._x( '*', 'Add listing form', 'my-listing' ).'</small>'
														: '',
													$field
												);
											?>
										</label>
										<?php if ( ! empty( $field->get_description() ) ): ?>
											<small class="description"><?php echo $field->get_description() ?></small>
										<?php endif ?>
									</div>
									<div class="field <?php echo $field->is_required() ? 'required-field' : ''; ?>">
										<?php mylisting_locate_template( 'templates/add-listing/form-fields/'.$field->get_type().'-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach; ?>

						<?php do_action( 'mylisting/add-listing/form-fields/end' ) ?>

						</div>
					</div>
				</div>
				<div class="form-section-wrapper form-footer" id="form-section-submit">
					<div class="form-section">
						<div class="pf-body">
							<div class="hidden">
								<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form ) ?>">
								<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ) ?>">
								<input type="hidden" name="step" value="<?php echo esc_attr( $step ) ?>">
								<?php if ( ! empty( $_REQUEST['listing_type'] ) ): ?>
									<input type="hidden" name="listing_type" value="<?php echo esc_attr( $_REQUEST['listing_type'] ) ?>">
								<?php endif ?>
								<?php if ( ! empty( $_REQUEST['listing_package'] ) ): ?>
									<input type="hidden" name="listing_package" value="<?php echo esc_attr( $_REQUEST['listing_package'] ) ?>">
								<?php endif ?>
							</div>

							<div class="listing-form-submit-btn">
								<button type="submit" name="submit_job" class="preview-btn button buttons button-2 preview" value="submit">
								Aperçu
								</button>

								<?php if ( $form === 'submit-listing' ): ?>
									<button type="submit" name="submit_job" class="preview-btn button buttons button-2" id="skip-preview-btn button buttons button-3" value="submit--no-preview">
										<?php echo esc_attr( _x( 'Soumettre <i class="fa fa-arrow-right">', 'Add listing form', 'my-listing' ) ) ?>
									</button>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</form>
	</div>
</div>

<div class="loader-bg main-loader add-listing-loader" style="background-color: #fff; display: none;">
	<?php c27()->get_partial( 'spinner', [ 'color' => '#000' ] ) ?>
	<p class="add-listing-loading-message"><?php _ex( 'Veuillez patienter pendant le traitement de la demande.', 'Add listing form', 'my-listing' ) ?></p>
</div>
<style>
/*Check boxes */
.md-checkbox label:before {
    left: 10px;
    top: 13px;
}
.md-checkbox input[type=checkbox]:checked+label,
.md-checkbox input[type=radio]:checked+label {
    height: 50px;
    width: 100%;
}
.md-checkbox input[type=checkbox]:checked+label:after,
.md-checkbox input[type=radio]:checked+label:after{
    top: 21px;
    left: 16px;
}
.md-checkbox label {
    padding-left: 47px;
    margin-top: 0;
    height: 50px;
    padding-top: 26px;
}
.md-checkbox {
    height: auto;
    margin: 0;
    margin-right: 10px;
}
/**Hide first title */
.dftr{
	display:none;
}
li#form-section-general-nav {
    display: none;
}
/**Test */
#submit-job-form .round-icon .title-style-1 i {
    border-radius: 8px;
    background: #242429;
    text-align: center;
    color: #f35a01;
    margin-left: 10px;
    margin-right: -5px;
}
#submit-job-form .round-icon .title-style-1 i:before{
	filter:none!important;
}
#submit-job-form .title-style-1{
    background: #242429;
    height: 45px;
    border-radius: 8px;
    padding: 4px;
}

#submit-job-form .title-style-1 h5 {
    font-weight: 500!important;
    color: #ffffff!important;
	margin-left: 10px!important;
	margin-top: 1px!important;
}
/**Hide pencile */
#submit-job-form i.icon-pencil-2{
	display:none
}
/**place hlder */
.select2-container--default .select2-selection--single .select2-selection__placeholderx {
    display: none;
}
/**input hover border */
#submit-job-form .field>input {
	padding-left: 10px!important;
}
#submit-job-form .field>input:focus, #submit-job-form .field>textarea:focus {
    border-bottom: 2px solid #f35a01;
}
#submit-job-form> .field-head{
	display:none;
}

/* The progress container (grey background) */
.progress-container {
    width: 100%;
    height: 8px;
    background: #ccc;
    position: sticky;
    top: 100px;
    z-index: 1;
}
@media only screen and (max-width: 1200px){
.progress-container {
    top: 0px;
}	
}
/* The progress bar (scroll indicator) */
.progress-bar {
  height: 8px;
  background: #8bc34a;
  width: 0%;
}
</style>


<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("progressBar").style.width = scrolled + "%";
}





setInterval(function(){
   
    var vehiculeneuf = document.querySelector("#afficher-le-badge-neuf-field-type-checkbox .md-checkbox input[type=checkbox]").checked;
    let vehiculeneufselected = vehiculeneuf;
      
      	if(vehiculeneufselected === true){
            document.getElementById("tat-du-vhicule-field-type-select").style.display = "none";
            document.getElementById("fumeur-field-type-checkbox").style.display = "none";
            document.getElementById("entretien-field-type-checkbox").style.display = "none";
            document.getElementById("histo4-field-type-checkbox").style.display = "none";
            document.getElementById("dj-accident-field-type-checkbox").style.display = "none";
            document.getElementById("moteur-field-type-checkbox").style.display = "none";
            document.getElementById("histo4-field-type-checkbox").style.display = "none";
            document.getElementById("peinture-originale-field-type-checkbox").style.display = "none";
        }else {
            document.getElementById("tat-du-vhicule-field-type-select").style.display = "block";
            document.getElementById("fumeur-field-type-checkbox").style.display = "block";
            document.getElementById("entretien-field-type-checkbox").style.display = "block";
            document.getElementById("histo4-field-type-checkbox").style.display = "block";
            document.getElementById("dj-accident-field-type-checkbox").style.display = "block";
            document.getElementById("moteur-field-type-checkbox").style.display = "block";
            document.getElementById("histo4-field-type-checkbox").style.display = "block";
            document.getElementById("peinture-originale-field-type-checkbox").style.display = "none";
        }
    
;}, 330);




setInterval(function(){

    var livraisoninclus = document.querySelector("#livraison-incluse-field-type-checkbox .md-checkbox input[type=checkbox]").checked;
    let livraisoninclusselected = livraisoninclus;
      
        if(livraisoninclusselected === true){
            document.getElementById("temps-de-livraison-field-type-radio").style.display = "block";
        }else {
            document.getElementById("temps-de-livraison-field-type-radio").style.display = "none";
        }
    
;}, 330);



setInterval(function(){
    var vehiculelectric = document.getElementById("select2-carburant-container").textContent.includes('Electrique');
    let vehiculelectricselected = vehiculelectric;
      
        if(vehiculelectricselected === true){
            document.getElementById("consomation-moyenne-field-type-number").style.display = "none";
            document.getElementById("cylindree-field-type-number").style.display = "none";
            document.getElementById("dplacement-du-moteur-litres-field-type-number").style.display = "none";

            document.getElementById("distance-max-par-charge-field-type-number").style.display = "block";
            document.getElementById("nbr-de-moteurs-field-type-number").style.display = "block";
        }else {
            document.getElementById("consomation-moyenne-field-type-number").style.display = "block";
            document.getElementById("cylindree-field-type-number").style.display = "block";
            document.getElementById("dplacement-du-moteur-litres-field-type-number").style.display = "block";

            document.getElementById("distance-max-par-charge-field-type-number").style.display = "none";
            document.getElementById("nbr-de-moteurs-field-type-number").style.display = "none";
    
        }
    
;}, 330);

</script>