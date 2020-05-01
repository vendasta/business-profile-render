<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-linked-image-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-linked-image-reusable-block.php' );

/**
 * Class Foursquare holds and displays the business' Foursquare URL
 * Like "https://foursquare.com/v/your-business/4b58f0ccf964a5206c7428e3"
 */
class Foursquare extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "foursquare_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Foursquare URL";
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the general renderers plus renderers for icon-links
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		$renderers = parent::construct_renderers( $code_name, $readable_name, $value );

		// these images were taken from https://foursquare.com/about/logos
		array_push( $renderers,
			new LinkedImageShortCode( $code_name, $readable_name, $value, "foursquare-social-logo-32x32.png" ),
			new LinkedImageReusableBlock( $code_name, $readable_name, $value, "foursquare-social-logo-32x32.png" ),
		);

		return $renderers;
	}

}
