<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;
use YDTBModule\AiChat\Widget as AiChat;
use Elementor\Plugin;

class WidgetProvider implements Provider
{
    public function register(): void
    {
        add_action('elementor/widgets/register', [$this, 'loadWidgets'], 1);
    }

    public function loadWidgets(): void
    {
        Plugin::instance()->widgets_manager->register(new AiChat());
    }
}
