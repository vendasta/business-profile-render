<?php

if ( ! function_exists( "unordered_list_html" ) ) {
	/**
	 * @param $value_array - the values to be converted to list entries
	 * @param $class_name - the basic class name to be applied to each entry and the overall list
	 *
	 * @return string - the HTML that should be rendered to represent the list
	 */
	function unordered_list_html( $value_array, $class_name ): string {
		if ( is_array( $value_array ) && count( $value_array ) > 0 ) {
			$list_elements = [];
			foreach ( $value_array as $list_element ) {
				array_push( $list_elements, "<li class='li-$class_name'>" . esc_attr( $list_element ) . "</li>" );
			}
			$formatted_list_elements = implode( "\n", $list_elements );
		} else {
			$formatted_list_elements = "<li class='li-$class_name'>None Configured</li>";
		}

		return "<ul class='ul-$class_name' style='padding-left: 0px; list-style: none;'>\n$formatted_list_elements\n</ul>";
	}
}