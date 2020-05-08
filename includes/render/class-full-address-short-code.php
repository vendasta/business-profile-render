<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );
require_once( 'unordered-list.php' );

/**
 * Class FullAddressShortCode - this will render a list
 */
class FullAddressShortCode extends PlaintextShortCode {

	/**
	 * @return string - the HTML that renders the Hours of Operation
	 */
	protected function get_render_value(): string {
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );

		return unordered_list_html( $this->value, $class_name );
	}
}
