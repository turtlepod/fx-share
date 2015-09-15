<?php
/**
 * Functions
**/

/**
 * Get Shareable Post Types
 * @return array
 */
function fx_share_post_types(){

	/* Post Types */
	$post_types = array();

	/* Get All Public Post Types */
	$supported_post_types = apply_filters( 'fx_share_post_types', get_post_types( array( 'public' => true ) ) ) ;

	/* Get label */
	foreach( $supported_post_types as $post_type ){
		$post_type_obj = get_post_type_object( $post_type );
		$post_types[$post_type] = $post_type_obj->labels->name;
	}

	return $post_types;
}


/**
 * Services
 * list of available sharing services
 */
function fx_share_services(){

	$services = array();

	/* facebook */
	$services['facebook'] = array(
		'id'       => 'facebook',
		'label'    => __( 'Facebook', 'fx-share' ),
		'callback' => 'fx_share_facebook',
	);

	/* twitter */
	$services['twitter'] = array(
		'id'       => 'twitter',
		'label'    => __( 'Twitter', 'fx-share' ),
		'callback' => 'fx_share_twitter',
	);

	/* google+ */
	$services['google_plus'] = array(
		'id'       => 'google_plus',
		'label'    => __( 'Google+', 'fx-share' ),
		'callback' => 'fx_share_google_plus',
	);

	return apply_filters( 'fx_share_services', $services );
}


/**
 * Utility: Default Services to use in customizer default value
 * @return string
 */
function fx_share_services_default(){
	$default = array();
	$services = fx_share_services();
	foreach( $services as $service ){
		$default[] = $service['id'] . ':1'; /* activate all as default. */
	}
	return apply_filters( 'fx_share_services_default', implode( ',', $default ) );
}


/**
 * Share Template Tags
 * the final function with the conditional.
 */
function fx_share(){

	/* Get the options */
	$option = get_option( 'fx_share' );

	/* Check Services */
	$services = fx_share_services_default();
	if( isset( $option['services'] ) ){
		$services = $option['services'];
	}
	if( ! $services ) return;

	/* Check Post Status */
	$current_post_status = get_post_status( get_the_ID() );
	if ( 'private' === $current_post_status ) return;

	/* Check Post Types */
	$current_post_type = get_post_type();
	$post_types = 'post';
	if( isset( $option['post_types'] ) ){
		$post_types = $option['post_types'];
	}
	$post_types = explode( ',', $post_types );
	if( ! $post_types || ! in_array( $current_post_type, $post_types ) ) return;

	/* render button */
	return apply_filters( 'fx_share', fx_share_get_buttons( $services ) );
}


/**
 * Echo Share buttons HTML based on Options
 * @param $options string formatted active services
 */
function fx_share_buttons( $options ){
	echo fx_share_get_buttons( $options );
}


/**
 * Return Share buttons HTML based on Options
 * @param $options string formatted active services
 */
function fx_share_get_buttons( $options ){

	/* bail if empty. */
	if( ! $options ) return;

	/* available services */
	$services = fx_share_services();

	/* var. */
	$buttons = array();

	/* make array */
	$options = explode( ',', $options );

	/* loop load */
	foreach( $options as $option ){
		$option = explode( ':', $option );
		if( isset( $option[0] ) && isset( $option[1] ) && array_key_exists( $option[0], $services ) && '1' == $option[1] ){
			$buttons[] = $option[0];
		}
	}

	/* bail if not found. */
	if( ! $buttons ) return;
	ob_start();
?>
	<div class="fx-share">
		<ul>
			<?php foreach( $buttons as $button ){
				$fn_callback = $services[$button]['callback'];
			?>
				<?php if ( function_exists( $fn_callback ) ){ ?>
				<li class="fx-share-<?php echo sanitize_html_class( $button );?>">
					<?php call_user_func( $fn_callback ); ?>
				</li>
				<?php } // check callback ?>
			<?php } // end foreach ?>
		</ul>
	</div><!-- .fx-share -->
<?php
	return ob_get_clean();
}


/**
 * Facebook Share HTML
 */
function fx_share_facebook(){
	$base_url = 'https://www.facebook.com/sharer.php';
	$args = array(
		'u' => esc_url( get_permalink() ),
		't' => urlencode( the_title_attribute( 'echo=0' ) ),
	);
	$url = add_query_arg( $args, $base_url );
?>
<a class="fx-share-button fx-share-button-facebook" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Facebook', 'fx-share' ); ?></span></a>
<?php
}


/**
 * Twitter Share HTML
 */
function fx_share_twitter(){
	$base_url = 'https://twitter.com/intent/tweet';
	$args = array(
		'url'  => esc_url( get_permalink() ),
		'text' => urlencode( the_title_attribute( 'echo=0' ) ),
	);

	$options = get_option( 'fx_share' );
	if( isset( $options['twitter_username'] ) ){
		$username = fx_share_sanitize_twitter_username( $options['twitter_username'] );
		if( !empty( $username ) ){
			$args['via'] = urlencode( $options['twitter_username'] );
		}
	}

	$url = add_query_arg( $args, $base_url );
?>
<a class="fx-share-button fx-share-button-twitter" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Twitter', 'fx-share' ); ?></span></a>
<?php
}


/**
 * Google+ Share HTML
 */
function fx_share_google_plus(){
	$base_url = 'https://plus.google.com/share';
	$args = array(
		'url' => esc_url( get_permalink() ),
	);
	$url = add_query_arg( $args, $base_url );
?>
<a class="fx-share-button fx-share-button-google_plus" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Google+', 'fx-share' ); ?></span></a>
<?php
}
