<?php
/**
 * Setup
**/

/* === Load front end styles === */
add_action( 'wp_enqueue_scripts', 'fx_share_scripts' );

/**
 * Enqueue Scripts
 */
function fx_share_scripts(){
	wp_enqueue_style( 'fx-share-icon', FX_SHARE_URL . 'assets/fx-share-icons/fx-share-icons.css' );
	wp_enqueue_style( 'fx-share', FX_SHARE_URL . 'assets/fx-share.css', array( 'fx-share-icon' ) );
}

/* === Add share buttons in excerpt and content === */
if( apply_filters( 'fx_share_display', true ) ){
	add_filter( 'the_excerpt', 'fx_share_filter_excerpt', 99 );
	add_filter( 'the_content', 'fx_share_filter_content', 99 );
}


/**
 * Add sharing button by filtering content on singular pages.
 */
function fx_share_filter_excerpt( $excerpt ){

	/* Check settings. */
	$data = get_option( 'fx_share' );
	$options = array();
	if( isset( $data['options'] ) || ! empty( $data['options'] ) ){
		$options = explode( ',', $data['options'] );
	};

	/* filter excerpt. */
	$current_post_type = get_post_type();
	if( !is_singular() && in_array( 'index', $options ) && is_main_query() && 'attachment' != $current_post_type ){
		$excerpt .= fx_share();
	}
	return $excerpt;
}

/**
 * Add sharing button by filtering content on singular pages.
 */
function fx_share_filter_content( $content ){

	/* Check settings. */
	$data = get_option( 'fx_share' );
	$options = array();
	if( isset( $data['options'] ) || ! empty( $data['options'] ) ){
		$options = explode( ',', $data['options'] );
	};
	$display = in_array( 'index', $options ) ? true : is_singular();

	/* Filter content. */
	if( $display && is_main_query() ){
		$content .= fx_share();
	}
	return $content;
}
