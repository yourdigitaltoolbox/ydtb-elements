<?php
namespace YDTBWidget\CodeHighlight;

class CodeHighlight
{

    function __construct()
    {
        add_action('elementor/element/code-highlight/section_content/after_section_end', [$this, 'inject_custom_control'], 10, 2);
        add_filter('elementor/widget/render_content', [$this, 'change_heading_widget_content'], 10, 2);
    }

    function inject_custom_control($element, $section_id)
    {

        $element->start_controls_section(
            'custom_section',
            [
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__('Theme Box', 'textdomain'),
            ]
        );


        $element->add_control(
            'show-theme-box',
            [
                'label' => esc_html__('Show Theme Box', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'additional-options-heading',
            [
                'label' => esc_html__('Theme Box Content', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'code-highlight-title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('/code-file.js', 'textdomain'),
                'placeholder' => esc_html__('Type the title here', 'textdomain'),
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'code-highlight-type',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('ps1', 'textdomain'),
                'placeholder' => esc_html__('Type the file type', 'textdomain'),
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'additional-options-style',
            [
                'label' => esc_html__('Theme Box Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'bg_color',
            [
                'label' => esc_html__('Titlebar Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .code-hightlight-title' => 'background: {{VALUE}}',
                ],
                'default' => '#333',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ch-text' => 'color: {{VALUE}}',
                ],
                'default' => '#fff',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .ch-text',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Oxygen Mono'],
                    'font_size' => ['default' => ['size' => 18]],
                ],
            ]
        );

        $element->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'theme-box-border',
                'selector' => '{{WRAPPER}} .code-highlight-container',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#d4d4d4',
                    ],
                ],
            ]
        );

        $element->add_control(
            'margin',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .code-highlight-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );
        $element->add_control(
            'additional-circle-style-heading',
            [
                'label' => esc_html__('Theme Box Circle Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'red_color',
            [
                'label' => esc_html__('Red Circle Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ch-red' => 'background-color: {{VALUE}}',
                ],
                'default' => '#ff5f57',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'yellow_color',
            [
                'label' => esc_html__('Red Circle Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ch-yellow' => 'background-color: {{VALUE}}',
                ],
                'default' => '#febc2e',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'green_color',
            [
                'label' => esc_html__('Red Circle Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ch-green' => 'background-color: {{VALUE}}',
                ],
                'default' => '#28c840',
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'width',
            [
                'label' => esc_html__('Circle Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ch-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show-theme-box' => 'yes',
                ],
            ]
        );


        $element->end_controls_section();

    }

    function change_heading_widget_content($widget_content, $widget)
    {

        if ('code-highlight' === $widget->get_name() && 'yes' === $widget->get_settings('show-theme-box')) {

            $title = $widget->get_settings('code-highlight-title');
            $type = $widget->get_settings('code-highlight-type');

            $widget_content = '
            <div class="code-highlight-container" style="display: flex; flex-direction: column; overflow:hidden">
            <div class="code-hightlight-title" style="display: flex; padding: 15px; justify-content: space-between;">
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="ch-circle ch-red" style="border-radius: 50%; margin-bottom: 3px;"></div>
                    <div class="ch-circle ch-yellow" style="border-radius: 50%; margin-bottom: 3px;"></div>
                    <div class="ch-circle ch-green" style="border-radius: 50%; margin-bottom: 3px;"></div>
                    <div class="ch-text" style="padding-left: 10px;">' . $title . '</div>
                </div>
                <div class="ch-text" style="padding-left: 10px;">' . $type . '</div>
            </div>
                ' . $widget_content . '
            </div>';
        }

        return $widget_content;

    }
}