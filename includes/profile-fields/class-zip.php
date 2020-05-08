<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );

/**
 * Class State holds and displays the business' Zip Code
 * Like "90210"
 */
class ZipCode extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "zip";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Zip Code";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The Zip Code in which the business is located (ie '90210').";
	}
}
