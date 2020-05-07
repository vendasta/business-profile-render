<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class Twitter holds and displays the business' Twitter URL
 * Like "https://twitter.com/v/your-business/4b58f0ccf964a5206c7428e3"
 */
class Twitter extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "twitter_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Twitter URL";
	}

	/**
	 * @return string the name of icon image file
	 * This image was taken from https://about.twitter.com/en_us/company/brand-resources.html
	 */
	protected static function public_image_icon(): string {
		return "twitter.svg";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The URL of the business' Twitter Page.";
	}

}
