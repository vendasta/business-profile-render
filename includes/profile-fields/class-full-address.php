<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-full-address-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-full-address-reusable-block.php' );

/**
 * Class State holds and displays the business' Full Address
 * Like:
 * 123 Main Street
 * Springfield, KY
 * 90210
 * US
 */
class FullAddress extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		// this method isn't useful for this class
		return "";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Full Address";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The Full Address at which the business is located, (street address, city, state, zip, country).";
	}

	/**
	 * @param DataStorage - the storage object
	 *
	 * @return array - return the values from the storage class
	 */
	protected function get_value( $storage ) {
		$city  = $storage->get( "city" );
		$state = $storage->get( "state" );
		$zip   = $storage->get( "zip" );
		if ( $city !== "" && $state !== "" ) {
			$city_state_zip = "$city, $state $zip";
		} else {
			$city_state_zip = "$city$state $zip";
		}

		return array(
			"address"        => $storage->get( "address" ),
			"city_state_zip" => $city_state_zip,
			"country"        => $storage->get( "country" ),
		);
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
			new FullAddressShortCode( $code_name, $readable_name, $value ),
			new FullAddressReusableBlock( $code_name, $readable_name, $value ),
		);
	}
}
