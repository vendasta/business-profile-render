<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );

/**
 * Class CompanyName holds and displays the name of the company
 * Like "Business Incorporated"
 */
class CompanyName extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "company_name";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Company Name";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The name of the business.";
	}
}
