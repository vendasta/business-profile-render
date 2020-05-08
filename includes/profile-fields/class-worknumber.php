<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );

/**
 * Class WorkNumber holds and displays the business' Work Number
 * Like "306-234-5678". It returns the first number if there are multiple
 */
class WorkNumber extends ProfileField {

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Work Number";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The Phone Number that can be used to contact this business.";
	}

	/**
	 * @param DataStorage - the storage object
	 *
	 * @return string|mixed - return the value from the storage class
	 */
	protected function get_value( $storage ): string {
		$work_number_array = $storage->get( static::profile_option_name() );
		if ( is_array( $work_number_array ) && count( $work_number_array ) > 0 ) {
			return $work_number_array[0];
		}

		return "";
	}

	/**
	 * @return string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "work_number";
	}
}
