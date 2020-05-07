<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-renderer.php' );

/**
 * Class PlaintextShortCode - Register the short code that can be inserted to render the datum
 */
class PlaintextShortCode extends Renderer {

	/**
	 * @var string the name of the shortcode (like "company-name" )
	 */
	protected $short_code_name;

	public function __construct( $code_name, $readable_name, $value ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->short_code_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $readable_name );
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

		return $this->get_render_value();
	}

	/**
	 * @return string - the HTML explaining how to use this renderer
	 */
	protected function get_instruction_html(): string {
		$short_code = '[' . $this->short_code_name . ']';

		return "To use this Shortcode, use <code>$short_code</code>";
	}

	/***
	 * @return string - the heading for the section explaining how to use this renderer
	 */
	protected function get_usage_heading(): string {
		return "$this->readable_name ShortCode";
	}
}
