<?php

namespace YDTBWidgets\Utils;
class Config
{
    public static function get($key = ''): object|string
    {
        $plugin_folder = trailingslashit(dirname(path: __FILE__, levels: 4));
        $plugin_file = $plugin_folder . 'ydtb-elements.php';

        $config = [
            'plugin_file' => $plugin_file,
            'plugin_slug' => plugin_basename(file: $plugin_folder),
            'plugin_path' => plugin_dir_path(file: $plugin_file),
            'plugin_url' => plugin_dir_url(file: $plugin_file),
            'update_url' => 'https://yourdigitaltoolbox.github.io/ydtb-elements/manifest.json',
            'version' => get_file_data($plugin_file, array('Version'), 'plugin')[0]
        ];

        return $config[$key] ?? (object) $config;
    }
}

