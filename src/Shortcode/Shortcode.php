<?php
namespace BusinessProfileRender\ShortCode;

/**
 * Class ShortCode
 */
class ShortCode
{
    public static function init()
    {   
        add_action( 'wp_enqueue_scripts', array(
            __CLASS__,
            'add_font_awesome',
        ));
        add_shortcode("business_profile", array(
            __CLASS__,
            "render_business_profile",
        ));
    }

    public static function add_font_awesome()
    {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    }

    
    // Method to check if bpr_business_profile option exists

    public static function render_business_profile($attr)
    {
        // Parse JSON from wp_options
        $json_data = get_option(BUSINESS_PROFILE_RENDER_OPTION);

        if (!$json_data) {
            return __("Business profile data not found", "business-profile-render");
        }

        // Get the attribute value from shortcode or use default 'company_name'
        $attr = isset($attr["attr"]) ? $attr["attr"] : BUSINESS_PROFILE_RENDER_DEFAULT_OPTION;

        if (!array_key_exists($attr, $json_data)) {
            return __("Attribute not found", "business-profile-render");
        }
        // Check if the attribute value is an array
        if (is_array($json_data[$attr])) {
            return implode(", ", $json_data[$attr]);
        }

        if ( self::is_valid_url($json_data[$attr]) ) {
            $social_media = self::get_social_media($attr);
            if ($social_media) {
                return "<a href='" . $json_data[$attr] . "' target='blank'>" . self::get_icon_from_fontawesome($social_media) . "</a>";
            }
            return __("Invalid URL", "business-profile-render");
        }
     
        // Retrieve the value corresponding to the attribute from parsed JSON data
        $value = isset($json_data[$attr]) ? $json_data[$attr] : "";

        return $value;
    }

    public static function is_valid_url($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function get_social_media($url)
    {
        if (strpos($url, "_url") !== false) {
            return $url = str_replace("_url", "", $url);
        } else {
            return false;
        }

    }
    

    public static function get_icon_from_fontawesome($icon)
    {
        $icon_prefix =  self::get_social_media( $icon );
        return "<i class='fab fa-$icon-square'></i>";
    }
}

ShortCode::init();
