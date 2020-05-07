<?php

if ( ! function_exists( "hours_of_operation_html" ) ) {

	/**
	 * @param $hours_array - an associative array mapping day to hours+notes
	 * @param $class_name - a base class to apply to the html elements
	 *
	 * @return string
	 */
	function hours_of_operation_html( $hours_array, $class_name ): string {
		if ( is_array( $hours_array ) && count( $hours_array ) > 0 ) {
			$list_elements = array();

			$prev_hours       = "";
			$consecutive_days = array();

			foreach ( $hours_array as $day => $hours ) {
				if ( $prev_hours === $hours ) {
					array_push( $consecutive_days, $day );
				} else {
					$list_element = get_list_element( $class_name, $consecutive_days, $prev_hours );
					if ( $list_element !== "" ) {
						array_push( $list_elements, $list_element );
					}
					$prev_hours       = $hours;
					$consecutive_days = array( $day );
				}
			}

			$list_element = get_list_element( $class_name, $consecutive_days, $prev_hours );
			if ( $list_element !== "" ) {
				array_push( $list_elements, $list_element );
			}
			$formatted_list_elements = implode( "\n", $list_elements );
		} else {
			$formatted_list_elements = "<li class='li-$class_name'>Missing Hours of Operation</li>";
		}

		return "<ul class='ul-$class_name'>$formatted_list_elements</ul>";
	}
}

if ( ! function_exists( "get_list_element" ) ) {

	/**
	 * @param string $class_name  - a base class to apply to the html elements
	 * @param array $consecutive_days - an array of consecutive days that have the same hours+notes
	 * @param string $hours - describes the range of open hours
	 *
	 * @return string - <li> element describing one date range like <li class="li-some-class">Monday-Friday: 9AM-5PM</li>
	 */
	function get_list_element( $class_name, $consecutive_days, $hours ): string {
		switch ( count( $consecutive_days ) ) {
			case 0:
				$result = "";
				break;
			case 1:
				$day = $consecutive_days[0];
				$result = "<li class='li-$class_name'>" . esc_attr( "$day: $hours" ) . "</li>";
				break;
			case 2:
				$result = "<li class='li-$class_name'>" . esc_attr( implode( " & ", $consecutive_days ) . ": $hours" ) . "</li>";
				break;
			default:
				$first_day = $consecutive_days[0];
				$last_day  = array_pop( $consecutive_days );

				$result = "<li class='li-$class_name'>" . esc_attr( "$first_day" . "—" . "$last_day: $hours" ) . "</li>";
				break;
		}
		return $result;
	}
}