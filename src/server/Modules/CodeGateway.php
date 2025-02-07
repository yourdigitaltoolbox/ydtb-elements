<?php
namespace YDTBWidgets\Modules;

class CodeGateway extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'code-gateway';
    }

    public function get_title()
    {
        return esc_html__('Code Gateway', 'ydtb-elementor-widgets');
    }

    public function get_icon()
    {
        return 'eicon-carousel';
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <div>Hello There</div>
        <?php

    }

    protected function content_template()
    {
        ?>
        <div>Hello World</div>
        <?php
    }
}