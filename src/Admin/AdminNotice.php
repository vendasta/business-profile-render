<?php
namespace BusinessProfileRender\Admin;

/**
 * Class AdminNotice
 */
class AdminNotice {
    public static function init() {
        add_action( 'admin_init', array( __CLASS__, 'check_business_profile_option' ) );
    }

    // Method to check if bpr_business_profile option exists
    public static function check_business_profile_option() {
        // Check if we are on the admin side
        if ( is_admin() ) {
            // Check if the bpr_business_profile option exists
            if ( ! get_option( 'bpr_business_profile' ) ) {
                // If option doesn't exist, display notice
                add_action( 'admin_notices', array( __CLASS__, 'display_contact_notice' ) );
            }
        }
    }

    // Method to display notice if option doesn't exist
    public static function display_contact_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e( 'Please contact Website pro team', 'business-profile-render' ); ?></p>
        </div>
        <?php
    }
}

AdminNotice::init();