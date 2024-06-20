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

        // This shortcode supports Business Profile Data elements

            'business-profile-data-company-name'              => 'company_name',
            'business-profile-data-address'                   => 'address',
            'business-profile-data-city'                      => 'city',
            'business-profile-data-state'                     => 'state',
            'business-profile-data-zip-code'                  => 'zip',
            'business-profile-data-country'                   => 'country',
            'business-profile-data-work-number'               => 'work_number',
            'business-profile-data-toll-free-number'          => 'toll_free_number',
            'business-profile-data-company-description'       => 'description',
            'business-profile-data-company-short-description' => 'short_description',

        // This shortcode supports Business Profile Render elements

            'business-profile-render-company-name'              => 'company_name',
            'business-profile-render-address'                   => 'address',
            'business-profile-render-city'                      => 'city',
            'business-profile-render-state'                     => 'state',
            'business-profile-render-zip-code'                  => 'zip',
            'business-profile-render-country'                   => 'country',
            'business-profile-render-work-number'               => 'work_number',
            'business-profile-render-toll-free-number'          => 'toll_free_number',
            'business-profile-render-company-description'       => 'description',
            'business-profile-render-company-short-description' => 'short_description',

        ];

        foreach ($shortcodes as $shortcode => $attr) {
            add_shortcode($shortcode, function() use ($attr) {
                return self::get_data_bpr($attr);
            });
        }

        /*
         * This shortcode supports Business Profile Data elements
         */

        add_shortcode('business-profile-data-full-address', function() {
            return self::business_profile_data_full_address();
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

        add_shortcode('business-profile-data-image-link-linkedin-url', function() {
            return self::business_profile_data_image_link_linkedin_url();
        });

        add_shortcode('business-profile-data-image-link-rss-url', function() {
            return self::business_profile_data_image_link_rss_url();
        });

        add_shortcode('business-profile-data-image-link-facebook-url', function() {
            return self::business_profile_data_image_link_facebook_url();
        });

        add_shortcode('business-profile-data-image-link-twitter-url', function() {
            return self::business_profile_data_image_link_twitter_url();
        });

        add_shortcode('business-profile-data-image-link-youtube-url', function() {
            return self::business_profile_data_image_link_youtube_url();
        });

        add_shortcode('business-profile-data-image-link-foursquare-url', function() {
            return self::business_profile_data_image_link_foursquare_url();
        });

        add_shortcode('business-profile-data-image-link-instagram-url', function() {
            return self::business_profile_data_image_link_instagram_url();
        });

        add_shortcode('business-profile-data-image-link-pinterest-url', function() {
            return self::business_profile_data_image_link_pinterest_url();
        });

        /** 
         * This shortcode supports Business Profile Render elements
         */ 

        add_shortcode('business-profile-render-full-address', function() {
            return self::business_profile_render_full_address();
        });

        add_shortcode('business-profile-render-hours-of-operation', function() {
            return self::business_profile_render_hours_of_operation();
        });

        add_shortcode('business-profile-render-services', function() {
            return self::business_profile_render_services();
        });

        add_shortcode('business-profile-render-logo', function() {
            return self::business_profile_render_images_logo();
        });

        add_shortcode('business-profile-render-primary', function() {
            return self::business_profile_render_images_primary();
        });

        add_shortcode('business-profile-render-image-link-linkedin-url', function() {
            return self::business_profile_render_image_link_linkedin_url();
        });

        add_shortcode('business-profile-render-image-link-rss-url', function() {
            return self::business_profile_render_image_link_rss_url();
        });

        add_shortcode('business-profile-render-image-link-facebook-url', function() {
            return self::business_profile_render_image_link_facebook_url();
        });

        add_shortcode('business-profile-render-image-link-twitter-url', function() {
            return self::business_profile_render_image_link_twitter_url();
        });

        add_shortcode('business-profile-render-image-link-youtube-url', function() {
            return self::business_profile_render_image_link_youtube_url();
        });

        add_shortcode('business-profile-render-image-link-foursquare-url', function() {
            return self::business_profile_render_image_link_foursquare_url();
        });

        add_shortcode('business-profile-render-image-link-instagram-url', function() {
            return self::business_profile_render_image_link_instagram_url();
        });

        add_shortcode('business-profile-render-image-link-pinterest-url', function() {
            return self::business_profile_render_image_link_pinterest_url();
        });

    }


    /**
     * Initializes the shortcodes for Full Address 
     */

    public static function business_profile_data_full_address() {
        $json_data = get_option('bpr_business_profile');
        $address = $json_data['address'];
        $city = $json_data['city'];
        $state = $json_data['state'];
        $zip = $json_data['zip'];
        $country = $json_data['country'];
        $full_address_list = "<ul class='ul-business-profile-data-full-address' style='padding-left: 0px; list-style: none;'>
                                <li class='li-business-profile-data-services'>$address</li>
                                <li class='li-business-profile-data-services'>$city , $state $zip </li>
                                <li class='li-business-profile-data-services'>$country</li>
                             </ul>";
        return $full_address_list;
    }    


    public static function business_profile_render_full_address() {
        $json_data = get_option('bpr_business_profile');
        $address = $json_data['address'];
        $city = $json_data['city'];
        $state = $json_data['state'];
        $zip = $json_data['zip'];
        $country = $json_data['country'];
        $full_address_list = "<ul class='ul-business-profile-render-full-address' style='padding-left: 0px; list-style: none;'>
                                <li class='li-business-profile-render-services'>$address</li>
                                <li class='li-business-profile-render-services'>$city , $state $zip </li>
                                <li class='li-business-profile-render-services'>$country</li>
                             </ul>";
        return $full_address_list;
    }    

    /**
     * Exit shortcodes for Full Address 
     */

    
    /**
     * Initializes the shortcodes for Services Offered 
     */

    public static function business_profile_data_services() {
        $json_data = get_option('bpr_business_profile');
        $services = $json_data['services_offered'];
        $services_list = "<ul class='ul-business-profile-data-services' style='padding-left: 0px; list-style: none;'>";    
        foreach ($services as $service) {
            $services_list .= "<li class='li-business-profile-data-services'>$service</li>";
        }
        $services_list .= "</ul>";
        if (empty($services)) {
            return "<ul class='ul-business-profile-data-services' style='padding-left: 0px; list-style: none;'><li class='li-business-profile-data-services'>None Configured</li></ul>";
        }
        return $services_list;
    }

    public static function business_profile_render_services() {
        $json_data = get_option('bpr_business_profile');
        $services = $json_data['services_offered'];
        $services_list = "<ul class='ul-business-profile-render-services' style='padding-left: 0px; list-style: none;'>";    
        foreach ($services as $service) {
            $services_list .= "<li class='li-business-profile-render-services'>$service</li>";
        }
        $services_list .= "</ul>";
        if (empty($services)) {
            return "<ul class='ul-business-profile-render-services' style='padding-left: 0px; list-style: none;'><li class='li-business-profile-render-services'>None Configured</li></ul>";
        }
        return $services_list;
    }
    
    /**
     * Exit the shortcodes for Services Offered 
     */


    /**
     * Initializes the shortcodes for Hours of Operation  
     */

    public static function business_profile_data_hours_of_operation() {
        $json_data = get_option('bpr_business_profile');
        $hours = $json_data['hours_of_operation'];
        $hours_of_operation = "<ul class='ul-business-profile-data-'hours-of-operation style='padding-left: 0px; list-style: none;'>";    
        foreach ($hours as $hour) {
            $hours_of_operation .= "<li class='li-business-profile-data-hours-of-operation'>$hour</li>";
        }
        $hours_of_operation .= "</ul>";
        if (empty($hours)) {
            return "<ul class='ul-business-profile-data-hours-of-operation' style='padding-left: 0px; list-style: none;'><li class='li-business-profile-data-hours-of-operation'>Missing Hours of Operation</li></ul>";
        }
        return $hours_of_operation;
    }

    public static function business_profile_render_hours_of_operation() {
        $json_data = get_option('bpr_business_profile');
        $hours = $json_data['hours_of_operation'];
        $hours_of_operation = "<ul class='ul-business-profile-render-'hours-of-operation style='padding-left: 0px; list-style: none;'>";    
        foreach ($hours as $hour) {
            $hours_of_operation .= "<li class='li-business-profile-render-hours-of-operation'>$hour</li>";
        }
        $hours_of_operation .= "</ul>";
        if (empty($hours)) {
            return "<ul class='ul-business-profile-render-hours-of-operation' style='padding-left: 0px; list-style: none;'><li class='li-business-profile-render-hours-of-operation'>Missing Hours of Operation</li></ul>";
        }
        return $hours_of_operation;
    }

    /**
     * Exit the shortcodes for Hours of Operation   
     */

    
     
    /**
     * Initializes the shortcodes for Logo Images  
     */

    public static function business_profile_data_images_logo() {
        $json_data = get_option('bpr_business_profile');
        $img_src = $json_data['images']['logo'];
        $img_logo = "<div class='business-profile-data-primary'><img src='$img_src' style='width: 100px; height: 100px;' /></div>"; 
        if (empty($img_src)) {
            return "<div class='business-profile-data-primary'><img src='' alt='no image configured for Logo' style='width: 100px; height: 100px;' /></div>";
        }
        return $img_logo;
    }

    public static function business_profile_render_images_logo() {
        $json_data = get_option('bpr_business_profile');
        $img_src = $json_data['images']['logo'];
        $img_logo = "<div class='business-profile-render-primary'><img src='$img_src' style='width: 100px; height: 100px;' /></div>"; 
        if (empty($img_src)) {
            return "<div class='business-profile-render-primary'><img src='' alt='no image configured for Logo' style='width: 100px; height: 100px;' /></div>";
        }
        return $img_logo;
    }

    /**
     * Exit the shortcodes for Logo Images    
     */



    /**
     * Initializes the shortcodes for Primary Images  
     */

    public static function business_profile_data_images_primary() {
        $json_data = get_option('bpr_business_profile');
        $img_src = $json_data['images']['primary'];
        $img_primary = "<div class='business-profile-data-logo'><img src='$img_src' style='width: 100px; height: 100px;' /></div>";  
        if (empty($img_src)) {
            return "<div class='business-profile-data-logo'><img src='' alt='no image configured for Primary' style='width: 100px; height: 100px;' /></div>";
        }
        return $img_primary;
    }
    
    public static function business_profile_render_images_primary() {
        $json_data = get_option('bpr_business_profile');
        $img_src = $json_data['images']['primary'];
        $img_primary = "<div class='business-profile-render-logo'><img src='$img_src' style='width: 100px; height: 100px;' /></div>";  
        if (empty($img_src)) {
            return "<div class='business-profile-render-logo'><img src='' alt='no image configured for Primary' style='width: 100px; height: 100px;' /></div>";
        }
        return $img_primary;
    }

    /**
     * Exit the shortcodes for Primary Images    
     */

    /**
     * Initializes the shortcodes for LinkedIn URL 
     */
    
    public static function business_profile_data_image_link_linkedin_url() {
        $json_data = get_option('bpr_business_profile');
        $linkedin_img = self::get_data_bpr('linkedin_url');
        $linkedin_url = "../wp-content/plugins/business-profile-render/assets/images/linkedin.svg";
        $linkedin ="<a href='$linkedin_img' rel='nofollow'><img src='$linkedin_url' alt='link to LinkedIn URL' style='height:32px;width:32px;''></a>";
        if (empty($linkedin_img)) {
            return "<a href='' rel='nofollow'><img src='$linkedin_url' alt='link to LinkedIn URL' style='height:32px;width:32px;''></a>";
        }
        return $linkedin;
    }

    public static function business_profile_render_image_link_linkedin_url() {
        $json_data = get_option('bpr_business_profile');
        $linkedin_img = self::get_data_bpr('linkedin_url');
        $linkedin_url = "../wp-content/plugins/business-profile-render/assets/images/linkedin.svg";
        $linkedin ="<a href='$linkedin_img' rel='nofollow'><img src='$linkedin_url' alt='link to LinkedIn URL' style='height:32px;width:32px;''></a>";
        if (empty($linkedin_img)) {
            return "<a href='' rel='nofollow'><img src='$linkedin_url' alt='link to LinkedIn URL' style='height:32px;width:32px;''></a>";
        }
        return $linkedin;
    }
    
    /**
     * Exit the shortcodes for Primary Images    
     */
    
    /**
     * Initializes the shortcodes for RSS URL 
     */

    public static function business_profile_data_image_link_rss_url() {
        $json_data = get_option('bpr_business_profile');
        $rss_img = self::get_data_bpr('rss_url');
        $rss_url = "../wp-content/plugins/business-profile-render/assets/images/rss.svg";
        $rss ="<a href='$rss_img' rel='nofollow'><img src='$rss_url' alt='link to RSS URL' style='height:32px;width:32px;''></a>";
        if (empty($rss_img)) {
            return "<a href='' rel='nofollow'><img src='$rss_url' alt='link to RSS URL' style='height:32px;width:32px;''></a>";
        }
        return $rss;
    }

    public static function business_profile_render_image_link_rss_url() {
        $json_data = get_option('bpr_business_profile');
        $rss_img = self::get_data_bpr('rss_url');
        $rss_url = "../wp-content/plugins/business-profile-render/assets/images/rss.svg";
        $rss ="<a href='$rss_img' rel='nofollow'><img src='$rss_url' alt='link to RSS URL' style='height:32px;width:32px;''></a>";
        if (empty($rss_img)) {
            return "<a href='' rel='nofollow'><img src='$rss_url' alt='link to RSS URL' style='height:32px;width:32px;''></a>";
        }
        return $rss;
    }


    /**
     * Exit the shortcodes for RSS URL        
     */


    /**
     * Initializes the shortcodes for Facebook URL 
     */

    public static function business_profile_data_image_link_facebook_url() {
        $json_data = get_option('bpr_business_profile');
        $facebook_img = self::get_data_bpr('facebook_url');
        $facebook_url = "../wp-content/plugins/business-profile-render/assets/images/facebook.svg";
        $facebook ="<a href='$facebook_img' rel='nofollow'><img src='$facebook_url' alt='link to Facebook URL' style='height:32px;width:32px;''></a>";
        if (empty($facebook_img)) {
            return "<a href='' rel='nofollow'><img src='$facebook_url' alt='link to Facebook URL' style='height:32px;width:32px;''></a>";
        }
        return $facebook;
    }

    public static function business_profile_render_image_link_facebook_url() {
        $json_data = get_option('bpr_business_profile');
        $facebook_img = self::get_data_bpr('facebook_url');
        $facebook_url = "../wp-content/plugins/business-profile-render/assets/images/facebook.svg";
        $facebook ="<a href='$facebook_img' rel='nofollow'><img src='$facebook_url' alt='link to Facebook URL' style='height:32px;width:32px;''></a>";
        if (empty($facebook_img)) {
            return "<a href='' rel='nofollow'><img src='$facebook_url' alt='link to Facebook URL' style='height:32px;width:32px;''></a>";
        }
        return $facebook;
    }
    
    /**
     * Exit the shortcodes for Facebook URL        
     */

    /**
     * Initializes the shortcodes for Twitter URL 
     */

    public static function business_profile_data_image_link_twitter_url() {
        $json_data = get_option('bpr_business_profile');
        $twitter_img = self::get_data_bpr('twitter_url');
        $twitter_url = "../wp-content/plugins/business-profile-render/assets/images/twitter.svg";
        $twitter ="<a href='$twitter_img' rel='nofollow'><img src='$twitter_url' alt='link to Twitter URL' style='height:32px;width:32px;''></a>";
        if (empty($twitter_img)) {
            return "<a href='' rel='nofollow'><img src='$twitter_url' alt='link to Twitter URL' style='height:32px;width:32px;''></a>";
        }
        return $twitter;
    }

    public static function business_profile_render_image_link_twitter_url() {
        $json_data = get_option('bpr_business_profile');
        $twitter_img = self::get_data_bpr('twitter_url');
        $twitter_url = "../wp-content/plugins/business-profile-render/assets/images/twitter.svg";
        $twitter ="<a href='$twitter_img' rel='nofollow'><img src='$twitter_url' alt='link to Twitter URL' style='height:32px;width:32px;''></a>";
        if (empty($twitter_img)) {
            return "<a href='' rel='nofollow'><img src='$twitter_url' alt='link to Twitter URL' style='height:32px;width:32px;''></a>";
        }
        return $twitter;
    }
    
    /**
     * Exit the shortcodes for Twitter URL        
     */

    /**
     * Initializes the shortcodes for Youtube URL 
     */

    public static function business_profile_data_image_link_youtube_url() {
        $json_data = get_option('bpr_business_profile');
        $youtube_img = self::get_data_bpr('youtube_url');
        $youtube_url = "../wp-content/plugins/business-profile-render/assets/images/youtube.svg";
        $youtube ="<a href='$youtube_img' rel='nofollow'><img src='$youtube_url' alt='link to Youtube URL' style='height:32px;width:32px;''></a>";
        if (empty($youtube_img)) {
            return "<a href='' rel='nofollow'><img src='$youtube_url' alt='link to Youtube URL' style='height:32px;width:32px;''></a>";
        }
        return $youtube;
    }

    public static function business_profile_render_image_link_youtube_url() {
        $json_data = get_option('bpr_business_profile');
        $youtube_img = self::get_data_bpr('youtube_url');
        $youtube_url = "../wp-content/plugins/business-profile-render/assets/images/youtube.svg";
        $youtube ="<a href='$youtube_img' rel='nofollow'><img src='$youtube_url' alt='link to Youtube URL' style='height:32px;width:32px;''></a>";
        if (empty($youtube_img)) {
            return "<a href='' rel='nofollow'><img src='$youtube_url' alt='link to Youtube URL' style='height:32px;width:32px;''></a>";
        }
        return $youtube;
    }
    
    /**
     * Exit the shortcodes for Twitter URL        
     */

    /**
     * Initializes the shortcodes for Foursquare URL 
     */

    public static function business_profile_data_image_link_foursquare_url() {
        $json_data = get_option('bpr_business_profile');
        $foursquare_img = self::get_data_bpr('foursquare_url');
        $foursquare_url = "../wp-content/plugins/business-profile-render/assets/images/foursquare.svg";
        $foursquare ="<a href='$foursquare_img' rel='nofollow'><img src='$foursquare_url' alt='link to Foursquare URL' style='height:32px;width:32px;''></a>";
        if (empty($foursquare_img)) {
            return "<a href='' rel='nofollow'><img src='$foursquare_url' alt='link to Foursquare URL' style='height:32px;width:32px;''></a>";
        }
        return $foursquare;
    }
    
    public static function business_profile_render_image_link_foursquare_url() {
        $json_data = get_option('bpr_business_profile');
        $foursquare_img = self::get_data_bpr('foursquare_url');
        $foursquare_url = "../wp-content/plugins/business-profile-render/assets/images/foursquare.svg";
        $foursquare ="<a href='$foursquare_img' rel='nofollow'><img src='$foursquare_url' alt='link to Foursquare URL' style='height:32px;width:32px;''></a>";
        if (empty($foursquare_img)) {
            return "<a href='' rel='nofollow'><img src='$foursquare_url' alt='link to Foursquare URL' style='height:32px;width:32px;''></a>";
        }
        return $foursquare;
    }

    /**
     * Exit the shortcodes for Foursquare URL        
     */


    /**
     * Initializes the shortcodes for Instagram URL 
     */

    public static function business_profile_data_image_link_instagram_url() {
        $json_data = get_option('bpr_business_profile');
        $instagram_img = self::get_data_bpr('instagram_url');
        $instagram_url = "../wp-content/plugins/business-profile-render/assets/images/instagram.svg";
        $instagram ="<a href='$instagram_img' rel='nofollow'><img src='$instagram_url' alt='link to Instagram URL' style='height:32px;width:32px;''></a>";
        if (empty($instagram_img)) {
            return "<a href='' rel='nofollow'><img src='$instagram_url' alt='link to Instagram URL' style='height:32px;width:32px;''></a>";
        }
        return $instagram;
    }

    public static function business_profile_render_image_link_instagram_url() {
        $json_data = get_option('bpr_business_profile');
        $instagram_img = self::get_data_bpr('instagram_url');
        $instagram_url = "../wp-content/plugins/business-profile-render/assets/images/instagram.svg";
        $instagram ="<a href='$instagram_img' rel='nofollow'><img src='$instagram_url' alt='link to Instagram URL' style='height:32px;width:32px;''></a>";
        if (empty($instagram_img)) {
            return "<a href='' rel='nofollow'><img src='$instagram_url' alt='link to Instagram URL' style='height:32px;width:32px;''></a>";
        }
        return $instagram;
    }
    
    /**
     * Exit the shortcodes for Instagram URL        
     */
    

    /**
     * Initializes the shortcodes for Pinterest URL 
     */
    public static function business_profile_data_image_link_pinterest_url() {
        $json_data = get_option('bpr_business_profile');
        $pinterest_img = self::get_data_bpr('pinterest_url');
        $pinterest_url = "../wp-content/plugins/business-profile-render/assets/images/pinterest.svg";
        $pinterest ="<a href='$pinterest_img' rel='nofollow'><img src='$pinterest_url' alt='link to Pinterest URL' style='height:32px;width:32px;''></a>";
        if (empty($pinterest_img)) {
            return "<a href='' rel='nofollow'><img src='$pinterest_url' alt='link to Pinterest URL' style='height:32px;width:32px;''></a>";
        }
        return $pinterest;
    }

    public static function business_profile_render_image_link_pinterest_url() {
        $json_data = get_option('bpr_business_profile');
        $pinterest_img = self::get_data_bpr('pinterest_url');
        $pinterest_url = "../wp-content/plugins/business-profile-render/assets/images/pinterest.svg";
        $pinterest ="<a href='$pinterest_img' rel='nofollow'><img src='$pinterest_url' alt='link to Pinterest URL' style='height:32px;width:32px;''></a>";
        if (empty($pinterest_img)) {
            return "<a href='' rel='nofollow'><img src='$pinterest_url' alt='link to Pinterest URL' style='height:32px;width:32px;''></a>";
        }
        return $pinterest;
    }

    /**
     * Exit the shortcodes for Pinterest URL        
     */


    /**
     * Retrieves data for a given attribute from the stored business profile options.
     * @param string $attr Attribute name to retrieve the data for.
     * @return mixed The data associated with the attribute, or an empty string if not set.
     */

    public static function get_data_bpr($attr) {
        $json_data = get_option('bpr_business_profile');

        // Get the attribute value from shortcode or use default 'company_name'

        if (!array_key_exists($attr, $json_data)) {
            return "Data not found";
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