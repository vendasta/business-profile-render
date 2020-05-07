<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class Facebook holds and displays the business' Facebook URL
 * Like "https://www.facebook.com/your-business/"
 */
class Facebook extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "facebook_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Facebook URL";
	}

	/**
	 * @return string the name of icon image file
	 */
	protected static function public_image_icon(): string {
		return "facebook.svg";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The URL of the business' Facebook Page.";
	}
}
