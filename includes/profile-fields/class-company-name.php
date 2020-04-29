<?php


defined( 'ABSPATH' ) || exit;
require_once( 'class-bpr-field.php' );

/**
 * Class BPR_CompanyName holds and displays the name of the company
 */
class BPR_CompanyName extends BPR_Field {

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
}
