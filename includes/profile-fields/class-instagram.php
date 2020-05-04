<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class Twitter holds and displays the business' Instagram URL
 * Like "https://twitter.com/v/your-business/4b58f0ccf964a5206c7428e3"
 */
class Instagram extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "instagram_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Instagram URL";
	}

	/**
	 * @return string the name of icon image file
	 */
	protected static function public_image_icon(): string {
		return "instagram.svg";
	}

}
