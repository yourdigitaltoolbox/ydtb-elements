<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;
use YDTBWidgets\Modules\CodeHighlight;
use YDTBWidgets\Modules\KeyboardWidget;
use YDTBWidgets\Modules\PeerTubeVideo;
use Elementor\Plugin;

class WidgetProvider implements Provider
{
    public function register(): void
    {
        add_action('elementor/widgets/register', [$this, 'loadWidgets'], 1);
    }
    public function loadWidgets(): void
    {
        new CodeHighlight();
        Plugin::instance()->widgets_manager->register(new KeyboardWidget());
        Plugin::instance()->widgets_manager->register(new PeerTubeVideo());
    }
}
