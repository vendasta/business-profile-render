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

        // Register the block script
        wp_register_script(
            'business-profile-render-gutenberg-block',
            plugin_dir_url( __FILE__ ) . '../../build/gutenberg-block.js',
            array('wp-block-editor', 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n'),
            filemtime( plugin_dir_path( __FILE__ ) . '../../build/gutenberg-block.js' ),
            true
        );


        register_block_type('business-profile-render/business-profile-block', array(
            'editor_script' => 'business-profile-render-block-script',
            'render_callback' => array(__CLASS__, 'render_block'),
        ));

        wp_localize_script(
            'business-profile-render-gutenberg-block',
            'bpr_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'security' => wp_create_nonce('bpr_object_nonce') )
        );
    }

    // Render Gutenberg block
    public static function render_block($attributes) {
        // Parse JSON from wp_options
        $json_data = get_option('bpr_business_profile'); 
        $parsed_data = json_decode($json_data, true);

        // Get the attribute value from block attributes or use default 'company_name'
        $attr = isset($attributes['attr']) ? $attributes['attr'] : 'company_name';

        // Retrieve the value corresponding to the attribute from parsed JSON data
        $value = isset($parsed_data[$attr]) ? $parsed_data[$attr] : '';

        // Render block output
        return sprintf('<div>%s</div>', $value);
    }

    // Get JSON keys for SelectControl options
    public static function get_json_keys() {
        // Parse JSON from wp_options
        $json_data = get_option('bpr_business_profile'); 
        $parsed_data = json_decode($json_data, true);

        // Return keys of the parsed JSON data
        return array_keys($parsed_data);
    }

}

GutenbergBlock::init();