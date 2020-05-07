<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-imagefield.php' );

/**
 * Class LogoImage holds and displays the business' Logo Image
 */
class LogoImage extends ImageField {

	/**
	 * @return string the name of this image from the images array
	 */
	protected static function image_option_name(): string {
		return 'logo';
	}

	/**
	 * @return string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return 'Logo';
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The image configured to represent the Logo of the business.";
	}
}
