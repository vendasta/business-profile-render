<?php

defined( 'ABSPATH' ) || exit;


$example_json_string = '{
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
}';

/**
 * Class BusinessDataStorage
 *
 * Loads the business profile data from the option
 */
class BusinessDataStorage {

	/**
	 * This is the name of the WordPress option that holds the encoded business profile data
	 */
	const OPTION_STORAGE_NAME = 'bpr_business_profile';

	/**
	 * @var null|BusinessDataStorage - the constructed instance of this class
	 */
	private static $singleton = null;
	/**
	 * @var null|array - the structured data representing the business profile as loaded from the WordPress option
	 */
	private $business_profile_array = null;

	/**
	 * @return BusinessDataStorage the constructed instance of this class
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

		if (empty( $option ) ) {
			error_log( BUSINESS_PROFILE_RENDER_NAME . " Version " . BUSINESS_PROFILE_RENDER_VERSION .
			           " found no data in option " . $this::OPTION_STORAGE_NAME );
		} else {
			$this->business_profile_array = $option;
		}
	}

	/**
	 * @param string $property_name - name of the field in the business profile array (like "company_name")
	 *
	 * @return string|null - the value stored in the structured option data like ("Alphabet Inc.")
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
