<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class LinkedIn holds and displays the business' LinkedIn URL
 * Like "https://www.linkedin.com/company/your-business/"
 */
class LinkedIn extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "linkedin_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "LinkedIn URL";
	}

	/**
	 * @return string the name of icon image file
	 */
	protected static function public_image_icon(): string {
		return "linkedin.svg";
	}

}
