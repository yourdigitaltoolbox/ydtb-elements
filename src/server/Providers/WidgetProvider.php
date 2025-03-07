<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;
use YDTBWidgets\Modules\CodeHighlight;
use YDTBWidgets\Modules\KeyboardWidget;
use YDTBWidgets\Modules\CodeGateway;
use YDTBWidgets\Modules\PeerTubeVideo;
use Elementor\Plugin;

class WidgetProvider implements Provider
{
    public function register(): void
    {
        add_action('init', [$this, 'loadWidgets']);
    }
    public function loadWidgets(): void
    {
        new CodeHighlight();
        Plugin::instance()->widgets_manager->register(new KeyboardWidget());
        // Plugin::instance()->widgets_manager->register(new CodeGateway());
        Plugin::instance()->widgets_manager->register(new PeerTubeVideo());
    }
}
