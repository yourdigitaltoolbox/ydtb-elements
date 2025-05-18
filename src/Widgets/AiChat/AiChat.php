<?php
namespace YDTBWidget\AiChat;

use YDTBWidgets\Utils\YDTBWidget;

class AiChat extends YDTBWidget
{
    protected string $name = 'ai_chat';
    protected string $title = 'AI Chat';

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
        // No visible output on the front end
    }

    protected function content_template()
    {
        ?>
        <div style="padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">
            <strong>Note:</strong> This element produces the chat widget in the corner, but will have no visible output on
            the front end.
        </div>


        <?php
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_initial_messages',
            [
                'label' => esc_html__('Initial Messages', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'initialMessages',
            [
                'label' => esc_html__('Initial Messages', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'message_text',
                        'label' => esc_html__('Message Text', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Message Text', 'textdomain'),
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'message_text' => esc_html__('Hi there! 👋', 'textdomain'),
                    ],
                    [
                        'message_text' => esc_html__('My name is Nathan. How can I assist you today?', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{ message_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Chat Widget Settings', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'webhook_url',
            [
                'label' => esc_html__('Webhook URL', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter webhook URL', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'webhook_method',
            [
                'label' => esc_html__('Webhook Method', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'POST' => 'POST',
                    'GET' => 'GET',
                ],
                'default' => 'POST',
            ]
        );

        $this->add_control(
            'webhook_headers',
            [
                'label' => esc_html__('Webhook Headers (JSON)', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '{}',
                'placeholder' => esc_html__('Enter headers as JSON', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'chat_mode',
            [
                'label' => esc_html__('Chat Mode', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'window' => 'Window',
                    'inline' => 'Inline',
                ],
                'default' => 'window',
            ]
        );

        $this->add_control(
            'show_welcome_screen',
            [
                'label' => esc_html__('Show Welcome Screen', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'default_language',
            [
                'label' => esc_html__('Default Language', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'en',
            ]
        );


        $this->end_controls_section();

    }
}