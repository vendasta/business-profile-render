<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class Pinterest holds and displays the business' LinkedIn URL
 * Like "https://www.pinterest.ca/your-business/"
 */
class Pinterest extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "pinterest_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Pinterest URL";
	}

	/**
	 * @return string the name of icon image file
	 */
	protected static function public_image_icon(): string {
		return "pinterest.svg";
	}

}
