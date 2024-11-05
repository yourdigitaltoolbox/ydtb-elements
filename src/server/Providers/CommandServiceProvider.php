<?php

namespace PluginServer\Providers;

use PluginServer\Interfaces\Provider;

class CommandServiceProvider implements Provider
{
    public function register(): void
    {
        if (!defined('WP_CLI') || !WP_CLI) {
            return;
        }

        // \WP_CLI::add_command('plugin-name', ExampleCommand::class);
    }
}
