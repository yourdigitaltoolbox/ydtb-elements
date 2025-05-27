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
                    }
                });
                document.dispatchEvent(event);
            });
        </script>

        <style>
            :root {
                --chat--color-primary:
                    <?php echo esc_js($this->get_settings_for_display('color_primary')); ?>
                ;
                --chat--color-primary-shade-50:
                    <?php echo esc_js($this->get_settings_for_display('color_primary_shade_50')); ?>
                ;
                --chat--color-primary-shade-100:
                    <?php echo esc_js($this->get_settings_for_display('color_primary_shade_100')); ?>
                ;
                --chat--color-secondary:
                    <?php echo esc_js($this->get_settings_for_display('color_secondary')); ?>
                ;
                --chat--color-secondary-shade-50:
                    <?php echo esc_js($this->get_settings_for_display('color_secondary_shade_50')); ?>
                ;
                --chat--color-white:
                    <?php echo esc_js($this->get_settings_for_display('color_white')); ?>
                ;
                --chat--color-light:
                    <?php echo esc_js($this->get_settings_for_display('color_light')); ?>
                ;
                --chat--color-light-shade-50:
                    <?php echo esc_js($this->get_settings_for_display('color_light_shade_50')); ?>
                ;
                --chat--color-light-shade-100:
                    <?php echo esc_js($this->get_settings_for_display('color_light_shade_100')); ?>
                ;
                --chat--color-medium:
                    <?php echo esc_js($this->get_settings_for_display('color_medium')); ?>
                ;
                --chat--color-dark:
                    <?php echo esc_js($this->get_settings_for_display('color_dark')); ?>
                ;
                --chat--color-disabled:
                    <?php echo esc_js($this->get_settings_for_display('color_disabled')); ?>
                ;
                --chat--color-typing:
                    <?php echo esc_js($this->get_settings_for_display('color_typing')); ?>
                ;
                --chat--spacing:
                    <?php echo esc_js($this->get_settings_for_display('spacing')) . esc_js($this->get_settings_for_display('spacing_unit')); ?>
                ;
                --chat--border-radius:
                    <?php echo esc_js($this->get_settings_for_display('border_radius')) . esc_js($this->get_settings_for_display('border_radius_unit')); ?>
                ;
                --chat--transition-duration:
                    <?php echo esc_js($this->get_settings_for_display('transition_duration')); ?>
                ;
                --chat--window--width:
                    <?php echo esc_js($this->get_settings_for_display('window_width')); ?>
                ;
                --chat--window--height:
                    <?php echo esc_js($this->get_settings_for_display('window_height')); ?>
                ;
                --chat--header-height:
                    <?php echo esc_js($this->get_settings_for_display('header_height')); ?>
                ;
                --chat--header--padding: var(--chat--spacing);
                --chat--header--background: var(--chat--color-dark);
                --chat--header--color: var(--chat--color-light);
                --chat--header--border-top: none;
                --chat--header--border-bottom: none;
                --chat--header--border-bottom: none;
                --chat--header--border-bottom: none;
                --chat--heading--font-size: 2em;
                --chat--header--color: var(--chat--color-light);
                --chat--subtitle--font-size: inherit;
                --chat--subtitle--line-height: 1.8;

                --chat--textarea--height: 50px;

                --chat--message--font-size: 1rem;
                --chat--message--padding: var(--chat--spacing);
                --chat--message--border-radius: var(--chat--border-radius);
                --chat--message-line-height: 1.8;
                --chat--message--bot--background: var(--chat--color-white);
                --chat--message--bot--color: var(--chat--color-dark);
                --chat--message--bot--border: none;
                --chat--message--user--background: var(--chat--color-secondary);
                --chat--message--user--color: var(--chat--color-white);
                --chat--message--user--border: none;
                --chat--message--pre--background: rgba(0, 0, 0, 0.05);

                --chat--toggle--background: var(--chat--color-primary);
                --chat--toggle--hover--background: var(--chat--color-primary-shade-50);
                --chat--toggle--active--background: var(--chat--color-primary-shade-100);
                --chat--toggle--color: var(--chat--color-white);
                --chat--toggle--size: 64px;
            }
        </style>

        <?php
    }

    protected function content_template()
    {
    }

    protected function register_controls()
    {
        // Register content sections
        $this->register_initial_messages_section();
        $this->register_chat_widget_settings_section();
        $this->register_i18n_section();

        // // Register style sections
        $this->register_color_palette_section();
        $this->register_general_styles_section();
        $this->register_window_styles_section();
        $this->register_message_styles_section();
        $this->register_toggle_styles_section();
    }

    protected function register_initial_messages_section()
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
    }

    protected function register_chat_widget_settings_section()
    {
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

    protected function register_i18n_section()
    {
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
                'default' => esc_html__('Hey There! 👋', 'ydtb-elementor-widgets'),
                'placeholder' => esc_html__('Enter title', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_subtitle',
            [
                'label' => esc_html__('Subtitle', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter subtitle', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_footer',
            [
                'label' => esc_html__('Footer', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter footer text', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_get_started',
            [
                'label' => esc_html__('Get Started Text', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('New Conversation', 'ydtb-elementor-widgets'),
                'placeholder' => esc_html__('Enter get started text', 'ydtb-elementor-widgets'),
            ]
        );

        $this->add_control(
            'i18n_input_placeholder',
            [
                'label' => esc_html__('Input Placeholder', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Type your question..', 'ydtb-elementor-widgets'),
                'placeholder' => esc_html__('Enter input placeholder', 'ydtb-elementor-widgets'),
            ]
        );

        $this->end_controls_section();
    }

    protected function register_general_styles_section()
    {
        $this->start_controls_section(
            'section_general_styles',
            [
                'label' => esc_html__('General Styles', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                ]
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
                ]
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label' => esc_html__('Transition Duration', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0.15s',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_color_palette_section()
    {
        $this->start_controls_section(
            'section_color_palette',
            [
                'label' => esc_html__('Color Palette', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_primary',
            [
                'label' => esc_html__('Primary Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e74266',
            ]
        );

        $this->add_control(
            'color_secondary',
            [
                'label' => esc_html__('Secondary Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#20b69e',
            ]
        );

        $this->add_control(
            'color_light',
            [
                'label' => esc_html__('Light Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f4f8',
            ]
        );

        $this->add_control(
            'color_dark',
            [
                'label' => esc_html__('Dark Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#101330',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_window_styles_section()
    {
        $this->start_controls_section(
            'section_window_styles',
            [
                'label' => esc_html__('Window Styles', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'window_width',
            [
                'label' => esc_html__('Window Width', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '500px',
            ]
        );

        $this->add_control(
            'window_height',
            [
                'label' => esc_html__('Window Height', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '700px',
            ]
        );

        $this->add_control(
            'header_background',
            [
                'label' => esc_html__('Header Background', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#101330',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_message_styles_section()
    {
        $this->start_controls_section(
            'section_message_styles',
            [
                'label' => esc_html__('Message Styles', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'message_font_size',
            [
                'label' => esc_html__('Message Font Size', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1rem',
                'selectors' => [
                    '{{WRAPPER}}' => '--chat--message--font-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'message_padding',
            [
                'label' => esc_html__('Message Padding', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'var(--chat--spacing)',
            ]
        );

        $this->add_control(
            'message_bot_background',
            [
                'label' => esc_html__('Bot Message Background', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_toggle_styles_section()
    {
        $this->start_controls_section(
            'section_toggle_styles',
            [
                'label' => esc_html__('Toggle Button Styles', 'ydtb-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_background',
            [
                'label' => esc_html__('Toggle Background', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'var(--chat--color-primary)',
            ]
        );

        $this->add_control(
            'toggle_size',
            [
                'label' => esc_html__('Toggle Size', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '64px',
            ]
        );

        $this->end_controls_section();
    }
}