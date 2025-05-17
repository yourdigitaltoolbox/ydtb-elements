<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;

use Elementor\Plugin;

class WidgetProvider implements Provider
{
    public function register(): void
    {
        add_action('elementor/widgets/register', [$this, 'loadWidgets'], 1);
    }

    public function loadWidgets(): void
    {
        // Conditionally load the CodeHighlight widget if Elementor Pro is active
        if (defined('ELEMENTOR_PRO_VERSION')) {
            new \YDTBWidget\CodeHighlight\CodeHighlight();
        }

        // Register All New Widgets
        $widgets = [
            \YDTBWidget\AiChat\AiChat::class,
            \YDTBWidget\PeerTubeVideo\PeerTubeVideo::class,
            \YDTBWidget\KeyboardKeys\KeyboardKeys::class,
        ];

        foreach ($widgets as $widget) {
            Plugin::instance()->widgets_manager->register(new $widget());
        }
    }
}
