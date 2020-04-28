<?php

defined( 'ABSPATH' ) || exit;
require_once( 'class-abstract-reusable-block-renderer.php' );

/**
 * Class PlainTextReusableBlockRenderer - this is mostly an example that should be replaced
 */
class PlaintextReusableBlockRenderer extends ReusableBlockRenderer {

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
		return sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name . ' Plaintext Block');
	}
}
