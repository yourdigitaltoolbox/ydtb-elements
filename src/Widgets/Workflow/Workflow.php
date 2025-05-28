<?php
namespace YDTBWidget\Workflow;

use YDTBWidgets\Utils\YDTBWidget;

class Workflow extends YDTBWidget
{
    protected string $name = 'workflow-n8n';
    protected string $title = 'N8N Workflow';

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

    protected function render()
    {
        ?>

        <?php
        $settings = $this->get_settings_for_display();

        // Prepare attributes
        $attributes = [];

        // workflow (textarea, string)
        if (!empty($settings['workflow'])) {
            $attributes[] = 'workflow=\'' . $settings['workflow'] . '\'';
        }

        // frame (switcher, boolean)
        if (!empty($settings['frame']) && $settings['frame'] === 'true') {
            $attributes[] = 'frame="true"';
        }

        // src (text, string)
        if (!empty($settings['src'])) {
            $attributes[] = 'src=\'' . esc_attr($settings['src']) . '\'';
        }

        // collapseformobile (switcher, boolean)
        if (!empty($settings['collapseformobile']) && $settings['collapseformobile'] === 'true') {
            $attributes[] = 'collapseformobile="true"';
        }

        // clicktointeract (switcher, boolean)
        if (!empty($settings['clicktointeract']) && $settings['clicktointeract'] === 'true') {
            $attributes[] = 'clicktointeract="true"';
        }

        // hidecanvaserrors (switcher, boolean)
        if (!empty($settings['hidecanvaserrors']) && $settings['hidecanvaserrors'] === 'true') {
            $attributes[] = 'hidecanvaserrors="true"';
        }

        // disableinteractivity (switcher, boolean)
        if (!empty($settings['disableinteractivity']) && $settings['disableinteractivity'] === 'true') {
            $attributes[] = 'disableinteractivity="true"';
        }

        // theme (select, string)
        if (!empty($settings['theme'])) {
            $attributes[] = 'theme=\'' . esc_attr($settings['theme']) . '\'';
        }

        // Output the tag
        echo '<n8n-demo ' . implode(' ', $attributes) . '></n8n-demo>';
    ?>
    <?php
    }

    protected function content_template()
    {
        ?>

        <# if (settings.workflow==='' ) { return; } #>

            <n8n-demo workflow={{{settings.workflow}}} <# if (settings.src) { #> src={{{settings.src}}}<# } #>
                    <# if (settings.frame) { #> frame={{{settings.frame}}}<# } #>
                            <# if (settings.collapseformobile) { #> collapseformobile={{{settings.collapseformobile}}}<# } #>
                                    <# if (settings.clicktointeract) { #> clicktointeract={{{settings.clicktointeract}}}<# } #>
                                            <# if (settings.hidecanvaserrors) { #>
                                                hidecanvaserrors={{{settings.hidecanvaserrors}}}<# } #>
                                                    <# if (settings.disableinteractivity) { #>
                                                        disableinteractivity={{{settings.disableinteractivity}}}<# } #>
                                                            <# if (settings.theme) { #> theme={{{settings.theme}}}<# } #>
                                                                    ></n8n-demo>
            <?php
    }

    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
    }

    protected function register_content_controls()
    {
        // Content tab controls
        $this->start_controls_section(
            'section_workflow_settings',
            [
                'label' => __('Workflow Settings', 'ydtb-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'workflow',
            [
                'label' => __('Workflow JSON', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::CODE,
                'default' => '{"nodes":[{"name":"Workflow-Created","type":"n8n-nodes-base.webhook","position":[512,369],"parameters":{"path":"webhook","httpMethod":"POST"},"typeVersion":1}],"connections":{}}',
                'language' => 'json',
                'rows' => 10,
                'description' => __('Workflow JSON to load.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'frame',
            [
                'label' => __('Add Frame', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ydtb-elements'),
                'label_off' => __('No', 'ydtb-elements'),
                'return_value' => 'true',
                'default' => 'false',
                'description' => __('Whether to add frame around canvas with code and copy button.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'src',
            [
                'label' => __('n8n Instance URL', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'https://n8n-preview-service.internal.n8n.cloud/workflows/demo',
                'description' => __('URL for n8n instance to load workflow.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'collapseformobile',
            [
                'label' => __('Collapse for Mobile', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ydtb-elements'),
                'label_off' => __('No', 'ydtb-elements'),
                'return_value' => 'true',
                'default' => 'true',
                'description' => __('Whether to collapse on mobile for easier scrolling.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'clicktointeract',
            [
                'label' => __('Click to Interact', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ydtb-elements'),
                'label_off' => __('No', 'ydtb-elements'),
                'return_value' => 'true',
                'default' => 'false',
                'description' => __('Add button before users can interact with canvas.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'hidecanvaserrors',
            [
                'label' => __('Hide Canvas Errors', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ydtb-elements'),
                'label_off' => __('No', 'ydtb-elements'),
                'return_value' => 'true',
                'default' => 'false',
                'description' => __('Hide node errors on the canvas.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'disableinteractivity',
            [
                'label' => __('Disable Interactivity', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ydtb-elements'),
                'label_off' => __('No', 'ydtb-elements'),
                'return_value' => 'true',
                'default' => 'false',
                'description' => __('Disable interactivity entirely.', 'ydtb-elements'),
            ]
        );

        $this->add_control(
            'theme',
            [
                'label' => __('Theme', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'ydtb-elements'),
                    'light' => __('Light', 'ydtb-elements'),
                    'dark' => __('Dark', 'ydtb-elements'),
                ],
                'default' => '',
                'description' => __('Force a theme on n8n. Accepts "light" or "dark".', 'ydtb-elements'),
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {
        // Style tab controls
        $this->start_controls_section(
            'section_workflow_styles',
            [
                'label' => __('Workflow Styles', 'ydtb-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'workflow_min_height',
            [
                'label' => __('Workflow Min Height', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
                'description' => __('Minimum height for the workflow area.', 'ydtb-elements'),
                'selectors' => [
                    '{{WRAPPER}} n8n-demo' => '--n8n-workflow-min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'frame_background_color',
            [
                'label' => __('Frame Background Color', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'black',
                'description' => __('Background color for the frame.', 'ydtb-elements'),
                'selectors' => [
                    '{{WRAPPER}} n8n-demo' => '--n8n-frame-background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'json_background_color',
            [
                'label' => __('JSON Background Color', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'lightgray',
                'description' => __('Background color for the JSON area.', 'ydtb-elements'),
                'selectors' => [
                    '{{WRAPPER}} n8n-demo' => '--n8n-json-background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'copy_button_background_color',
            [
                'label' => __('Copy Button Background', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'gray',
                'description' => __('Background color for the copy button.', 'ydtb-elements'),
                'selectors' => [
                    '{{WRAPPER}} n8n-demo' => '--n8n-copy-button-background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'iframe_border_radius',
            [
                'label' => __('Iframe Border Radius', 'ydtb-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'description' => __('Border radius for the iframe (in px).', 'ydtb-elements'),
                'selectors' => [
                    '{{WRAPPER}} n8n-demo' => '--n8n-iframe-border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

}