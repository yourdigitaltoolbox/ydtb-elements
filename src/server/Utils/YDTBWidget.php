<?php
namespace YDTBWidgets\Utils;

use ReflectionClass;

abstract class YDTBWidget extends \Elementor\Widget_Base
{
    protected array $script_depends = [];
    protected array $style_depends = [];
    protected string $folder_name;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        // Dynamically determine the folder name based on the child class file path
        $this->folder_name = strtolower(basename(dirname((new ReflectionClass($this))->getFileName())));

        $entrypoints_manifest = Config::get('plugin_path') . 'dist/entrypoints.json';

        if (!file_exists($entrypoints_manifest)) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error is-dismissible">';
                echo '<p>' . __('The entrypoints.json file is missing. Please build the plugin to generate the required files.', 'text-domain') . '</p>';
                echo '</div>';
            });
            return;
        }

        $entrypoints = json_decode(file_get_contents($entrypoints_manifest), true);

        if (!isset($entrypoints[$this->folder_name])) {
            return;
        }

        $assets = $entrypoints[$this->folder_name];

        // Register JS files
        if (!empty($assets['js'])) {
            foreach ($assets['js'] as $index => $js) {
                $script_handle = "{$this->folder_name}-js-{$index}";
                wp_register_script(
                    $script_handle,
                    Config::get('plugin_url') . "dist/{$js}",
                    ['jquery'], // Add dependencies if needed
                    null,
                    true
                );
                $this->script_depends[] = $script_handle;
            }
        }

        // Register CSS files
        if (!empty($assets['css'])) {
            foreach ($assets['css'] as $css) {
                $style_handle = "{$this->folder_name}-css";
                wp_register_style(
                    $style_handle,
                    Config::get('plugin_url') . "dist/{$css}",
                    [],
                    null,
                    'all'
                );
                $this->style_depends[] = $style_handle;
            }
        }
        // Enqueue editor-specific assets
        $this->enqueue_editor_assets();
    }

    public function get_script_depends(): array
    {
        return $this->script_depends;
    }

    public function get_style_depends(): array
    {
        return $this->style_depends;
    }

    protected function enqueue_editor_assets(): void
    {
        add_action('elementor/editor/before_enqueue_scripts', function () {
            foreach ($this->script_depends as $script_handle) {
                wp_enqueue_script($script_handle);
            }

            foreach ($this->style_depends as $style_handle) {
                wp_enqueue_style($style_handle);
            }
        });
    }
}