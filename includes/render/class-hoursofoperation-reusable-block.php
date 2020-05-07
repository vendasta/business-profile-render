<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );
require_once( 'hoursofoperation.php' );

/**
 * Class HoursOfOperationReusableBlock - this will render a list
 */
class HoursOfOperationReusableBlock extends ReusableBlock {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );
		$html       = hours_of_operation_html( $this->value, $class_name );

		return "<!-- wp:list -->$html<!-- /wp:list -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name;
	}
}
