<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );
require_once( 'unordered-list.php' );

/**
 * Class UnorderedListShortCode - Register the short code that can be inserted to render the datum
 */
class UnorderedListShortCode extends PlaintextShortCode {

	/***
	 * @return string - the rendered HTML content this renderer produces
	 */
	protected function get_render_value(): string {
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );

		return unordered_list_html( $this->value, $class_name );
	}
}
