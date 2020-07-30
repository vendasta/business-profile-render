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
        add_filter( 'plugins_api', array( __CLASS__, 'plugins_api' ), 20, 3 );
    }

    // Triggered when WordPress checks for plugin updates.
    //
    public static function transient_update_plugins( $transient ) {
        $plugin = static::get_plugin_data();
        $release = static::get_latest_release();

        $info = (object) array(
            'new_version'   => $release['version'],
            'package'       => $release['package'],
            'plugin'        => $plugin->basename,
            'slug'          => $plugin->slug,
            'url'           => $plugin->url,
        );

        if ( version_compare( $plugin->version, $release['version'], '<' ) ) {
            $transient->response[ $plugin->basename ] = $info;
            unset( $transient->no_update[ $plugin->basename ] );
        } else {
            $transient->no_update[ $plugin->basename ] = $info;
            unset( $transient->response[ $plugin->basename ] );
        }

        return $transient;
    }

    // Retrieves information of the plugin.
    //
    protected static function get_plugin_data() {
        static $info = null;

        if ( is_null( $info ) ) {
            $plugin = get_plugin_data( BUSINESS_PROFILE_RENDER_FILE );
            $info = (object) array(
                'author'            => $plugin['AuthorName'],
                'author_profile'    => $plugin['AuthorURI'],
                'basename'          => BUSINESS_PROFILE_RENDER_PLUGIN_FILE,
                'description'       => $plugin['Description'],
                'name'              => $plugin['Name'],
                'slug'              => current( explode( '/', BUSINESS_PROFILE_RENDER_PLUGIN_FILE ) ),
                'url'               => $plugin['PluginURI'],
                'version'           => $plugin['Version'],
            );
        }

        return $info;
    }

    // Retrieves information of the latest release of the plugin.
    //
    protected static function get_latest_release() {
        $cache_key = 'business_profile_render_latest_release';
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
            'package'       => $response['zipball_url'],
            'published_at'  => $response['published_at'],
            'updates'       => $response['body'],
            'version'       => $response['tag_name'],
        );
        set_transient( $cache_key, $update, 12 * HOUR_IN_SECONDS );

        return $update;
    }

    // Filters the response for the plugin installation API request.
    //
    public static function plugins_api( $response, $action, $args ) {
        $plugin = static::get_plugin_data();
        if ( empty( $args->slug ) || $args->slug !== $plugin->slug ) {
            return $response;
        }

        $release = static::get_latest_release();
        return (object) array(
            'author'            => $plugin->author,
            'author_profile'    => $plugin->author_profile,
            'download_link'     => $release['package'],
            'homepage'          => $plugin->url,
            'last_updated'      => $release['published_at'],
            'name'              => $plugin->name,
            'sections'          => array(
                'Description'   => $plugin->description,
                'Updates'       => $release['updates'],
            ),
            'short_description' => $plugin->description,
            'slug'              => $plugin->slug,
            'version'           => $release['version'],
        );
    }
}
