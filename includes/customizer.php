<?php
/**
 * f(x) Share Customizer
**/
add_action( 'customize_register', 'fx_share_customizer_register' );

/**
 * Customize Register
 * @since 0.1.0
 */
function fx_share_customizer_register( $wp_customize ){

	/* Load custom controls */
	require_once( FX_SHARE_PATH . 'includes/customizer-controls.php' );

	/* Add Section */
	$wp_customize->add_section(
		'fx_share',
		array(
			'title' => esc_html__( 'Sharing', 'fx-share' ),
		)
	);

	/* === SERVICES === */

	/* Add Settings */
	$wp_customize->add_setting(
		'fx_share[services]', /* option name */
		array(
			'default'           => fx_share_services_default(), // facebook:1,twitter:1,google_plus:1
			'sanitize_callback' => 'fx_share_sanitize_services',
			'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);

	/* Add Control for the settings. */
	$choices = array();
	$services = fx_share_services();
	foreach( $services as $key => $val ){
		$choices[$key] = $val['label'];
	}
	$wp_customize->add_control(
		new fx_Share_Customize_Control_Sortable_Checkboxes(
			$wp_customize,
			'fx_share_services', /* control id */
			array(
				'section'     => 'fx_share',
				'settings'    => 'fx_share[services]',
				'label'       => __( 'Sharing Services', 'fx-share' ),
				'description' => __( 'Enable and reorder sharing buttons.', 'fx-share' ),
				'choices'     => $choices,
			)
		)
	);

	/* === POST TYPES === */

	/* Add Settings */
	$wp_customize->add_setting(
		'fx_share[post_types]', /* option name */
		array(
			'default'           => 'post', // only on "post" post type
			'sanitize_callback' => 'fx_share_sanitize_post_types',
			'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);

	/* Add Control for the settings. */
	$wp_customize->add_control(
		new fx_Share_Customize_Control_Checkboxes(
			$wp_customize,
			'fx_share_post_types', /* control id */
			array(
				'section'     => 'fx_share',
				'settings'    => 'fx_share[post_types]',
				'label'       => __( 'Post Types', 'fx-share' ),
				'description' => __( 'Show sharing buttons on:', 'fx-share' ),
				'choices'     => fx_share_post_types(),
			)
		)
	);

	/* === OTHER OPTIONS === */
	/* TODO: Share count */

	/* Add Settings */
	$wp_customize->add_setting(
		'fx_share[options]', /* option name */
		array(
			'default'           => '',
			'sanitize_callback' => 'fx_share_sanitize_options',
			'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);

	/* Add Control for the settings. */
	$wp_customize->add_control(
		new fx_Share_Customize_Control_Checkboxes(
			$wp_customize,
			'fx_share_options', /* control id */
			array(
				'section'     => 'fx_share',
				'settings'    => 'fx_share[options]',
				'label'       => __( 'Other Options', 'fx-share' ),
				'description' => '',
				'choices'     => array(
					'index' => __( 'Show on archives & search pages.', 'fx-share' ),
				),
			)
		)
	);

	/* === Twitter Account === */

	/* Add Settings */
	$wp_customize->add_setting(
		'fx_share[twitter_username]', /* option name */
		array(
			'default'           => '',
			'sanitize_callback' => 'fx_share_sanitize_twitter_username',
			'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);

	/* Add Control for the settings. */
	$wp_customize->add_control(
		'fx_share_twitter_username',
		array(
			'type'          => 'text',
			'section'       => 'fx_share',
			'settings'      => 'fx_share[twitter_username]',
			'label'         => __( 'Twitter Username', 'fx-share' ),
			'description'   => __( "Website Twitter account.", 'fx-share' ),
		)
	);

} // end customize register


/* Register Customizer Scripts */
add_action( 'customize_controls_enqueue_scripts', 'fx_share_customize_register_scripts', 0 );


/**
 * Register Scripts
 * so we can easily load this scripts multiple times when needed (?)
 */
function fx_share_customize_register_scripts(){

	/* CSS */
	wp_register_style( 'fx-share-customize', FX_SHARE_URL . 'assets/customizer-control.css' );

	/* JS */
	wp_register_script( 'fx-share-customize', FX_SHARE_URL . 'assets/customizer-control.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
}
