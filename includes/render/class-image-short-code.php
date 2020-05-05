<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-renderer.php' );

/**
 * Class ImageShortCode - Register the short code that can be inserted to render an image
 */
class ImageShortCode extends Renderer {

	/**
	 * @var string the name of the shortcode (like "primary-image" )
	 */
	protected $short_code_name;

	public function __construct( $code_name, $readable_name, $value ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->short_code_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' image ' . $readable_name );
	}

	/**
	 * Register the short code with WordPress
	 */
	public function register(): void {
		add_shortcode( $this->short_code_name, array(
			$this,
			'get_short_code_business_profile'
		) );
	}

	/**
	 * This runs to render content when the short code is used on a page
	 *
	 * @param $atts
	 * @param null $content
	 * @param string $code
	 *
	 * @return string|void - the value stored in the business datum's setting
	 */
	public function get_short_code_business_profile( $atts, $content = null, $code = '' ) {
		if ( is_feed() ) {
			return '[' . $this->short_code_name . ']';
		}

		$escaped_image         = esc_attr( $this->value );
		$escaped_readable_name = esc_attr( $this->readable_name );
		$class_name            = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );

		if ( $escaped_image === "" ) {
			$alt_text = "no image configured for $escaped_readable_name";
		} else {
			$alt_text = $escaped_readable_name;
		}

		return "
<div class=\"$class_name\">
	<img src=\"$escaped_image\" alt=\"$alt_text\">
</div>";
	}
}
