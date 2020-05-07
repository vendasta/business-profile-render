<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-sociallink.php' );

/**
 * Class Foursquare holds and displays the business' Foursquare URL
 * Like "https://foursquare.com/v/your-business/4b58f0ccf964a5206c7428e3"
 */
class Foursquare extends SocialLink {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "foursquare_url";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Foursquare URL";
	}

	/**
	 * @return string the name of icon image file
	 * these images were taken from https://foursquare.com/about/logos
	 */
	protected static function public_image_icon(): string {
		return "foursquare.svg";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The URL of the business' Foursquare Page.";
	}

}
