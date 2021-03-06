<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );

/**
 * Class City holds and displays the business' city
 * Like "London"
 */
class City extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "city";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "City";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The city in which the business is located (ie 'London').";
	}
}
