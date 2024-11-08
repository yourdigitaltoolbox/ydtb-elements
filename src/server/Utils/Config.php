<?php

namespace YDTBWidgets\Utils;
class Config
{
    public static function get($key = ''): object|string
    {
        $plugin_file = dirname(path: __FILE__, levels: 3);
        $version = get_file_data($plugin_file, array('Version'), 'plugin');

        $config = [
            'plugin_file' => $plugin_file . "ydtb-elements.php",
            'plugin_basename' => plugin_basename(file: $plugin_file),
            'plugin_path' => plugin_dir_path(file: $plugin_file),
            'plugin_url' => plugin_dir_url(file: $plugin_file),
            'update_url' => 'https://',
            'version' => $version[0],
        ];

        return $config[$key] ?? (object) $config;
    }
}

