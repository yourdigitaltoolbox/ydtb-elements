<?php
namespace YDTBWidgets\Modules;

class KeyboardWidget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'keyboard_widget';
    }

    public function get_title()
    {
        return esc_html__('Show Hotkeys', 'ydtb-elementor-widgets');
    }

    public function get_icon()
    {
        return 'eicon-custom';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['keyboard', 'keys', 'typing', 'input', 'text', 'editor'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Keys', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Key', 'ydtb-elementor-widgets'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => esc_html__('Key', 'ydtb-elementor-widgets'),
                        'default' => esc_html__('⌘', 'ydtb-elementor-widgets'),
                    ],
                ],
                'default' => [
                    [
                        'text' => esc_html__('⌘', 'ydtb-elementor-widgets'),
                    ],
                    [
                        'text' => esc_html__('⌥', 'ydtb-elementor-widgets'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'separator',
            [
                'label' => esc_html__('Separator', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => " + ",
            ]
        );

        $this->add_control(
            'text_before',
            [
                'label' => esc_html__('Text Before', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "Use This Shortcut: ",
            ]
        );

        $this->add_control(
            'text_after',
            [
                'label' => esc_html__('Text After', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "",
            ]
        );

        $this->add_control(
            'common_keys',
            [
                'label' => esc_html__('Common Keys (Click To Copy)', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '
                <div style="padding-top: 5px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px;">
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⌘\')">⌘</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⌥\')">⌥</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⇧\')">⇧</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⇪\')">⇪</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'\')"></button>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px;">
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⊞ Win\')">⊞ Win</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'Alt\')">Alt</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'Ctrl\')">Ctrl</button>
                        <button class="common-key" style="padding: 5px;" onclick="navigator.clipboard.writeText(\'⌃\')">⌃</button>
                    </div> 
                </div>',
                'content_classes' => 'your-custom-class',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button-size',
            [
                'label' => esc_html__('Key Size', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 25,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 48,
                ],
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'space-before',
            [
                'label' => esc_html__('Space Before', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .space-before' => 'padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'space-after',
            [
                'label' => esc_html__('Space After', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .space-after' => 'padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'space-between',
            [
                'label' => esc_html__('Space Between', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .space-between' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'font_size',
            [
                'label' => esc_html__('Font Size', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'h-padding',
            [
                'label' => esc_html__('Horizontal Padding', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'key_text_color',
            [
                'label' => esc_html__('Key Text Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'background: {{VALUE}};',
                ],
                'default' => '#fff',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .keyboard-key' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!$settings['list']) {
            return;
        }
        ?>
        <div>
            <?php
            $this->add_inline_editing_attributes('text_before', 'basic');
            echo '<span ' . $this->get_render_attribute_string('text_before') . '>' . $this->get_settings('text_before') . '&nbsp;</span>';
            echo '<span class="space-before"></span>';
            foreach ($settings['list'] as $index => $item) {
                echo '<span class="keyboard-key" style="display:inline-block; margin: 0px 4px; box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.5); font: Helvetica, serif; text-align: center;">' . $item['text'] . '</span>';
                if ($index < count($settings['list']) - 1) {
                    echo '<span class="space-between">' . $settings['separator'] . '</span>';
                }
            }
            echo '<span class="space-after"></span>';
            $this->add_inline_editing_attributes('text_after', 'basic');
            echo '<span ' . $this->get_render_attribute_string('text_after') . ' class="text-after" >' . $this->get_settings('text_after') . '</span>';
            ?>
            <?php
    }

    protected function content_template()
    {
        ?>
            <# if ( ! settings.list.length ) { return; } #>
                <# print( settings.text_before + " " ); #>
                    <span class="space-before"></span>
                    <# _.each( settings.list, function( item, index ) { #>
                        <span class="keyboard-key" style="
                            display:inline-block;
                            margin: 0px 4px;
                            box-shadow: 0px 1px 3px 1px rgba(0, 0, 0, 0.5);
                            font: Helvetica, serif;
                            text-transform: uppercase;
                            text-align: center;
                        ">{{{ item.text }}}</span>
                        <# if ( index < settings.list.length - 1 ) { #>
                            <span class="space-between">{{{ settings.separator }}}</span>
                            <# } #>
                                <# } ); #>
                                    <span class="space-after"></span>
                                    <# print( " " + settings.text_after ); #>

                                        <?php
    }
}