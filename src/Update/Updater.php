<?php
/*
 * A helper class for updating the plugin.
 */

namespace BusinessProfileRender\Updater;

class Updater {
    const GITHUB_ORGANIZATION = 'vplugins';
    const GITHUB_REPOSITORY = 'business-profile-render';

    // Loads the updater.
    public static function load() {
        add_filter('pre_set_site_transient_update_plugins', [__CLASS__, 'transient_update_plugins'], 20, 1);
        add_filter('plugins_api', [__CLASS__, 'plugins_api'], 20, 3);
        add_filter('upgrader_post_install', [__CLASS__, 'upgrader_post_install'], 20, 3);
    }

    // Triggered when WordPress checks for plugin updates.
    public static function transient_update_plugins($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $plugin = static::get_plugin_data();
        $release = static::get_latest_release();

        if (!$release) {
            return $transient;
        }

        $info = (object) [
            'new_version' => $release['version'],
            'package' => $release['package'],
            'plugin' => $plugin->basename,
            'slug' => $plugin->slug,
            'url' => $plugin->url,
        ];

        if (version_compare($plugin->version, $release['version'], '<')) {
            $transient->response[$plugin->basename] = $info;
            unset($transient->no_update[$plugin->basename]);
        } else {
            $transient->no_update[$plugin->basename] = $info;
            unset($transient->response[$plugin->basename]);
        }

        return $transient;
    }

    // Retrieves information of the plugin.
    protected static function get_plugin_data() {
        static $info = null;

        if (is_null($info)) {
            $plugin_data = get_plugin_data(BUSINESS_PROFILE_RENDER_FILE);
            $info = (object) [
                'author' => $plugin_data['AuthorName'],
                'author_profile' => $plugin_data['AuthorURI'],
                'basename' => plugin_basename(BUSINESS_PROFILE_RENDER_FILE),
                'description' => $plugin_data['Description'],
                'dir_path' => plugin_dir_path(BUSINESS_PROFILE_RENDER_FILE),
                'name' => $plugin_data['Name'],
                'slug' => current(explode('/', plugin_basename(BUSINESS_PROFILE_RENDER_FILE))),
                'url' => $plugin_data['PluginURI'],
                'version' => $plugin_data['Version'],
            ];
        }

        return $info;
    }

    // Retrieves information of the latest release of the plugin.
    protected static function get_latest_release() {
        $cache_key = 'business_profile_render_latest_release';
        if ($data = get_transient($cache_key)) {
            return $data;
        }

        $url = sprintf('https://api.github.com/repos/%s/%s/releases', self::GITHUB_ORGANIZATION, self::GITHUB_REPOSITORY);
        $response = wp_remote_get($url);
        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $response = json_decode($body, true);
        if (empty($response) || !is_array($response)) {
            return false;
        }

        $response = current($response);
        $update = [
            'package' => $response['zipball_url'],
            'published_at' => $response['published_at'],
            'updates' => $response['body'],
            'version' => $response['tag_name'],
        ];
        set_transient($cache_key, $update, 12 * HOUR_IN_SECONDS);

        return $update;
    }

    // Filters the response for the plugin installation API request.
    public static function plugins_api($response, $action, $args) {
        $plugin = static::get_plugin_data();
        if (empty($args->slug) || $args->slug !== $plugin->slug) {
            return $response;
        }

        $release = static::get_latest_release();
        if (!$release) {
            return $response;
        }

        return (object) [
            'author' => $plugin->author,
            'author_profile' => $plugin->author_profile,
            'download_link' => $release['package'],
            'homepage' => $plugin->url,
            'last_updated' => $release['published_at'],
            'name' => $plugin->name,
            'sections' => [
                'Description' => $plugin->description,
                'Updates' => $release['updates'],
            ],
            'short_description' => $plugin->description,
            'slug' => $plugin->slug,
            'version' => $release['version'],
        ];
    }

    // Filters the installation response after the installation has finished.
    public static function upgrader_post_install($response, $hook_extra, $result) {
        global $wp_filesystem;

        $plugin = static::get_plugin_data();
        $wp_filesystem->move($result['destination'], $plugin->dir_path);
        $result['destination'] = $plugin->dir_path;

        return $result;
    }
}

Updater::load();
