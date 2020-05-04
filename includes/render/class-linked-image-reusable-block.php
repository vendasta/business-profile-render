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

	public function __construct( $code_name, $readable_name, $value, $image_name, $image_styles = "" ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->image_name = $image_name;
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

		return "
<!-- wp:image -->
	<figure class=\"wp-block-image figure_$class_name\"><a class=\"a_$class_name\" href=\"$escaped_link\" rel=\"$escaped_link\"><img src=\"$escaped_image\" alt=\"link to $escaped_readable_name\" style=\"$escaped_style\"/></a></figure>
<!-- /wp:image -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name . ' Image Link';
	}
}
