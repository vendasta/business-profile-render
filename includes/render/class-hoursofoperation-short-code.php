<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );
require_once( 'hoursofoperation.php' );

/**
 * Class HoursOfOperationShortCode - this will render a list
 */
class HoursOfOperationShortCode extends PlaintextShortCode {

	/**
	 * @return string - the HTML that renders the Hours of Operation
	 */
	protected function get_render_value(): string {
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );

		return hours_of_operation_html( $this->value, $class_name );
	}
}
