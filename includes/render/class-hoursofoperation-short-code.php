<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );
require_once( 'hoursofoperation.php' );

/**
 * Class HoursOfOperationShortCode - this will render a list
 */
class HoursOfOperationShortCode extends PlaintextShortCode {


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
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );
		return hours_of_operation_html($this->value, $class_name);
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name;
	}
}
