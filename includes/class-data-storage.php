<?php
/**
 * This DataStorage Class is meant to fetch and access the Business Profile Data
 *
 * It is intended to operate as a Singleton to limit operations on the DataBase.
 * It is Read-Only - the data is written to the WordPress Options table by the hosting
 * platform.
 *
 * This class provides a `get` method that returns the value corresponding to the key. If there was
 * no data saved in the WordPress Option table, it will return default dummy data.
 *
 * {
 * "company_name": "Your Company",
 * "address": "6 W 29th St",
 * "city": "New York",
 * "state": "NY",
 * "zip": "10001",
 * "country": "US",
 * "contact_email": "email@email.com",
 * "work_number": [
 * "234-567-8901",
 * "(432) 343-2132",
 * ],
 * "toll_free_number": "800-234-0987",
 * "description": "This is testing the loooonoooong description",
 * "short_description": "your short description",
 * "contact_email": null,
 * "contact_first_name": "Jane",
 * "contact_last_name": "Doe",
 * "cell_number": "213-281-7668",
 * "images": {
 * "logo": "https://media-prod.apigateway.co/image/get/01ce062e-7f44-4dea-b0b1-f757334a2a5f",
 * "primary": "https://media-prod.apigateway.co/image/get/9eda55a6-37a3-422d-a6a4-af91f51a46b9"
 * },
 * "timezone": "America/New_York",
 * "foursquare_url": "https://foursquare.com/whatever",
 * "rss_url": "https://myrss.com/whatever",
 * "twitter_url": "https://twitter.com/whatever",
 * "facebook_url": "https://facebook.com/whatever",
 * "youtube_url": "https://youtube.com/whatever",
 * "instagram_url": "https://instagram.com/whatever",
 * "pinterest_url": "https://pinterest.com/whatever",
 * "linkedin_url": "https://linkedin.com/whatever",
 * "latitude": 40.7454277,
 * "longitude": -73.9877514,
 * "services_offered": [
 * "Some Service",
 * "Making you awesome",
 * ],
 * "hours_of_operation": [
 * {
 * "closes": "17:00:00",
 * "day_of_week": [
 * "Monday"
 * ],
 * "opens": "09:00:00",
 * "description": null
 * },
 * {
 * "closes": "20:00:00",
 * "day_of_week": [
 * "Tuesday",
 * "Wednesday",
 * "Thursday",
 * "Friday",
 * "Saturday",
 * "Sunday"
 * ],
 * "opens": "09:00:00",
 * "description": null
 * },
 * {
 * "closes": null,
 * "day_of_week": [
 * "PublicHolidays"
 * ],
 * "opens": null,
 * "description": "Closed on Christmas"
 * }
 * ]
 * }
 *
 */

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;


/**
 * Class DataStorage
 *
 * Loads the business profile data from the option
 */
class DataStorage {

	/**
	 * This is the name of the WordPress option that holds the encoded business profile data
	 */
	const OPTION_STORAGE_NAME = 'bpr_business_profile';

	/**
	 * @var null|DataStorage - the constructed instance of this class
	 */
	private static $singleton = null;
	/**
	 * @var null|array - the structured data representing the business profile as loaded from the WordPress option
	 */
	private $business_profile_array = null;

	/**
	 * @return DataStorage the constructed instance of this class
	 */
	public static function instance() {
		if ( is_null( self::$singleton ) ) {
			self::$singleton = new self();
			self::$singleton->load_data();
		}

		return self::$singleton;
	}

	/**
	 * get the value from the WordPress option, perform some validation and set it on this instance
	 */
	protected function load_data() {
		$this->business_profile_array = null;
		$option                       = get_option( $this::OPTION_STORAGE_NAME );

		if ( empty( $option ) ) {
			error_log( BUSINESS_PROFILE_RENDER_NAME . " Version " . BUSINESS_PROFILE_RENDER_VERSION .
			           " found no data in option " . $this::OPTION_STORAGE_NAME );
		} else {
			$this->business_profile_array = $option;
		}
	}

	/**
	 * @param string $property_name - name of the field in the business profile array (like "company_name")
	 *
	 * @return string|mixed|null - the value stored in the structured option data like ("Alphabet Inc.")
	 */
	public function get( $property_name ) {
		if ( is_null( $this->business_profile_array ) ) {
			return null;
		}

		if ( isset( $this->business_profile_array[ $property_name ] ) ) {
			return $this->business_profile_array[ $property_name ];
		}

		return "";
	}
}
