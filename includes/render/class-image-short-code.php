<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );

/**
 * Class ImageShortCode - Register the short code that can be inserted to render an image
 */
class ImageShortCode extends PlaintextShortCode {

	/**
	 * @return string - the HTML that renders the image tab
	 */
	protected function get_render_value(): string {
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
