<?php
namespace YDTBModule\AiChat;
use YDTBWidgets\Utils\Config;

class Widget extends \Elementor\Widget_Base
{
    private array $script_depends = [];
    private array $style_depends = [];

    private string $name = 'ai_chat';
    private string $title = 'AI Chat';

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        // Dynamically determine the key based on the folder name
        $folder_name = strtolower(basename(dirname(__FILE__)));

        // Dynamically register the assets for this widget
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

        if (!isset($entrypoints[$folder_name])) {
            return;
        }

        $assets = $entrypoints[$folder_name];

        // Register JS files
        if (!empty($assets['js'])) {
            foreach ($assets['js'] as $index => $js) {
                $script_handle = "{$folder_name}-js-{$index}";
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
                $style_handle = "{$folder_name}-css";
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
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_title()
    {
        return __($this->title);
    }

    public function get_icon()
    {
        return 'eicon-chat';
    }

    public function get_categories()
    {
        return ['general', "YDTB"];
    }

    public function get_script_depends(): array
    {
        return $this->script_depends;
    }

    public function get_style_depends(): array
    {
        return $this->style_depends;
    }

    protected function render()
    {
        ?>
        <div>Hello World</div>
        <div class="ai-chat">Initial</div>
        <?php
    }

    protected function content_template()
    {
        ?>
        <div>Hello World</div>
        <div class="ai-chat">Initial</div>
        <?php
    }
}