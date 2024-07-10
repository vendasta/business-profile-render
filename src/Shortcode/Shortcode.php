<?php
namespace BusinessProfileRender\ShortCode;

/**
 * Class ShortCode
 */
class ShortCode
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'add_font_awesome'));
        add_shortcode("business_profile", array(__CLASS__, "render_business_profile"));
    }

    public static function add_font_awesome()
    {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    }

    public static function render_business_profile($attr)
    {
        // Parse JSON from wp_options
        $json_data = get_option(BUSINESS_PROFILE_RENDER_OPTION);

        if (!$json_data) {
            return __("Business profile data not found", "business-profile-render");
        }

        // Get the attribute value from shortcode or use default 'company_name'
        $attr = isset($attr["attr"]) ? $attr["attr"] : BUSINESS_PROFILE_RENDER_DEFAULT_OPTION;

        // Special case for 'full_address'
        if ($attr === 'full_address') {
            return self::render_full_address($json_data);
        }

        // Special case for 'images'
        if ($attr === 'images') {
            return self::render_images_logo($json_data);
        }

        if (!array_key_exists($attr, $json_data)) {
            return __("Attribute not found", "business-profile-render");
        }

        // Check if the attribute value is an array
        if (is_array($json_data[$attr])) {
            return implode(", ", $json_data[$attr]);
        }

        if (self::is_valid_url($json_data[$attr])) {
            $social_media = self::get_social_media($attr);
            if ($social_media) {
                return "<a href='" . $json_data[$attr] . "' target='_blank'>" . self::get_icon_from_fontawesome($social_media) . "</a>";
            }
            return __("Invalid URL", "business-profile-render");
        }

        // Retrieve the value corresponding to the attribute from parsed JSON data
        $value = isset($json_data[$attr]) ? $json_data[$attr] : "";

        return $value;
    }

    public static function render_full_address($json_data)
    {
        // Define address components
        $address_components = [
            'address',
            'city',
            'state',
            'zip',
            'country'
        ];

        $full_address = [];

        // Combine address components
        foreach ($address_components as $component) {
            if (!empty($json_data[$component])) {
                $full_address[] = $json_data[$component];
            }
        }

        if (empty($full_address)) {
            return __("Full address not available", "business-profile-render");
        }

        return implode(', ', $full_address);
    }

    public static function is_valid_url($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function get_social_media($url)
    {
        if (strpos($url, "_url") !== false) {
            return str_replace("_url", "", $url);
        } else {
            return false;
        }
    }

    public static function get_icon_from_fontawesome($icon)
    {
        return "<i class='fab fa-$icon'></i>";
    }

    public static function render_images_logo($json_data)
    {
        $images = $json_data['images'];
        $html = "<img src='" . $images['logo'] . "' alt='logo' style='width: 100px; height: 100px;'>";
        return $html;
    }
}

ShortCode::init();
