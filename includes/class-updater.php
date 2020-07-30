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
        add_filter( 'pre_set_site_transient_update_plugins', array( __CLASS__, 'transient_update_plugins' ), 20, 1 );
    }

    // Triggered when WordPress checks for plugin updates.
    //
    public static function transient_update_plugins( $transient ) {
        $plugin_file = BUSINESS_PROFILE_RENDER_PLUGIN_FILE;
        $release = static::get_latest_release();

        $plugin = (object) array(
            'new_version'   => $release['version'],
            'package'       => $release['package'],
            'plugin'        => $plugin_file,
            'slug'          => current( explode( '/', $plugin_file ) ),
            'url'           => BUSINESS_PROFILE_RENDER_PLUGIN_URI,
        );

        if ( version_compare( BUSINESS_PROFILE_RENDER_VERSION, $release['version'], '<' ) ) {
            $transient->response[ $plugin_file ] = $plugin;
            unset( $transient->no_update[ $plugin_file ] );
        } else {
            $transient->no_update[ $plugin_file ] = $plugin;
            unset( $transient->response[ $plugin_file ] );
        }

        return $transient;
    }

    // Retrieves information of the latest release of the plugin.
    //
    protected static function get_latest_release() {
        $cache_key = '_business_profile_render_latest_release';
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
