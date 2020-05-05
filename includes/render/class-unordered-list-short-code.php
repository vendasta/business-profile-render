<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-plaintext-short-code.php' );

/**
 * Class UnorderedListShortCode - Register the short code that can be inserted to render the datum
 */
class UnorderedListShortCode extends PlaintextShortCode {

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
		if ( is_array( $this->value ) && count( $this->value ) > 0 ) {
			$list_elements = [];
			foreach ( $this->value as $service ) {
				array_push( $list_elements, "<li class='li-$class_name'>" . esc_attr( $service ) . "</li>" );
			}
			$formatted_list_elements = implode( "\n", $list_elements );
		} else {
			$formatted_list_elements = "<li class='li-$class_name'>Missing Services</li>\n<li class='li-$class_name'>Missing Services</li>";
		}

		return "<div class='div-$class_name'>\n<ul class='ul-$class_name'>\n$formatted_list_elements\n</ul>\n</div>";
	}
}
