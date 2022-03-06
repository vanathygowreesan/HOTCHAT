<?php
/**
 * Fresh Coffee Theme Customizer
 *
 * @package Fresh_Coffee
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hotcoffee_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'hotcoffee_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'hotcoffee_customize_partial_blogdescription',
			)
		);
	}


	$wp_customize->add_setting( 'hotcoffee_logo_alt' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_logo_alt', array(
		'label' => 'Logo(alt)',
		'section' => 'title_tagline',
		'priority' => 9,
	)));


	/* Add customizer api to custom icons */

	$wp_customize->add_panel('hotcoffee_custom_icons',array(
		'title' => esc_html__( 'Custom Icons', 'hotcoffee' ),
	));

	/* Add customizer api to login */
	$wp_customize->add_section('hotcoffee_login',array(
		'title' => esc_html__( 'Login', 'hotcoffee' ),
		'panel' => 'hotcoffee_custom_icons',
	));

	$wp_customize->add_setting( 'hotcoffee_login_title' );

	$wp_customize->add_control( 'hotcoffee_login_title', array(
		'label' => 'Title',
		'description' => 'Enter your login title',
		'section' => 'hotcoffee_login',
	));

	$wp_customize->add_setting( 'hotcoffee_login_url' );

	$wp_customize->add_control( 'hotcoffee_login_url', array(
		'label' => 'URL',
		'description' => 'Enter your login link',
		'type' => 'url',
		'section' => 'hotcoffee_login',
	));

	/* login Icon */
	$wp_customize->add_setting( 'hotcoffee_login_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_login_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_login',
	)));

	/* Add customizer api to create account */
	$wp_customize->add_section('hotcoffee_create_account',array(
		'title' => esc_html__( 'Createaccount', 'hotcoffee' ),
		'panel' => 'hotcoffee_custom_icons',
	));

	$wp_customize->add_setting( 'hotcoffee_create_account_title' );

	$wp_customize->add_control( 'hotcoffee_create_account_title', array(
		'label' => 'Title',
		'description' => 'Enter your title',
		'section' => 'hotcoffee_create_account',
	));

	$wp_customize->add_setting( 'hotcoffee_create_account_url' );

	$wp_customize->add_control( 'hotcoffee_create_account_url', array(
		'label' => 'URL',
		'description' => 'Enter your Create Account link',
		'type' => 'url',
		'section' => 'hotcoffee_create_account',
	));

	/* Create account Icon */
	$wp_customize->add_setting( 'hotcoffee_create_account_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_create_account_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_create_account',
	)));



	/* Add customizer api to cart */
	$wp_customize->add_section('hotcoffee_cart',array(
		'title' => esc_html__( 'Cart', 'hotcoffee' ),
		'panel' => 'hotcoffee_custom_icons',
	));

	$wp_customize->add_setting( 'hotcoffee_cart_title' );

	$wp_customize->add_control( 'hotcoffee_cart_title', array(
		'label' => 'Title',
		'description' => 'Enter your title',
		'section' => 'hotcoffee_cart',
	));

	$wp_customize->add_setting( 'hotcoffee_cart_url' );

	$wp_customize->add_control( 'hotcoffee_cart_url', array(
		'label' => 'URL',
		'description' => 'Enter your Cart link',
		'type' => 'url',
		'section' => 'hotcoffee_cart',
	));

	/* Create account Icon */
	$wp_customize->add_setting( 'hotcoffee_cart_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_cart_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_cart',
	)));


	/* Add customizer api to Search */
	$wp_customize->add_section('hotcoffee_search',array(
		'title' => esc_html__( 'Search', 'hotcoffee' ),
		'panel' => 'hotcoffee_custom_icons',
	));

	$wp_customize->add_setting( 'hotcoffee_search_title' );

	$wp_customize->add_control( 'hotcoffee_search_title', array(
		'label' => 'Title',
		'description' => 'Enter your title',
		'section' => 'hotcoffee_search',
	));

	$wp_customize->add_setting( 'hotcoffee_search_url' );

	$wp_customize->add_control( 'hotcoffee_search_url', array(
		'label' => 'URL',
		'description' => 'Enter your link',
		'type' => 'url',
		'section' => 'hotcoffee_search',
	));

	/* Create account Icon */
	$wp_customize->add_setting( 'hotcoffee_search_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_search_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_search',
	)));


		

	/* Add customizer api to social media */

	$wp_customize->add_panel('hotcoffee_social_media',array(
		'title' => esc_html__( 'Social Media', 'hotcoffee' ),
	));

	/* Add customizer api to facebook */
	$wp_customize->add_section('hotcoffee_facebook',array(
		'title' => esc_html__( 'Facebook', 'hotcoffee' ),
		'panel' => 'hotcoffee_social_media',
	));

	$wp_customize->add_setting( 'hotcoffee_facebook_title' );

	$wp_customize->add_control( 'hotcoffee_facebook_title', array(
		'label' => 'Title',
		'description' => 'Enter your Facbook title',
		'section' => 'hotcoffee_facebook',
	));

	$wp_customize->add_setting( 'hotcoffee_facebook_url' );

	$wp_customize->add_control( 'hotcoffee_facebook_url', array(
		'label' => 'URL',
		'description' => 'Enter your Facbook link',
		'type' => 'url',
		'section' => 'hotcoffee_facebook',
	));

	/* facebook Icon */
	$wp_customize->add_setting( 'hotcoffee_facebook_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_facebook_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_facebook',
	)));


	/* Add customizer api to twitter */
	$wp_customize->add_section('hotcoffee_twitter',array(
		'title' => esc_html__( 'Twitter', 'hotcoffee' ),
		'panel' => 'hotcoffee_social_media',
	));

	$wp_customize->add_setting( 'hotcoffee_twitter_title' );

	$wp_customize->add_control( 'hotcoffee_twitter_title', array(
		'label' => 'Title',
		'description' => 'Enter your Twitter title',
		'section' => 'hotcoffee_twitter',
	));

	$wp_customize->add_setting( 'hotcoffee_twitter_url' );

	$wp_customize->add_control( 'hotcoffee_twitter_url', array(
		'label' => 'URL',
		'description' => 'Enter your Twitter link',
		'type' => 'url',
		'section' => 'hotcoffee_twitter',
	));

	/* twitter Icon */
	$wp_customize->add_setting( 'hotcoffee_twitter_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_twitter_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_twitter',
	)));



	/* Add customizer api to instagram */
	$wp_customize->add_section('hotcoffee_instagram',array(
		'title' => esc_html__( 'Instagram', 'hotcoffee' ),
		'panel' => 'hotcoffee_social_media',
	));

	$wp_customize->add_setting( 'hotcoffee_instagram_title' );

	$wp_customize->add_control( 'hotcoffee_instagram_title', array(
		'label' => 'Title',
		'description' => 'Enter your instagram title',
		'section' => 'hotcoffee_instagram',
	));

	$wp_customize->add_setting( 'hotcoffee_instagram_url' );

	$wp_customize->add_control( 'hotcoffee_instagram_url', array(
		'label' => 'URL',
		'description' => 'Enter your Instagram link',
		'type' => 'url',
		'section' => 'hotcoffee_instagram',
	));

	/* instagram Icon */
	$wp_customize->add_setting( 'hotcoffee_instagram_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_instagram_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_instagram',
	)));




	/* Add customizer api to youtube */
	$wp_customize->add_section('hotcoffee_youtube',array(
		'title' => esc_html__( 'Youtube', 'hotcoffee' ),
		'panel' => 'hotcoffee_social_media',
	));

	$wp_customize->add_setting( 'hotcoffee_youtube_title' );

	$wp_customize->add_control( 'hotcoffee_youtube_title', array(
		'label' => 'Title',
		'description' => 'Enter your youtube title',
		'section' => 'hotcoffee_youtube',
	));

	$wp_customize->add_setting( 'hotcoffee_youtube_url' );

	$wp_customize->add_control( 'hotcoffee_youtube_url', array(
		'label' => 'URL',
		'description' => 'Enter your youtube link',
		'type' => 'url',
		'section' => 'hotcoffee_youtube',
	));

	/* youtube Icon */
	$wp_customize->add_setting( 'hotcoffee_youtube_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_youtube_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_youtube',
	)));



	/* Add customizer api to Whatsapp */
	$wp_customize->add_section('hotcoffee_whatsapp',array(
		'title' => esc_html__( 'WhatsApp', 'hotcoffee' ),
		'panel' => 'hotcoffee_social_media',
	));

	$wp_customize->add_setting( 'hotcoffee_whatsapp_title' );

	$wp_customize->add_control( 'hotcoffee_whatsapp_title', array(
		'label' => 'Title',
		'description' => 'Enter your whatsapp title',
		'section' => 'hotcoffee_whatsapp',
	));

	$wp_customize->add_setting( 'hotcoffee_whatsapp_url' );

	$wp_customize->add_control( 'hotcoffee_whatsapp_url', array(
		'label' => 'URL',
		'description' => 'Enter your whatsapp link',
		'type' => 'url',
		'section' => 'hotcoffee_whatsapp',
	));

	/* Whatsapp Icon */
	$wp_customize->add_setting( 'hotcoffee_whatsapp_icon' );

	$wp_customize->add_control( new WP_Customize_Media_Control ($wp_customize, 'hotcoffee_whatsapp_icon', array(
		'label' => 'Icon',
		'section' => 'hotcoffee_whatsapp',
	)));


}

add_action( 'customize_register', 'hotcoffee_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hotcoffee_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hotcoffee_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hotcoffee_customize_preview_js() {
	wp_enqueue_script( 'hotcoffee-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), HOTCOFFEE_VERSION, true );
}
add_action( 'customize_preview_init', 'hotcoffee_customize_preview_js' );
