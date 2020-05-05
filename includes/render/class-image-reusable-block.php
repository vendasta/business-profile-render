<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );

/**
 * Class ImageReusableBlock - This creates a block with an image
 */
class ImageReusableBlock extends ReusableBlock {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		$escaped_image         = esc_attr( $this->value );
		$escaped_readable_name = esc_attr( $this->readable_name );
		$class_name            = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );

		return "
<!-- wp:image -->
	<figure class=\"wp-block-image figure_$class_name\"><img src=\"$escaped_image\" alt=\"$escaped_readable_name\"/></figure>
<!-- /wp:image -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name . ' Image';
	}
}
