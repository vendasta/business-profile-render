<?php
defined( 'ABSPATH' ) || exit;


$example_json_string = `{
	"company_name": "nTest",
	"description": "This is testing the loooong description",
	"short_description": null,
	"services_offered": [
		"Being Awesome",
		"Making you awesome",
		"Dirty deeds done dirt cheap"
	],
	"contact_first_name": null,
	"contact_last_name": null,
	"contact_email": null,
	"cell_number": "213-281-7668",
	"fax_number": "Throw out all the fax machines",
	"toll_free_number": null,
	"work_number": [
		"7183841638"
	],
	"address": "6 W 29th St",
	"city": "New York",
	"zip": "10001",
	"state": "NY",
	"country": "US",
	"timezone": "America/New_York",
	"longitude": -73.9877514,
	"latitude": 40.7454277,
	"hours_of_operation": [
		{
			"closes": "17:00:00",
			"opens": "09:00:00",
			"day_of_week": [
			"Monday"
		],
			"description": null
		},
		{
			"closes": "17:00:00",
			"opens": "09:00:00",
			"day_of_week": [
			"Wednesday"
		],
			"description": null
		},
		{
			"closes": null,
			"opens": null,
			"day_of_week": [
			"PublicHolidays"
		],
			"description": "Closed on Christmas"
		}
	],
	"images": {
		"logo": "https://media-prod.apigateway.co/image/get/4d1fc154-05b1-43ef-a168-1700aa919e41",
		"primary": "https://media-prod.apigateway.co/image/get/2fd2dbd2-8150-4c62-b623-e7284b93d20b"
	},
	"rss_url": null,
	"twitter_url": null,
	"foursquare_url": null,
	"facebook_url": null,
	"youtube_url": null,
	"instagram_url": null,
	"pinterest_url": null,
	"linkedin_url": null
}`;

/**
 * Class BusinessDataStorage
 *
 * Loads the business profile data from the option
 */
class BusinessDataStorage {

	/**
	 * This is the name of the WordPress option that holds the encoded business profile data
	 */
	const OPTION_STORAGE_NAME = BUSINESS_PROFILE_RENDER_NAMESPACE . '_business_profile';

	/**
	 * @var null|BusinessDataStorage - the constructed instance of this class
	 */
	private static $_singleton = null;
	/**
	 * @var null|array - the structured data representing the business profile as loaded from the WordPress option
	 */
	private $business_profile_array = null;
	/**
	 * @var bool - set to true if the business profile data was set in the WordPress option
	 */
	private $_business_profile_found = false;

	/**
	 * @return BusinessDataStorage the constructed instance of this class
	 */
	public static function instance() {
		if ( is_null( self::$_singleton ) ) {
			self::$_singleton = new self();
			self::$_singleton->load_data();
		}

		return self::$_singleton;
	}

	/**
	 * get the value from the WordPress option, perform some validation and set it on this instance
	 */
	protected function load_data() {
		$encoded_data = get_option( $this::OPTION_STORAGE_NAME );
		if ( $encoded_data == null || $encoded_data == "" || $encoded_data == "{}" ) {
			$this->_business_profile_found = false;
			$this->business_profile_array  = null;
			error_log( BUSINESS_PROFILE_RENDER_NAME . " Version " . BUSINESS_PROFILE_RENDER_VERSION .
			           " found no data in option " . $this::OPTION_STORAGE_NAME );
		} else {
			$this->_business_profile_found = true;
			$data                          = json_decode( $encoded_data );
			if ( is_object( $data ) || is_array( $data ) ) {
				$this->business_profile_array = $data;
			}
			error_log( BUSINESS_PROFILE_RENDER_NAME . " Version " . BUSINESS_PROFILE_RENDER_VERSION .
			           " cannot parse option " . $this::OPTION_STORAGE_NAME . ": $encoded_data" );
		}
	}

	/**
	 * @param string $property_name - name of the field in the business profile array (like "company_name")
	 *
	 * @return mixed|null - the value stored in the structured option data like ("Alphabet Inc.")
	 */
	public function get( $property_name ) {
		if ( isset( $this->business_profile_array[ $property_name ] ) ) {
			return $this->business_profile_array[ $property_name ];
		}

		return null;
	}

	/**
	 * @return boolean - returns true if the option was saved
	 */
	public function business_profile_found() {
		return $this->_business_profile_found;
	}
}
