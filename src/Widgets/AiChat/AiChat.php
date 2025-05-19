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
        // Output the script in both places, but only show the note in the editor
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <div style="padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">
                <strong>Note:</strong> This element produces the chat widget in the corner, but will have no visible output on
                the front end.
            </div>
            <?php
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const event = new CustomEvent('initChat', {
                    detail: {
                        config: {
                            webhookUrl: '<?php echo esc_js($this->get_settings_for_display('webhook_url')); ?>',
                            webhookConfig: {
                                method: '<?php echo esc_js($this->get_settings_for_display('webhook_method')); ?>',
                                headers: <?php echo json_encode(json_decode($this->get_settings_for_display('webhook_headers'), true)); ?>
                            },
                            target: '#n8n-chat',
                            mode: '<?php echo esc_js($this->get_settings_for_display('chat_mode')); ?>',
                            chatInputKey: 'chatInput',
                            chatSessionKey: 'sessionId',
                            metadata: {},
                            showWelcomeScreen: <?php echo $this->get_settings_for_display('show_welcome_screen') ? 'true' : 'false'; ?>,
                            defaultLanguage: '<?php echo esc_js($this->get_settings_for_display('default_language')); ?>',
                            initialMessages: <?php
                            $initial_messages = $this->get_settings_for_display('initialMessages');
                            $messages = [];
                            if (!empty($initial_messages)) {
                                foreach ($initial_messages as $message) {
                                    $messages[] = $message['message_text'];
                                }
                            }
                            echo json_encode($messages);
                            ?>,
                            i18n: {
                                en: {
                                    title: '<?php echo esc_js($this->get_settings_for_display('i18n_title')); ?>',
                                    subtitle: '<?php echo esc_js($this->get_settings_for_display('i18n_subtitle')); ?>',
                                    footer: '<?php echo esc_js($this->get_settings_for_display('i18n_footer')); ?>',
                                    getStarted: '<?php echo esc_js($this->get_settings_for_display('i18n_get_started')); ?>',
                                    inputPlaceholder: '<?php echo esc_js($this->get_settings_for_display('i18n_input_placeholder')); ?>',
                                },
                            },
                        },
                        style: {
                            '--chat--color-primary': 'red',
                            '--chat--color-primary-shade-50': '#db4061',
                            '--chat--color-primary-shade-100': '#cf3c5c',
                            '--chat--color-secondary': '#20b69e',
                            '--chat--color-secondary-shade-50': '#1ca08a',
                            '--chat--color-white': '#ffffff',
                            '--chat--color-light': '#f2f4f8',
                            '--chat--color-light-shade-50': '#e6e9f1',
                            '--chat--color-light-shade-100': '#c2c5cc',
                            '--chat--color-medium': '#d2d4d9',
                            '--chat--color-dark': '#101330',
                            '--chat--color-disabled': '#777980',
                            '--chat--color-typing': '#404040',
                            '--chat--spacing': '1rem',
                            '--chat--border-radius': '0.25rem',
                            '--chat--transition-duration': '0.15s',
                            '--chat--window--width': '500px',
                            '--chat--window--height': '700px',
                            '--chat--header-height': 'auto',
                            '--chat--header--padding': 'var(--chat--spacing)',
                            '--chat--header--background': 'var(--chat--color-dark)',
                            '--chat--header--color': 'var(--chat--color-light)',
                            '--chat--header--border-top': 'none',
                            '--chat--header--border-bottom': 'none',
                            '--chat--heading--font-size': '1em',
                            '--chat--subtitle--font-size': 'inherit',
                            '--chat--subtitle--line-height': '1.8',
                            '--chat--textarea--height': '50px',
                            '--chat--message--font-size': '1rem',
                            '--chat--message--padding': 'var(--chat--spacing)',
                            '--chat--message--border-radius': 'var(--chat--border-radius)',
                            '--chat--message-line-height': '1.8',
                            '--chat--message--bot--background': 'var(--chat--color-white)',
                            '--chat--message--bot--color': 'var(--chat--color-dark)',
                            '--chat--message--bot--border': 'none',
                            '--chat--message--user--background': 'var(--chat--color-secondary)',
                            '--chat--message--user--color': 'var(--chat--color-white)',
                            '--chat--message--user--border': 'none',
                            '--chat--message--pre--background': 'rgba(0, 0, 0, 0.05)',
                            '--chat--toggle--background': 'var(--chat--color-primary)',
                            '--chat--toggle--hover--background': 'var(--chat--color-primary-shade-50)',
                            '--chat--toggle--active--background': 'var(--chat--color-primary-shade-100)',
                            '--chat--toggle--color': 'var(--chat--color-white)',
                            '--chat--toggle--size': '64px',
                        }
                    }
                });
                document.dispatchEvent(event);
            });
        </script>
        <?php
    }

    protected function content_template()
    {
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

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Chat Widget Styles', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_primary',
            [
                'label' => esc_html__('Primary Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e74266',
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--color-primary: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_secondary',
            [
                'label' => esc_html__('Secondary Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#20b69e',
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--color-secondary: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_light',
            [
                'label' => esc_html__('Light Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f4f8',
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--color-light: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_dark',
            [
                'label' => esc_html__('Dark Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#101330',
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--color-dark: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => esc_html__('Spacing', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 0.25,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_i18n',
            [
                'label' => esc_html__('Chat Window', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'i18n_title',
            [
                'label' => esc_html__('Title', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Hey There! 👋', 'ydtb-elementor-widgets'), // Default value
                'placeholder' => esc_html__('Enter title', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_subtitle',
            [
                'label' => esc_html__('Subtitle', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '', // Default value
                'placeholder' => esc_html__('Enter subtitle', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_footer',
            [
                'label' => esc_html__('Footer', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '', // Default value
                'placeholder' => esc_html__('Enter footer text', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_get_started',
            [
                'label' => esc_html__('Get Started Text', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('New Conversation', 'ydtb-elementor-widgets'), // Default value
                'placeholder' => esc_html__('Enter get started text', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_input_placeholder',
            [
                'label' => esc_html__('Input Placeholder', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Type your question..', 'ydtb-elementor-widgets'), // Default value
                'placeholder' => esc_html__('Enter input placeholder', 'ydtb-elementor-widgets'),
            ]
        );

        $this->end_controls_section();
    }
}