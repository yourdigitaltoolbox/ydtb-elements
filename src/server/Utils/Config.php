<?php

namespace YDTBWidgets\Utils;
class Config
{
    public static function get($key = ''): object|string
    {
        $plugin_file = dirname(__FILE__, 3);

        $config = [
            'plugin_file' => $plugin_file . "ydtb-elements.php",
            'plugin_basename' => plugin_basename($plugin_file),
            'plugin_path' => plugin_dir_path($plugin_file),
            'plugin_url' => plugin_dir_url($plugin_file)
        ];

        return $config[$key] ?? (object) $config;
    }
}

