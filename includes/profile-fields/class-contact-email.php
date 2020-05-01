<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );

/**
 * Class City holds and displays the business' contact email
 * Like "contact-us@example.com"
 */
class ContactEmail extends ProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "contact_email";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Contact Email";
	}
}
