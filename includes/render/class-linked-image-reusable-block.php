<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );

/**
 * Class LinkedImageReusableBlock - This creates a block with an image that acts as a link
 */
class LinkedImageReusableBlock extends ReusableBlock {

	/**
	 * @var string the name of the image that renders the icon (like "foursquare.svg" )
	 */
	protected $image_name;

	/**
	 * @var string the styles applied to the img tag that renders the icon (like "foursquare.svg" )
	 */
	protected $image_styles;

	/**
	 * LinkedImageReusableBlock constructor.
	 *
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string $value - the URL of the image
	 * @param $image_name - the name of this specific image
	 * @param string $image_styles - specific inline styles to add to this image
	 */
	public function __construct( $code_name, $readable_name, $value, $image_name, $image_styles = "" ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->image_name   = $image_name;
		$this->image_styles = $image_styles;
	}

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		$escaped_link          = esc_attr( $this->value );
		$escaped_image         = esc_attr( BUSINESS_PROFILE_RENDER_WEB_PATH_PUBLIC . 'images/' . $this->image_name );
		$escaped_readable_name = esc_attr( $this->readable_name );
		$class_name            = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );
		$escaped_style         = esc_attr( $this->image_styles );

        $dashed_code_name =  str_replace('_', '-', $this->code_name);
		return "
<!-- wp:shortcode -->
	[business-profile-data-image-link-$dashed_code_name]
<!-- /wp:shortcode -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name . ' Image Link';
	}
}
