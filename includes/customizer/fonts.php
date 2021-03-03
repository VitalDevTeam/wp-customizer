<?php
/**
 * Customizer fonts section.
 */
class VTL_Customizer_Fonts {

	/**
	 * The font choices.
	 *
	 * @var array
	 */
	private $font_choices;

	public function __construct() {

		$this->font_choices = [
			'Lato:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap'   => 'Lato',
			'Merriweather:ital,wght@0,400;0,700;1,400;1,700&display=swap' => 'Merriweather',
		];

		add_action('customize_register', [$this, 'customize_fonts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'], 20);
	}

	/**
	 * Adds fonts section to customizer.
	 *
	 * @param  WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	public function customize_fonts($wp_manager) {
		$this->fonts_section($wp_manager);
	}

	/**
	 * Registers the fonts section.
	 *
	 * @param  WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	private function fonts_section($wp_manager) {

		$wp_manager->add_section('fonts', [
			'title'    => 'Fonts',
			'priority' => 24,
		]);

		$wp_manager->add_setting('font_headings', [
			'default'           => 'Lato:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => [$this, 'sanitize'],
		]);

		$wp_manager->add_control('font_headings', [
			'type'        => 'select',
			'description' => 'Select font for headings.',
			'section'     => 'fonts',
			'choices'     => $this->font_choices,
		]);

		$wp_manager->add_setting('font_body', [
			'default'           => 'Lato:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => [$this, 'sanitize'],
		]);

		$wp_manager->add_control('font_body', [
			'type'        => 'select',
			'description' => 'Select font for body text.',
			'section'     => 'fonts',
			'choices'     => $this->font_choices,
		]);
	}

	/**
	 * Sanitizes font setting values.
	 *
	 * @param  string $input Selected option.
	 * @return string Sanitized option.
	 */
	public function sanitize($input) {

		if (array_key_exists($input, $this->font_choices)) {
			return $input;
		} else {
			return '';
		}
	}

	/**
	 * Enqueues stylesheets.
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		$inline_style = [];

		if ($font_headings = get_theme_mod('font_headings')) {

			wp_enqueue_style(
				'font_headings',
				'https://fonts.googleapis.com/css2?family=' . esc_attr($font_headings),
				false
			);

			$font_pieces = explode(':', $font_headings);

			$inline_style[] = vtl_generate_css(
				'h1, h2, h3, h4, h5, h6, .has-heading-font',
				'font-family: ' . esc_html($font_pieces[0])
			);
		}

		if ($body_font = get_theme_mod('font_body')) {

			wp_enqueue_style(
				'font_body',
				'https://fonts.googleapis.com/css2?family=' . esc_attr($body_font),
				false
			);

			$font_pieces = explode(':', $body_font);

			$inline_style[] = vtl_generate_css(
				'body, button, input, select, textarea, .has-body-font',
				'font-family: ' . esc_html($font_pieces[0])
			);
		}

		if (!empty($inline_style)) {
			wp_add_inline_style('main_style', "/* Theme Fonts */\n" . implode("\n", $inline_style));
		}
	}
}

new VTL_Customizer_Fonts();


