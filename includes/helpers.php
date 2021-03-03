<?php
/**
 * Returns the custom logo as set in the customizer, linked to home.
 * If the logo is SVG its markup will be used inline instead of a default <img>.
 *
 * @param  int    $blog_id ID of the blog in question. Default is the ID of the current blog.
 * @return string          Custom logo markup.
 */
function vtl_get_custom_logo($blog_id = 0) {
	$html = '';
	$switched_blog = false;

	if (is_multisite() && ! empty($blog_id) && get_current_blog_id() !== (int) $blog_id) {
		switch_to_blog($blog_id);
		$switched_blog = true;
	}

	$custom_logo_id = get_theme_mod('custom_logo');

	if ($custom_logo_id) {
		$custom_logo_attr = array(
			'class' => 'custom-logo-img',
		);

		$image_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
		if (empty($image_alt)) {
			$custom_logo_attr['alt'] = get_bloginfo('name', 'display');
		}

		$custom_logo_path = get_attached_file($custom_logo_id);

		if (preg_match('/^(.*?)\/(.*?)\.svg$/i', $custom_logo_path) && file_exists($custom_logo_path)) {

			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link has-inline-svg" rel="home" itemprop="url"><span itemprop="logo">%2$s</span></a>',
				esc_url(home_url('/')),
				file_get_contents($custom_logo_path)
			);

		} else {

			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url"><span itemprop="logo">%2$s</span></a>',
				esc_url(home_url('/')),
				wp_get_attachment_image($custom_logo_id, 'full', false, $custom_logo_attr)
			);
		}
	} elseif (is_customize_preview()) {

		/**
		 * This block executes only when a new logo has been added in the customizer.
		 * It will not execute if logo already exists and customizer is reloaded.
		 * Image must remain an <img> here so that the JavaScript can load the logo's source into preview.
		 */

		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" style="display: none;"><img class="custom-logo" /></a>',
			esc_url(home_url('/'))
		);
	}

	$html = sprintf(
		'<div class="custom-logo" itemscope itemtype="http://schema.org/Organization">%s</div>',
		$html
	);

	if ($switched_blog) {
		restore_current_blog();
	}

	/**
	 * Filters the custom logo output.
	 *
	 * @param string $html    Custom logo HTML output.
	 * @param int    $blog_id ID of the blog to get the custom logo for.
	 */
	return apply_filters('vtl_get_custom_logo', $html, $blog_id);
}

/**
 * Displays the custom logo as set in the customizer, linked to home.
 *
 * @param int $blog_id ID of the blog in question. Default is the ID of the current blog.
 */
function vtl_the_custom_logo($blog_id = 0) {
	echo vtl_get_custom_logo($blog_id);
}

/**
 * Generates a CSS rule.
 *
 * @param  string       $selector The CSS selector(s).
 * @param  string|array $style    The CSS styles.
 * @param  string       $value    The CSS value.
 * @param  string       $mq       The CSS media query.
 * @param  bool         $echo     Echo the styles.
 * @return string
 */
function vtl_generate_css($selector = '', $style = '', $mq = '', $echo = false) {

	$css = '';

	if (!$selector) {
		return;
	}

	if (is_array($style)) {
		$style = implode('; ', $style);
		$style = str_replace(';;', ';', $style);
	} else {
		$style = rtrim($style, ';') . ';';
	}

	$css = sprintf(
		'%s { %s }',
		$selector,
		$style
	);

	if ($mq) {

		$css = sprintf(
			'@media (%s) { %s }',
			$mq,
			$css
		);
	}

	if ($echo) {
		echo $css;
	}

	return $css;
}
