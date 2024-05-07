<?php
namespace BusinessProfileRender\ShortCode;

/**
 * Class AdminNotice
 */
class ShortCode
{
    public static function init()
    {
        add_shortcode("business_profile", [
            __CLASS__,
            "render_business_profile",
        ]);
    }

    // Method to check if bpr_business_profile option exists

    public static function render_business_profile($attr)
    {
        // Parse JSON from wp_options
        $json_data = get_option("bpr_business_profile");

        if (!$json_data) {
            return "Business profile data not found";
        }

        // Get the attribute value from shortcode or use default 'company_name'
        $attr = isset($attr["attr"]) ? $attr["attr"] : "company_name";

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

ShortCode::init();
