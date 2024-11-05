<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;

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
