<?php
defined( 'ABSPATH' ) || exit;


/**
 * Class PlaintextShortCodeRenderer - Register the short code that can be inserted to render the datum
 */
class PlaintextShortCodeRenderer extends AbstractRenderer {

	/**
	 * @param $code_name - the name of this datum
	 *
	 * @return string - the code name with underscores replaced by hyphens
	 */
	public static function to_short_code_name( $code_name ) {
		return str_replace( "_", "-", $code_name );
	}

	/**
	 * @param $code_name - the name of this datum
	 *
	 * @return string - the short code ("company_name" becomes "[company-name]")
	 */
	public static function full_short_code( $code_name ) {
		return '[' . static::to_short_code_name( $code_name ) . ']';
	}

	/**
	 * Register the short code with WordPress
	 */
	public function register() {
		add_shortcode( static::to_short_code_name( $this->code_name ), array( $this, 'get_short_code_business_profile' ) );
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
			return static::full_short_code( $this->code_name );
		}

		return esc_attr( $this->value );
	}
}
