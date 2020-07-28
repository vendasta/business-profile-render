<?php

/*
 * A helper class for updating the plugin.
 */

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;


class Updater {
    const GITHUB_ORGANIZATION   = 'vendasta';
    const GITHUB_REPOSITORY     = 'business-profile-render';

    // Loads the updater.
    //
    public static function load() {
        add_action( 'pre_set_site_transient_update_plugins', array( __CLASS__, 'transient_update_plugins' ), 20, 1 );
    }

    // Retrieves information of the latest release of the plugin.
    //
    protected static function get_latest_release() {
        $cache_key = '_business_profile_render_update';
        if ( $data = get_transient( $cache_key ) ) {
            return $data;
        }

        $url = sprintf(
            'https://api.github.com/repos/%s/%s/releases',
            self::GITHUB_ORGANIZATION,
            self::GITHUB_REPOSITORY
        );
        $response = json_decode( wp_remote_retrieve_body( wp_remote_get( $url ) ), true );
        if ( is_array( $response ) ) {
            $response = current( $response );
        }

        $update = array(
            'version'   => $response['tag_name'],
            'package'   => $response['zipball_url'],
        );
        set_transient( $cache_key, $update, 12 * HOUR_IN_SECONDS );

        return $update;
    }
}
