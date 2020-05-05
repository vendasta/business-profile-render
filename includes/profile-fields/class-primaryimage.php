<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-image-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-image-reusable-block.php' );

/**
 * Class PrimaryImage holds and displays the business' Primary Image
 */
class PrimaryImage extends ProfileField {

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the general renderers plus renderers for icon-links
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		return array(
			new ImageShortCode( $code_name, $readable_name, $value ),
			new ImageReusableBlock( $code_name, $readable_name, $value ),
		);
	}

	/**
	 * @param DataStorage - the storage object
	 *
	 * @return string|mixed - return the value from the storage class
	 */
	protected function get_value( $storage ): string {
		$image_arr = $storage->get( static::profile_option_name() );

		return $image_arr["primary"];
	}

	/**
	 * @return string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "images";
	}

	/**
	 * @return string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Primary";
	}


}
