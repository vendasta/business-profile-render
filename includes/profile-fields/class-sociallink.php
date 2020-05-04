<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-linked-image-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-linked-image-reusable-block.php' );

/**
 * Class SocialLink holds and displays the business' Social Link URL as plaintext or an icon
 */
abstract class SocialLink extends ProfileField {

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the general renderers plus renderers for icon-links
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		$renderers = parent::construct_renderers( $code_name, $readable_name, $value );
		array_push( $renderers,
			new LinkedImageShortCode( $code_name, $readable_name, $value, static::public_image_icon(), $image_styles = "height:32px;width:32px;" ),
			new LinkedImageReusableBlock( $code_name, $readable_name, $value, static::public_image_icon(), $image_styles = "height:32px;width:32px;" ),
		);

		return $renderers;
	}

	/**
	 * @return string the name of icon image file
	 */
	abstract protected static function public_image_icon(): string;

}
