<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-imagefield.php' );

/**
 * Class PrimaryImage holds and displays the business' Primary Image
 */
class PrimaryImage extends ImageField {

	/**
	 * @return string the name of this image from the images array
	 */
	protected static function image_option_name(): string {
		return 'primary';
	}

	/**
	 * @return string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return 'Primary';
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "An image configured to be representative of the business.";
	}
}
