<?php

namespace YDTBWidgets\Utils;

use YDTBWidgets\Interfaces\Provider;
use YDTBWidgets\Utils\Config;

class Updater implements Provider
{

    public $plugin_slug;
    public $version;
    public $cache_key;
    public $cache_allowed;

    public function register()
    {
        $this->plugin_slug = Config::get(key: 'plugin_slug');
        $this->version = Config::get(key: 'version');
        $this->cache_key = $this->plugin_slug . '_update';
        $this->cache_allowed = false;

        add_filter(hook_name: 'plugins_api', callback: [$this, 'info'], priority: 20, accepted_args: 3);
        add_filter(hook_name: 'site_transient_update_plugins', callback: [$this, 'update']);
        add_action(hook_name: 'upgrader_process_complete', callback: [$this, 'purge'], priority: 10, accepted_args: 2);
    }

    public function request()
    {
        $remote = get_transient($this->cache_key);
        if (false === $remote || !$this->cache_allowed) {

            $remote = wp_remote_get(
                url: Config::get(key: 'update_url'),
                args: [
                    'timeout' => 10,
                    'headers' => [
                        'Accept' => 'application/json'
                    ]
                ]
            );

            if (is_wp_error($remote) || 200 !== wp_remote_retrieve_response_code($remote) || empty(wp_remote_retrieve_body($remote))) {
                return false;
            }

            set_transient(transient: $this->cache_key, value: $remote, expiration: DAY_IN_SECONDS);
        }

        $remote = json_decode(wp_remote_retrieve_body($remote));

        return $remote;

    }

    function info($response, $action, $args)
    {

        // do nothing if you're not getting plugin information right now
        if ('plugin_information' !== $action) {
            return $response;
        }

        // do nothing if it is not our plugin
        if (empty($args->slug) || $this->plugin_slug !== $args->slug) {
            return $response;
        }

        // get updates
        $remote = $this->request();

        if (!$remote) {
            return $response;
        }

        $response = new \stdClass();

        $response->name = $remote->name;
        $response->slug = $remote->slug;
        $response->version = $remote->version;
        $response->tested = $remote->tested;
        $response->requires = $remote->requires;
        $response->author = $remote->author;
        $response->author_profile = $remote->author_profile;
        $response->donate_link = $remote->donate_link;
        $response->homepage = $remote->homepage;
        $response->download_link = $remote->download_url;
        $response->trunk = $remote->download_url;
        $response->requires_php = $remote->requires_php;
        $response->last_updated = $remote->last_updated;

        $response->sections = [
            'description' => $remote->sections->description,
            'installation' => $remote->sections->installation,
            'changelog' => $remote->sections->changelog
        ];

        if (!empty($remote->banners)) {
            $response->banners = [
                'low' => $remote->banners->low,
                'high' => $remote->banners->high
            ];
        }

        return $response;

    }

    public function update($transient)
    {

        if (empty($transient->checked)) {
            return $transient;
        }

        $remote = $this->request();

        if ($remote && version_compare($this->version, $remote->version, '<') && version_compare($remote->requires, get_bloginfo('version'), '<=') && version_compare($remote->requires_php, PHP_VERSION, '<')) {
            $response = new \stdClass();
            $response->slug = $this->plugin_slug;
            $response->plugin = "{$this->plugin_slug}/{$this->plugin_slug}.php";
            $response->new_version = $remote->version;
            $response->tested = $remote->tested;
            $response->package = $remote->download_url;

            $transient->response[$response->plugin] = $response;

        }

        return $transient;

    }

    public function purge($upgrader, $options)
    {
        if ($this->cache_allowed && 'update' === $options['action'] && 'plugin' === $options['type']) {
            // just clean the cache when new plugin version is installed
            delete_transient($this->cache_key);
        }
    }

}
