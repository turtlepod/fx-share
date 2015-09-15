<?php
/**
 * Sanitize Functions
**/


/**
 * Sanitize Sharing Services
 * @since 0.1.0
 */
function fx_share_sanitize_services( $input ){

	/* Var */
	$output = array();

	/* Get valid services */
	$valid_services = fx_share_services();

	/* Make array */
	$services = explode( ',', $input );

	/* Bail. */
	if( ! $services ){
		return null;
	}

	/* Loop and verify */
	foreach( $services as $service ){

		/* Separate service and status */
		$service = explode( ':', $service );

		if( isset( $service[0] ) && isset( $service[1] ) ){
			if( array_key_exists( $service[0], $valid_services ) ){
				$status = $service[1] ? '1' : '0';
				$output[] = trim( $service[0] . ':' . $status );
			}
		}

	}

	return trim( esc_attr( implode( ',', $output ) ) );
}


/**
 * Sanitize Post Types
 * @since 0.1.0
 */
function fx_share_sanitize_post_types( $input ){

	/* Var */
	$output = array();

	/* Make input as array */
	$post_types = explode( ',', $input );

	/* Bail. */
	if( ! $post_types ){
		return null;
	}

	/* Get valid post types */
	$valid_post_types = fx_share_post_types();

	/* Loop and verify */
	foreach( $post_types as $post_type ){
		if( array_key_exists( $post_type, $valid_post_types ) ){
			$output[] = $post_type;
		}
	}

	/* return it back as string. */
	return trim( esc_attr( implode( ',', $output ) ) );
}

/**
 * Sanitize Post Types
 * @since 0.1.0
 */
function fx_share_sanitize_options( $input ){

	/* Var */
	$output = array();

	/* Make input as array */
	$options = explode( ',', $input );

	/* Bail. */
	if( ! $options ){
		return null;
	}

	/* Get valid post types */
	$valid_options = array( 'index' );

	/* Loop and verify */
	foreach( $options as $option ){
		if( in_array( $option, $valid_options ) ){
			$output[] = $option;
		}
	}

	/* return it back as string. */
	return trim( esc_attr( implode( ',', $output ) ) );
}

/**
 * Sanitize Twitter Username
 * Strip out anything other than a letter, number, or underscore.
 * This will prevent the inadvertent inclusion of an extra @, as well as normalizing the handle.
 * @since 0.1.0
 */
function fx_share_sanitize_twitter_username( $input ){
	return trim( preg_replace( '/[^\da-z_]+/i', '', $input ) );
}