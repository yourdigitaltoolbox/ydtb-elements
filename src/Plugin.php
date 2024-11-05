<?php

namespace PluginRoot;

use \PluginServer\Providers\ApiServiceProvider;
use \PluginServer\Providers\CommandServiceProvider;
use \PluginServer\Providers\ViewProvider;

class Plugin
{
    private $plugin_path;

    public function __construct()
    {
        if (!$this->plugin_checks()) {
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
        return true;
    }
}
