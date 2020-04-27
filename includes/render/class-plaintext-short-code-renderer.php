<?php

defined( 'ABSPATH' ) || exit;
require_once( 'class-abstract-renderer.php' );

/**
 * Class PlaintextShortCodeRenderer - Register the short code that can be inserted to render the datum
 */
class PlaintextShortCodeRenderer extends Renderer {

	/**
	 * @var string the name of the shortcode (like "company-name" )
	 */
	protected $short_code_name;

	public function __construct( $code_name, $readable_name, $value ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->short_code_name = str_replace( "_", "-", $code_name );
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

		return esc_attr( $this->value );
	}
}
