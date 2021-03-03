<?php
/**
 * Gets the theme defaults.
 *
 * Set all theme configurations here.
 *
 * @return array Theme default configuration settings.
 */
function vtl_theme_config() {

	/**
	 * Theme colors.
	 *
	 * 'id'    Should be a slug with underscores. Used within code.
	 *
	 * 'slug'  Should be a slug with hyphens. WordPress will auto-format the CSS class
	 *         based on this. Example: 'body-text' will become '.has-body-text-color'.
	 *
	 * 'label' Should be human-readable name.
	 *
	 */
	$colors = [
		[
			'id'      => 'color_page',
			'slug'    => 'page',
			'default' => '#ffffff',
			'label'   => 'Page Color',
		],
		[
			'id'      => 'color_utility_nav',
			'slug'    => 'utility-nav',
			'default' => '#cccccc',
			'label'   => 'Utility Nav',
		],
		[
			'id'      => 'color_utility_nav_text',
			'slug'    => 'utility-nav-text',
			'default' => '#222222',
			'label'   => 'Utility Nav Text',
		],
		[
			'id'      => 'color_main_nav',
			'slug'    => 'utility-main',
			'default' => '#ffffff',
			'label'   => 'Main Nav',
		],
		[
			'id'      => 'color_main_nav_text',
			'slug'    => 'utility-main-text',
			'default' => '#3fa2f7',
			'label'   => 'Main Nav Text',
		],
		[
			'id'      => 'color_main_nav_text_active',
			'slug'    => 'utility-main-text-active',
			'default' => '#0055a0',
			'label'   => 'Main Nav Active Text',
		],
		[
			'id'      => 'color_footer',
			'slug'    => 'utility-footer',
			'default' => '#cccccc',
			'label'   => 'Footer',
		],
		[
			'id'      => 'color_footer_text',
			'slug'    => 'utility-footer-text',
			'default' => '#222222',
			'label'   => 'Footer Text',
		],
		[
			'id'      => 'color_heading',
			'slug'    => 'heading',
			'default' => '#3d3d3d',
			'label'   => 'Heading Color',
		],
		[
			'id'      => 'color_body',
			'slug'    => 'body',
			'default' => '#4e4e4e',
			'label'   => 'Body Color',
		],
		[
			'id'      => 'color_link',
			'slug'    => 'link',
			'default' => '#3fa2f7',
			'label'   => 'Link Color',
		],
		[
			'id'      => 'color_custom_1',
			'slug'    => 'custom-1',
			'default' => '#3fa2f7',
			'label'   => 'Custom Color 1 (Primary CTA)',
		],
		[
			'id'      => 'color_custom_2',
			'slug'    => 'custom-2',
			'default' => '#3fa2f7',
			'label'   => 'Custom Color 2 (Secondary CTA)',
		],
		[
			'id'      => 'color_custom_3',
			'slug'    => 'custom-3',
			'default' => '',
			'label'   => 'Custom Color 3',
		],
		[
			'id'      => 'color_custom_4',
			'slug'    => 'custom-4',
			'default' => '',
			'label'   => 'Custom Color 4',
		],
		[
			'id'      => 'color_custom_5',
			'slug'    => 'custom-5',
			'default' => '',
			'label'   => 'Custom Color 5',
		],
		[
			'id'      => 'color_custom_6',
			'slug'    => 'custom-6',
			'default' => '',
			'label'   => 'Custom Color 6',
		],
		[
			'id'      => 'color_custom_7',
			'slug'    => 'custom-7',
			'default' => '',
			'label'   => 'Custom Color 7',
		],
		[
			'id'      => 'color_custom_8',
			'slug'    => 'custom-8',
			'default' => '',
			'label'   => 'Custom Color 8',
		],
		[
			'id'      => 'color_custom_9',
			'slug'    => 'custom-9',
			'default' => '',
			'label'   => 'Custom Color 9',
		],
		[
			'id'      => 'color_custom_10',
			'slug'    => 'custom-10',
			'default' => '',
			'label'   => 'Custom Color 10',
		],
		[
			'id'      => 'color_custom_11',
			'slug'    => 'custom-11',
			'default' => '',
			'label'   => 'Custom Color 11',
		],
		[
			'id'      => 'color_custom_12',
			'slug'    => 'custom-12',
			'default' => '',
			'label'   => 'Custom Color 12',
		],
	];

	$config = [
		'colors' => $colors,
	];

	$config = apply_filters('vtl_theme_config', $config);

	return $config;
}

