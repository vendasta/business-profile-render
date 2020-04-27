<?php

defined( 'ABSPATH' ) || exit;
require_once( 'class-abstract-reusable-block-renderer.php' );

/**
 * Class PlaintextReusableBlockRenderer - this is mostly an example that should be replaced
 */
class PlaintextReusableBlockRenderer extends ReusableBlockRenderer {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		return $this->value;
	}

	/**
	 * @return string - the name of the block - a change to this would be a breaking change
	 */
	protected function get_title(): string {
		return sanitize_title( $this->readable_name . ' Plaintext Block');
	}
}
