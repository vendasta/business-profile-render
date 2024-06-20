<?php
namespace BusinessProfileRender\Blocks;

/**
 * Class GutenbergBlock
 */
class GutenbergBlock {
    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_block' ) );
    }

    public static function register_block() {

        // Fetch JSON data
        $business_profile_data = get_option('bpr_business_profile');

        // Check if $business_profile_data is not empty
        if (!empty($business_profile_data)) {
            // Register the block script
            wp_register_script(
                'business-profile-render-gutenberg-block',
                plugin_dir_url(__FILE__) . '../../build/gutenberg-block.js',
                array('wp-blocks', 'wp-element', 'wp-components'),
                filemtime(plugin_dir_path(__FILE__) . '../../build/gutenberg-block.js'),
                true
            );

            // Localize the block script with preprocessed data
            wp_localize_script(
                'business-profile-render-gutenberg-block',
                'businessProfileData',
                self::preprocess_business_profile_data($business_profile_data)
            );

            // Register the block type
            register_block_type('business-profile-render/bpr-block', array(
                'editor_script' => 'business-profile-render-gutenberg-block'
            ));
        }


    }

    // Function to preprocess business profile data
    public static function preprocess_business_profile_data($data) {
        $processed_data = array();

        $processed_data[''] = '';
    
        // Loop through each key-value pair in the data
        foreach ($data as $key => $value) {
    
            // Capitalize each word in the key
            $processed_key = ucwords(str_replace('_', ' ', $key));
    
            // If the value is empty, set it to "No data available"
            if (empty($value)) {
                $processed_value = __("No data available", 'business-profile-render');
            } else {
                // If the value is an array, implode it with ","
                if (is_array($value)) {
                    $processed_value = implode(', ', $value);
                } else {
                    $processed_value = $value;
                }
            }
    
            // Add processed key-value pair to the processed data array
            $processed_data[$processed_key] = $processed_value;
        }
    
        return $processed_data;
    }    

}

GutenbergBlock::init();