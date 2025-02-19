<?php

namespace YDTBWidgetRoot;

use YDTBWidgets\Providers\ApiServiceProvider;
use YDTBWidgets\Providers\CommandServiceProvider;
use YDTBWidgets\Providers\WidgetProvider;
use YDTBWidgets\Utils\Updater;

class Plugin
{
    private $plugin_path;

    public function __construct()
    {
        if (!$this->plugin_checks()) {
            // still run the safe providers like the updater if the plugin checks fail
            foreach ($this->safeProviders() as $service) {
                (new $service)->register();
            }
            return;
        }
        $this->register();
    }

    /**
     * Register the providers
     */

    protected function providers()
    {
        return [
            CommandServiceProvider::class,
            ApiServiceProvider::class,
            WidgetProvider::class,
            Updater::class
        ];
    }

    protected function safeProviders()
    {
        return [
            Updater::class
        ];
    }

    /**
     * Run each providers' register function
     */

    protected function register()
    {
        foreach ($this->providers() as $service) {
            (new $service)->register();
        }
    }



    /**
     * Check if the plugin has been built + anything else you want to check prior to booting the plugin
     */

    public function plugin_checks()
    {
        if (!is_plugin_active('elementor/elementor.php') || !is_plugin_active('elementor-pro/elementor-pro.php')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>Elementor and Elementor Pro must be installed and activated for YDTB Elements plugin to work.</p></div>';
            });
            return false;
        }
        return true;
    }
}
