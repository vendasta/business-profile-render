<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );

/**
 * Class LinkedImageShortCode - Register the short code that can be inserted to render an image that acts as a link
 */
class LinkedImageShortCode extends PlaintextShortCode {

	/**
	 * @var string the name of the image that renders the icon (like "foursquare.svg" )
	 */
	protected $image_name;

	/**
	 * @var string the styles applied to the img tag that renders the icon (like "foursquare.svg" )
	 */
	protected $image_styles;

	/**
	 * LinkedImageShortCode constructor.
	 *
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string $value - the URL of the image
	 * @param $image_name - the name of this specific image
	 * @param string $image_styles - specific inline styles to add to this image
	 */
	public function __construct( $code_name, $readable_name, $value, $image_name, $image_styles = "" ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->short_code_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' image link ' . $readable_name );
		$this->image_name      = $image_name;
		$this->image_styles    = $image_styles;
	}

	/**
	 * @return string - the HTML that renders the image tag
	 */
	protected function get_render_value(): string {

		$escaped_link          = esc_attr( $this->value );
		$escaped_image         = esc_attr( BUSINESS_PROFILE_RENDER_WEB_PATH_PUBLIC . 'images/' . $this->image_name );
		$escaped_readable_name = esc_attr( $this->readable_name );
		$escaped_style         = esc_attr( $this->image_styles );

		return "<a href=\"$escaped_link\" rel=\"nofollow\">
	<img src=\"$escaped_image\" alt=\"link to $escaped_readable_name\" style=\"$escaped_style\">
</a>";
	}
}
