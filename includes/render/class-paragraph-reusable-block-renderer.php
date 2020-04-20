<?php
defined( 'ABSPATH' ) || exit;


/**
 * Class ParagraphReusableBlockRenderer - this is mostly an example that should be replaced
 */
class ParagraphReusableBlockRenderer extends AbstractReusableBlockRenderer {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content() {
		return '<!-- wp:paragraph -->
' . $this->value . '
<!-- /wp:paragraph -->';
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title() {
		return sanitize_title( 'paragraph ' . $this->readable_name );
	}
}