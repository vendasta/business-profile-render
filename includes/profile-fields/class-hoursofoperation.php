<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-hoursofoperation-reusable-block.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-hoursofoperation-short-code.php' );

/**
 * Class HoursOfOperation holds and displays the business' open hours
 * Like:
 * Sunday & Monday: 11:00AM-4:00PM
 * Tuesday—Thursday: 10:00AM-5:00PM
 * Friday: 9:00AM-5:00PM
 * Saturday: 10:00AM-5:00PM some notes about this day
 * Public Holidays: Closed on all Holidays
 */
class HoursOfOperation extends ProfileField {

	const public_holidays_key = "PublicHolidays";
	const public_holidays = "Public Holidays";
	const ordered_days = array(
		"Sunday",
		"Monday",
		"Tuesday",
		"Wednesday",
		"Thursday",
		"Friday",
		"Saturday",
		HoursOfOperation::public_holidays
	);

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Hours of Operation";
	}

	/**
	 * @return string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "hours_of_operation";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	protected static function readable_description(): string {
		return "The hours of operation of the business.";
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the renderers that need to run while initializing WP in general
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {

		$unordered_hours = array();
		foreach ( $value as $entry ) {
			$opens       = $this->format_time_string( $entry["opens"] );
			$closes      = $this->format_time_string( $entry["closes"] );
			$description = $entry["description"];
			foreach ( $entry["day_of_week"] as $day ) {
				$open_to_close = $opens === "" ? "" : "$opens-$closes";
				if ( $day === $this::public_holidays_key ) {
					$day = $this::public_holidays;
				}
				$unordered_hours[ $day ] = "$open_to_close $description";
			}
		}

		$ordered_hours = array();
		foreach ( $this::ordered_days as $day ) {
			if ( array_key_exists( $day, $unordered_hours ) ) {
				$ordered_hours[ $day ] = $unordered_hours[ $day ];
			}
		}

		return array(
			new HoursOfOperationReusableBlock( $code_name, $readable_name, $ordered_hours ),
			new HoursOfOperationShortCode( $code_name, $readable_name, $ordered_hours ),
		);
	}

	protected function format_time_string( $input ): string {
		if ( $input === "" ) {
			return "";
		}
		$parts = explode( ":", $input );
		if ( count( $parts ) === 3 && end( $parts ) === "00" ) {
			array_pop( $parts );
		}
		if ( (int) $parts[0] > 12 ) {
			$parts[0] = (string) ( (int) $parts[0] - 12 );
			$append   = "PM";
		} else {
			$append = "AM";
		}

		return implode( ":", $parts ) . "$append";
	}
}
