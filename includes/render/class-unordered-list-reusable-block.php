<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-reusable-block.php' );

/**
 * Class UnorderedListReusableBlock - this will render a list
 */
class UnorderedListReusableBlock extends ReusableBlock {

	/**
	 * return the content of the reusable block
	 *
	 * @return string - the content of the block
	 */
	protected function block_content(): string {
		$class_name = sanitize_title( BUSINESS_PROFILE_RENDER_NAME . ' ' . $this->readable_name );
		if ( is_array( $this->value ) && count( $this->value ) > 0 ) {
			$list_elements = [];
			foreach ( $this->value as $service ) {
				array_push( $list_elements, "<li class='li-$class_name'>" . esc_attr( $service ) . "</li>" );
			}
			$formatted_list_elements = implode( "\n", $list_elements );
		} else {
			$formatted_list_elements = "<li class='li-$class_name'>Missing Services</li>\n<li class='li-$class_name'>Missing Services</li>";
		}

		return "<!-- wp:list -->
<ul class='ul-$class_name' style='padding-left: 0px; list-style: none;'>$formatted_list_elements</ul>
<!-- /wp:list -->";
	}

	/**
	 * @return string - the name of the block
	 */
	protected function get_title(): string {
		return 'BPR ' . $this->readable_name . ' List';
	}
}
