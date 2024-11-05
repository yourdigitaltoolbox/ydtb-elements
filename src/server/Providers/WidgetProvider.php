<?php

namespace YDTBWidgets\Providers;

use YDTBWidgets\Interfaces\Provider;
use YDTBWidgets\Modules\CodeHighlight;

class WidgetProvider implements Provider
{
    public function register(): void
    {
        new CodeHighlight();
    }
}
