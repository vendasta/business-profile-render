<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );

/**
 * Class LinkedImageReusableBlock - This creates a block with an image that acts as a link
 */
class LinkedImageReusableBlock extends ReusableBlock {

	/**
	 * @var string the name of the image that renders the icon (like "foursquare-social-logo-24x24.png" )
	 */
	protected $image_name;

	public function __construct( $code_name, $readable_name, $value, $image_name ) {
		parent::__construct( $code_name, $readable_name, $value );
		$this->image_name = $image_name;
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

		return "
<!-- wp:image -->
	<figure class=\"wp-block-image figure_$class_name\"><a class=\"a_$class_name\" href=\"$escaped_link\" rel=\"$escaped_link\"><img src=\"$escaped_image\" alt=\"link to $escaped_readable_name\"/></a></figure>
<!-- /wp:image -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name . ' Image Link';
	}
}
