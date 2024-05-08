<?php
namespace BusinessProfileRender\Deprecated;

/**
 * Class Deprecated
 * Simplified class that handles shortcode registration and data retrieval through a unified method.
 */
class Deprecated {

    /**
     * Initializes the shortcodes for various business profile data elements.
     */
    public static function init() {
        $shortcodes = [
            'business-profile-data-company-name'              => 'company_name',
            'business-profile-data-address'                   => 'address',
            'business-profile-data-city'                      => 'city',
            'business-profile-data-state'                     => 'state',
            'business-profile-data-zip-code'                  => 'zip',
            'business-profile-data-country'                   => 'country',
            'business-profile-data-toll-free-number'          => 'toll_free_number',
            'business-profile-data-company-description'       => 'description',
            'business-profile-data-company-short-description' => 'short_description',
            'business-profile-data-image-link-foursquare-url' => 'foursquare_url',
            'business-profile-data-image-link-twitter-url'    => 'twitter_url',
            'business-profile-data-image-link-instagram-url'  => 'instagram_url',
            'business-profile-data-image-link-linkedin-url'   => 'linkedin_url',
            'business-profile-data-image-link-pinterest-url'  => 'pinterest_url',
            'business-profile-data-image-link-facebook-url'   => 'facebook_url',
            'business-profile-data-image-link-rss-url'        => 'rss_url',
            'business-profile-data-image-link-youtube-url'    => 'youtube_url',
        ];

        foreach ($shortcodes as $shortcode => $attr) {
            add_shortcode($shortcode, function() use ($attr) {
                return self::get_data_bpr($attr);
            });
        }

        add_shortcode('business-profile-data-full-address', function() {
            return self::business_profile_data_full_address();
        });

        add_shortcode('business-profile-data-work-number', function() {
            return self::business_profile_data_work_number();
        });

        add_shortcode('business-profile-data-hours-of-operation', function() {
            return self::business_profile_data_hours_of_operation();
        });

        add_shortcode('business-profile-data-services', function() {
            return self::business_profile_data_services();
        });

        add_shortcode('business-profile-data-logo', function() {
            return self::business_profile_data_images_logo();
        });

        add_shortcode('business-profile-data-primary', function() {
            return self::business_profile_data_images_primary();
        });
    }

    public static function business_profile_data_full_address() {
        $address = "";
        $full_address = array("address", "city", "state", "zip", "country");
        foreach ($full_address as $attr) {
            if (!empty(self::get_data_bpr($attr))) {
                $address .= self::get_data_bpr($attr) . " ";
            }
            
        }
        return $address;
    }
    
    public static function business_profile_data_work_number() {
        return self::get_data_bpr('work_number');
    }

    public static function business_profile_data_hours_of_operation() {
        return self::get_data_bpr('hours_of_operation');
    }

    public static function business_profile_data_services() {
        return self::get_data_bpr('services_offered');
    }

    public static function business_profile_data_images_logo() {
        return self::get_data_bpr('logo');
    }

    public static function business_profile_data_images_primary() {
        return self::get_data_bpr('primary');
    }



    /**
     * Retrieves data for a given attribute from the stored business profile options.
     * @param string $attr Attribute name to retrieve the data for.
     * @return mixed The data associated with the attribute, or an empty string if not set.
     */

    public static function get_data_bpr($attr) {
        $json_data = get_option('bpr_business_profile');

        if (empty($json_data)) {
            return '';
        }
        
        if (!$json_data) {
            return "Business profile data not found";
        }

        // Get the attribute value from shortcode or use default 'company_name'

        if (!array_key_exists($attr, $json_data)) {
            return "Attribute not found";
        }
        // Check if the attribute value is an array
        if (is_array($json_data[$attr])) {
            return implode(", ", $json_data[$attr]);
        }

        // Retrieve the value corresponding to the attribute from parsed JSON data
        $value = isset($json_data[$attr]) ? $json_data[$attr] : "";

        return $value;

    }
}

Deprecated::init();
