<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-renderer.php' );

/**
 * Class LinkedImageShortCode - Register the short code that can be inserted to render an image that acts as a link
 */
class LinkedImageShortCode extends Renderer {

	/**
	 * @var string the name of the shortcode (like "foursquare-icon-link" )
	 */
	protected $short_code_name;

	/**
	 * @var string the name of the image that renders the icon (like "foursquare.svg" )
	 */
	protected $image_name;

	/**
	 * @var string the styles applied to the img tag that renders the icon (like "foursquare.svg" )
	 */
	protected $image_styles;

	public function __construct( $code_name, $readable_name, $value, $image_name, $image_styles = "" ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->short_code_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' image link ' . $readable_name );
		$this->image_name      = $image_name;
		$this->image_styles    = $image_styles;
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

		$escaped_link          = esc_attr( $this->value );
		$escaped_image         = esc_attr( BUSINESS_PROFILE_RENDER_WEB_PATH_PUBLIC . 'images/' . $this->image_name );
		$escaped_readable_name = esc_attr( $this->readable_name );
		$escaped_style         = esc_attr( $this->image_styles );

		return "<a href=\"$escaped_link\" rel=\"nofollow\">
	<img src=\"$escaped_image\" alt=\"link to $escaped_readable_name\" style=\"$escaped_style\">
</a>";
	}
}
