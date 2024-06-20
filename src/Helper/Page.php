<?php

namespace BusinessProfileRender\Page;

/**
 * Class Page
 */
class Page
{
    /**
     * Initialize page functionality
     */
    public static function init()
    {
        add_action("admin_menu", array(__CLASS__, "add_admin_page"));
        add_action("init", array(__CLASS__, "add_action_wp_enqueue_styles"));
        add_action("init", array(__CLASS__, "add_action_wp_enqueue_scripts"));
        add_action("init", array(__CLASS__, "add_font_awesome"));
    }

    public static function add_action_wp_enqueue_styles()
    {
        wp_enqueue_style(
            "helperpage-style",
            plugin_dir_url(__FILE__) . "../../assets/css/style.css"
        );
    }

    public static function add_action_wp_enqueue_scripts()
    {
        wp_enqueue_script(
            "helperpage-script",
            plugin_dir_url(__FILE__) . "../../assets/js/helper-page.js"
        );
    }

    public static function add_font_awesome()
    {
        wp_enqueue_style(
            "font-awesome",
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
        );
    }

    /**
     * Add admin page under Settings menu
     */
    public static function add_admin_page()
    {
        add_options_page(
            __("Business Profile Render", "business-profile-render"), // Page title
            __("Business Profile Render", "business-profile-render"), // Menu title
            "manage_options", // Capability required to access the page
            "page-settings", // Menu slug
            [__CLASS__, "render_admin_page"] // Callback function to render the page
        );
    }

    public static function render_admin_page()
    {
        $option_name = "bpr_business_profile";
        $unserialized_data = get_option($option_name);

        if ($unserialized_data) {
            $json_data = json_encode($unserialized_data);
            $decoded_data = json_decode($json_data, true);
        } else {
            $decoded_data = [];
        }

        // Generate full address
        $full_address = self::generate_full_address($decoded_data);
        if ($full_address) {
            $decoded_data['full_address'] = $full_address;
        }

        // Generate HTML based on the JSON data
        $html = '<div class="bpr_wrap">';
        $html .= "<h1>" . __("Business Profile Settings", "business-profile-render") . "</h1>";
        if (!empty($decoded_data)) {
            $html .= '<table class="form-table">';
            $html .= "<tr>";
            $html .=
                '<th><div class="bpr_shortcode_title">' .
                esc_html("Shortcode") .
                "</div></th>";
            $html .=
                '<th><div class="bpr_preview_title">' .
                esc_html("Preview") .
                "</div></th>";
            $html .= "<tr>";
            foreach ($decoded_data as $key => $value) {
                $html .= '<tr class="bpr_copy-text">';
                $html .=
                    '<td><div class="bpr_shortcode_lable"><input type="text" readonly class="bpr_text" value="' .
                    esc_attr("[business_profile attr='$key']") .
                    '"/><button class="bpr_btncpy"><i class="fas fa-copy"></i></button></td>';
                $html .=
                    '<td><div class="bpr_preview_lable">' . do_shortcode( '[business_profile attr="'.$key.'"]') .
                    "</div></td>";
                $html .= "</tr>";
            }
            $html .= "</table>";
        } else {
            $html .= "<p>" . __("No data found.", "business-profile-render") . "</p>";
        }

        $html .= "</div>";

        // Output the generated HTML
        echo $html;
    }

    public static function generate_full_address($data)
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
            if (!empty($data[$component])) {
                $full_address[] = $data[$component];
            }
        }

        if (empty($full_address)) {
            return null;
        }

        return implode(', ', $full_address);
    }
}

// Initialize the page class
Page::init();
