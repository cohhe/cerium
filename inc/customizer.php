<?php
/**
 * Cerium 1.0 Theme Customizer support
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Cerium 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cerium_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'cerium' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'cerium' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'cerium' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'cerium' );

	// Add General setting panel and configure settings inside it
	$wp_customize->add_panel( 'cerium_general_panel', array(
		'priority'       => 250,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'General settings' , 'cerium'),
		'description'    => esc_html__( 'You can configure your general theme settings here' , 'cerium')
	) );

	// Add Header setting panel and configure settings inside it
	$wp_customize->add_panel( 'cerium_header_panel', array(
		'priority'       => 250,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Header settings' , 'cerium'),
		'description'    => esc_html__( 'You can configure your theme header settings here.' , 'cerium')
	) );

	// Website logo
	$wp_customize->add_section( 'cerium_general_logo', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Website logo' , 'cerium'),
		'description'    => esc_html__( 'Please upload your logo, recommended logo size should be between 262x80' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting( 'cerium_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cerium_logo', array(
		'label'    => esc_html__( 'Website logo', 'cerium' ),
		'section'  => 'cerium_general_logo',
		'settings' => 'cerium_logo',
	) ) );

	// Website footer logo
	$wp_customize->add_section( 'cerium_general_footerlogo', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Website footer logo' , 'cerium'),
		'description'    => esc_html__( 'Please upload your footer logo, recommended logo size should be between 262x80' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting( 'cerium_footerlogo', array( 'sanitize_callback' => 'esc_url_raw' ) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cerium_footerlogo', array(
		'label'    => esc_html__( 'Website footer logo', 'cerium' ),
		'section'  => 'cerium_general_footerlogo',
		'settings' => 'cerium_footerlogo',
	) ) );

	// Copyright
	$wp_customize->add_section( 'cerium_general_copyright', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Copyright' , 'cerium'),
		'description'    => esc_html__( 'Please provide short copyright text which will be shown in footer.' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting( 'cerium_copyright', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'Copyright &copy; 2015 Cerium' ) );

	$wp_customize->add_control(
		'cerium_copyright',
		array(
			'label'      => esc_html__('Copyright', 'cerium'),
			'section'    => 'cerium_general_copyright',
			'type'       => 'text',
		)
	);

	// Scroll to top
	$wp_customize->add_section( 'cerium_general_scrolltotop', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Scroll to top' , 'cerium'),
		'description'    => esc_html__( 'Do you want to enable "Scroll to Top" button?' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting( 'cerium_scrolltotop', array( 'sanitize_callback' => 'cerium_sanitize_checkbox' ) );

	$wp_customize->add_control(
		'cerium_scrolltotop',
		array(
			'label'      => esc_html__('Scroll to top', 'cerium'),
			'section'    => 'cerium_general_scrolltotop',
			'type'       => 'checkbox',
		)
	);

	// Favicon
	$wp_customize->add_section( 'cerium_general_favicon', array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Favicon' , 'cerium'),
		'description'    => esc_html__( 'Do you have favicon? You can upload it here.' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting( 'cerium_favicon', array( 'sanitize_callback' => 'esc_url_raw' ) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cerium_favicon', array(
		'label'    => esc_html__( 'Favicon', 'cerium' ),
		'section'  => 'cerium_general_favicon',
		'settings' => 'cerium_favicon',
	) ) );

	// Page layout
	$wp_customize->add_section( 'cerium_general_layout', array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Layout' , 'cerium'),
		'description'    => esc_html__( 'Choose a layout for your theme pages. Note that a widget has to be inside widget are, or the layout won\'t change.' , 'cerium'),
		'panel'          => 'cerium_general_panel'
	) );

	$wp_customize->add_setting(
		'cerium_layout',
		array(
			'default'           => 'full',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'cerium_layout',
		array(
			'type' => 'radio',
			'label' => 'Layout',
			'section' => 'cerium_general_layout',
			'choices' => array(
				'full' => esc_html__('Full', 'cerium'),
				'right' => esc_html__('Right', 'cerium')
			)
		)
	);

	// Header email
	$wp_customize->add_section( 'cerium_header_email', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Email' , 'cerium'),
		'description'    => esc_html__( 'An email address for your theme header.' , 'cerium'),
		'panel'          => 'cerium_header_panel'
	) );

	$wp_customize->add_setting( 'cerium_headeremail', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'cerium_headeremail',
		array(
			'label'      => esc_html__('Email', 'cerium'),
			'section'    => 'cerium_header_email',
			'type'       => 'text',
		)
	);

	// Header phone
	$wp_customize->add_section( 'cerium_header_phone', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Phone' , 'cerium'),
		'description'    => esc_html__( 'An Phone number for your theme header.' , 'cerium'),
		'panel'          => 'cerium_header_panel'
	) );

	$wp_customize->add_setting( 'cerium_headerphone', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'cerium_headerphone',
		array(
			'label'      => esc_html__('Phone', 'cerium'),
			'section'    => 'cerium_header_phone',
			'type'       => 'text',
		)
	);

	// Google maps key
	$wp_customize->add_section( 'cerium_google_maps_key', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Google maps key' , 'cerium'),
		'description'    => esc_html__( 'Google maps API key so theme can use Google maps API.' , 'cerium'),
		'panel'          => 'cerium_header_panel'
	) );

	$wp_customize->add_setting( 'cerium_gmap_key', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'cerium_gmap_key',
		array(
			'label'      => esc_html__('Google maps key', 'cerium'),
			'section'    => 'cerium_google_maps_key',
			'type'       => 'text',
		)
	);

	// Social links
	$wp_customize->add_section( new cerium_Customized_Section( $wp_customize, 'cerium_social_links', array(
		'priority'       => 300,
		'capability'     => 'edit_theme_options'
		) )
	);

	$wp_customize->add_setting( 'cerium_fake_field', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'cerium_fake_field',
		array(
			'label'      => '',
			'section'    => 'cerium_social_links',
			'type'       => 'text'
		)
	);
}
add_action( 'customize_register', 'cerium_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) && !class_exists( 'cerium_Customized_Section' ) ) {
	class cerium_Customized_Section extends WP_Customize_Section {
		public function render() {
			$classes = 'accordion-section control-section control-section-' . $this->type;
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
				<style type="text/css">
					.cohhe-social-profiles {
						padding: 14px;
					}
					.cohhe-social-profiles li:last-child {
						display: none !important;
					}
					.cohhe-social-profiles li i {
						width: 20px;
						height: 20px;
						display: inline-block;
						background-size: cover !important;
						margin-right: 5px;
						float: left;
					}
					.cohhe-social-profiles li i.twitter {
						background: url(<?php echo get_template_directory_uri().'/images/icons/twitter.png'; ?>);
					}
					.cohhe-social-profiles li i.facebook {
						background: url(<?php echo get_template_directory_uri().'/images/icons/facebook.png'; ?>);
					}
					.cohhe-social-profiles li i.googleplus {
						background: url(<?php echo get_template_directory_uri().'/images/icons/googleplus.png'; ?>);
					}
					.cohhe-social-profiles li i.cohhe_logo {
						background: url(<?php echo get_template_directory_uri().'/images/icons/cohhe.png'; ?>);
					}
					.cohhe-social-profiles li a {
						height: 20px;
						line-height: 20px;
					}
					#customize-theme-controls>ul>#accordion-section-cerium_social_links {
						margin-top: 10px;
					}
					.cohhe-social-profiles li.documentation {
						text-align: right;
						margin-bottom: 60px;
					}
				</style>
				<ul class="cohhe-social-profiles">
					<li class="documentation"><a href="http://documentation.cohhe.com/cerium" class="button button-primary button-hero" target="_blank"><?php _e( 'Documentation', 'cerium' ); ?></a></li>
					<li class="social-twitter"><i class="twitter"></i><a href="https://twitter.com/Cohhe_Themes" target="_blank"><?php _e( 'Follow us on Twitter', 'cerium' ); ?></a></li>
					<li class="social-facebook"><i class="facebook"></i><a href="https://www.facebook.com/cohhethemes" target="_blank"><?php _e( 'Join us on Facebook', 'cerium' ); ?></a></li>
					<li class="social-googleplus"><i class="googleplus"></i><a href="https://plus.google.com/+Cohhe_Themes/posts" target="_blank"><?php _e( 'Join us on Google+', 'cerium' ); ?></a></li>
					<li class="social-cohhe"><i class="cohhe_logo"></i><a href="http://cohhe.com/" target="_blank"><?php _e( 'Cohhe.com', 'cerium' ); ?></a></li>
				</ul>
			</li>
			<?php
		}
	}
}

function cerium_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Sanitize the Featured Content layout value.
 *
 * @since Cerium 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function cerium_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'slider' ) ) ) {
		$layout = 'slider';
	}

	return $layout;
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Cerium 1.0
 */
function cerium_customize_preview_js() {
	wp_enqueue_script( 'cerium_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'cerium_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since Cerium 1.0
 *
 * @return void
 */
function cerium_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'cerium',
		'title'   => __( 'Cerium 1.0', 'cerium' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by the <a href="%1$s">featured</a> tag; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'cerium' ), admin_url( '/edit.php?tag=featured' ), admin_url( 'customize.php' ), admin_url( '/edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Cerium 1.0 uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'cerium' ), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Cerium 1.0 documentation</a>.', 'cerium' ), 'http://codex.wordpress.org/Cerium' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'cerium_contextual_help' );
add_action( 'admin_head-edit.php',   'cerium_contextual_help' );
