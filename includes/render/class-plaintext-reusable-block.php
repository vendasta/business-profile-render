<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );

/**
 * Class PlaintextReusableBlock - this is mostly an example that should be replaced
 */
class PlaintextReusableBlock extends ReusableBlock {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		return '<!-- wp:paragraph -->
' . $this->value . '
<!-- /wp:paragraph -->';
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name . ' Plaintext Block' );
	}
}
