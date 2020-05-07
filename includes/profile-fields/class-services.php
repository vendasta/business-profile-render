<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-unordered-list-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-unordered-list-reusable-block.php' );

/**
 * Class Services holds and displays the business' services
 * Like "Siding installation" and "Roof Repair".
 */
class Services extends ProfileField {

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Services";
	}

	/**
	 * @return string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "services_offered";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The services this business most often provides.";
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the renderers that need to run while initializing WP in general
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		return array(
			new UnorderedListShortCode( $code_name, $readable_name, $value ),
			new UnorderedListReusableBlock( $code_name, $readable_name, $value ),
		);
	}
}
