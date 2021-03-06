<select
	multiple="multiple"
	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[]"
	id="<?php echo esc_attr( $key ); ?>"
	<?php if ( ! empty( $field['required'] ) ) echo 'required'; ?>
	<?php if ( ! empty( $field['placeholder'] ) ) echo 'placeholder="' . esc_attr( $field['placeholder'] ) . '"'; ?>
>
	<?php foreach ( $field['options'] as $key => $value ) : ?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php if ( ! empty( $field['value'] ) && is_array( $field['value'] ) ) selected( in_array( $key, $field['value'] ), true ); ?>><?php echo esc_html( $value ); ?></option>
	<?php endforeach; ?>
</select>
