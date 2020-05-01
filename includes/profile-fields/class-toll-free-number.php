<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );

/**
 * Class City holds and displays the business' Toll Free Number
 * Like "800-234-5678"
 */
class TollFreeNumber extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "toll_free_number";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Toll Free Number";
	}
}
