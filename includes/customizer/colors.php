<?php
/**
 * Customizer colors section.
 */
class VTL_Customizer_Colors {

	public function __construct() {
		add_action('customize_register', [$this, 'customize_colors']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'], 20);
	}

	/**
	 * Adds colors section to customizer.
	 *
	 * @param  WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	public function customize_colors($wp_manager) {
		$this->color_section($wp_manager);
	}

	/**
	 * Registers the colors section.
	 *
	 * @param  WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	private function color_section($wp_manager) {
		$theme_config = vtl_theme_config();

		$wp_manager->add_section('colors', [
			'title'    => 'Colors',
			'priority' => 24,
		]);

		foreach ($theme_config['colors'] as $color) {

			$wp_manager->add_setting($color['id'], [
				'default'           => $color['default'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => [$this, 'sanitize'],
			]);

			$wp_manager->add_control(
				new WP_Customize_Color_Control(
					$wp_manager,
					$color['id'],
					[
						'label'    => $color['label'],
						'section'  => 'colors',
						'settings' => $color['id'],
					],
				)
			);
		}
	}

	/**
	 * Sanitizes font setting values.
	 *
	 * @param  string $input Selected option.
	 * @return string Sanitized option.
	 */
	public function sanitize($input) {
		return sanitize_hex_color($input);
	}

	/**
	 * Enqueues stylesheets.
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		$inline_style = [];

		if ($color_page = get_theme_mod('color_page')) {

			$inline_style[] = vtl_generate_css(
				'body',
				'background-color: ' . sanitize_hex_color($color_page)
			);
		}

		if ($color_utility_nav = get_theme_mod('color_utility_nav')) {

			$inline_style[] = vtl_generate_css(
				'.header-top, .utility-nav',
				'background-color: ' . sanitize_hex_color($color_utility_nav)
			);
		}

		if ($color_utility_nav_text = get_theme_mod('color_utility_nav_text')) {

			$inline_style[] = vtl_generate_css(
				'.header-top a',
				'color: ' . sanitize_hex_color($color_utility_nav_text)
			);

			$inline_style[] = vtl_generate_css(
				'.shop-nav-lg .shop-menu-cart-count',
				'background-color: ' . sanitize_hex_color($color_utility_nav_text)
			);
		}

		if ($color_main_nav = get_theme_mod('color_main_nav')) {

			$inline_style[] = vtl_generate_css(
				'.header-nav',
				'background-color: ' . sanitize_hex_color($color_main_nav)
			);
		}

		if ($color_main_nav_links = get_theme_mod('color_main_nav_text')) {

			$inline_style[] = vtl_generate_css(
				'.main-menu .menu-item-link',
				'color: ' . sanitize_hex_color($color_main_nav_links)
			);

			$inline_style[] = vtl_generate_css(
				'.main-menu .sub-menu .menu-item-link',
				'color: ' . sanitize_hex_color($color_main_nav_links)
			);
		}

		if ($color_main_nav_text_active = get_theme_mod('color_main_nav_text_active')) {

			$inline_style[] = vtl_generate_css(
				'.main-menu .menu-item-top-level:hover > .menu-link-cover > .menu-item-link, .main-menu .menu-item-top-level.menu-item-active > .menu-link-cover > .menu-item-link',
				'color: ' . sanitize_hex_color($color_main_nav_text_active)
			);

			$inline_style[] = vtl_generate_css(
				'.main-menu .menu-item-level-2:hover > .menu-link-cover > .menu-item-link',
				'background-color: ' . sanitize_hex_color($color_main_nav_text_active)
			);

			$inline_style[] = vtl_generate_css(
				'.main-menu .menu-item-level-3:hover > .menu-link-cover > .menu-item-link',
				'color: ' . sanitize_hex_color($color_main_nav_text_active)
			);
		}

		if ($color_footer = get_theme_mod('color_footer')) {

			$inline_style[] = vtl_generate_css(
				'.footer-top',
				'background-color: ' . sanitize_hex_color($color_footer)
			);
		}

		if ($color_footer_links = get_theme_mod('color_footer_text')) {

			$inline_style[] = vtl_generate_css(
				'.footer-top, .footer-top a',
				'color: ' . sanitize_hex_color($color_footer_links)
			);

			$inline_style[] = vtl_generate_css(
				'.footer .site-footer-social-nav path',
				'fill: ' . sanitize_hex_color($color_footer_links)
			);
		}

		if ($color_body = get_theme_mod('color_body')) {

			$inline_style[] = vtl_generate_css(
				'body, .has-body-color',
				'color: ' . sanitize_hex_color($color_body)
			);
		}

		if ($color_heading = get_theme_mod('color_heading')) {

			$inline_style[] = vtl_generate_css(
				'h1, h2, h3, h4, h5, h6, .has-heading-color',
				'color: ' . sanitize_hex_color($color_heading)
			);
		}

		if ($color_link = get_theme_mod('color_link')) {

			$inline_style[] = vtl_generate_css(
				'a, .has-link-color',
				'color: ' . sanitize_hex_color($color_link)
			);
		}

		for ($cc_index = 1; $cc_index < 13; $cc_index++) {

			if ($custom_color = get_theme_mod("color_custom_{$cc_index}")) {

				if ($cc_index === 1) {

					$inline_style[] = vtl_generate_css(
						'.primary-cta',
						[
							'background-color: ' . sanitize_hex_color($custom_color) . ' !important',
							'color: #fff !important',
						]
					);
				}

				if ($cc_index === 2) {

					$inline_style[] = vtl_generate_css(
						'.secondary-cta',
						[
							'border-style: solid',
							'border-width: 2px',
							'border-color: ' . sanitize_hex_color($custom_color) . ' !important',
							'color: ' . sanitize_hex_color($custom_color) . ' !important',
						]
					);
				}

				$inline_style[] = vtl_generate_css(
					".has-custom-color-{$cc_index}",
					'color: ' . sanitize_hex_color($custom_color) . ' !important'
				);

				$inline_style[] = vtl_generate_css(
					".has-custom-background-color-{$cc_index}",
					'background-color: ' . sanitize_hex_color($custom_color) . ' !important'
				);

				$inline_style[] = vtl_generate_css(
					".has-custom-fill-color-{$cc_index}",
					'fill: ' . sanitize_hex_color($custom_color) . ' !important'
				);
			}
		}

		if (!empty($inline_style)) {
			wp_add_inline_style('main_style', "/* Theme Colors */\n" . implode("\n", $inline_style));
		}
	}
}

new VTL_Customizer_Colors();

/**
 * Gets the theme colors.
 *
 * @return array Theme colors.
 */
function vtl_get_theme_colors() {
	$theme_config = vtl_theme_config();

	$colors = array_map(function($color) {

		return [
			'id'      => $color['id'],
			'slug'    => $color['slug'],
			'default' => $color['default'],
			'value'   => get_theme_mod($color['id']),
			'label'   => $color['label'],
		];
	}, $theme_config['colors']);

	return $colors;
}
