<?php
namespace YDTBWidgets\Modules;

class PeerTubeVideo extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ydtb_peertube_video';
    }

    public function get_title()
    {
        return esc_html__('Peertube Video Embed', 'ydtb-elementor-widgets');
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
        return ['video', 'peertube', 'embed'];
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
            'src',
            [
                'label' => esc_html__('Video URL', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'start',
            [
                'label' => esc_html__('Start Time', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0',
            ]
        );

        $this->add_control(
            'stop',
            [
                'label' => esc_html__('Stop Time', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => esc_html__('Show Controls', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'controlBar',
            [
                'label' => esc_html__('Show Control Bar', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'peertubeLink',
            [
                'label' => esc_html__('Show PeerTube Link', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'muted',
            [
                'label' => esc_html__('Mute Video', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop Video', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'playbackRate',
            [
                'label' => esc_html__('Playback Rate', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Show Title', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'warningTitle',
            [
                'label' => esc_html__('Show Warning Title', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'p2p',
            [
                'label' => esc_html__('Enable P2P', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'bigPlayBackgroundColor',
            [
                'label' => esc_html__('Big Play Button Background Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.8)',
            ]
        );

        $this->add_control(
            'foregroundColor',
            [
                'label' => esc_html__('Font Color', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'mode',
            [
                'label' => esc_html__('Player Engine Mode', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'web-video' => esc_html__('Web Video', 'ydtb-elementor-widgets'),
                    'p2p-media-loader' => esc_html__('P2P Media Loader', 'ydtb-elementor-widgets'),
                ],
                'default' => 'p2p-media-loader',
            ]
        );

        $this->add_control(
            'playlistPosition',
            [
                'label' => esc_html__('Playlist Position', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );

        $this->add_control(
            'api',
            [
                'label' => esc_html__('Enable API', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'waitPasswordFromEmbedAPI',
            [
                'label' => esc_html__('Wait for Password from Embed API', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
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
            'width',
            [
                'label' => esc_html__('Width', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 1920,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .peertube-video-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'ydtb-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'ydtb-elementor-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ydtb-elementor-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ydtb-elementor-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .peertube-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $src = $settings['src'];
        $start = $settings['start'];
        $stop = $settings['stop'];
        $controls = $settings['controls'] ? '1' : '0';
        $controlBar = $settings['controlBar'] ? '1' : '0';
        $peertubeLink = $settings['peertubeLink'] ? '1' : '0';
        $muted = $settings['muted'] ? '1' : '0';
        $loop = $settings['loop'] ? '1' : '0';
        $subtitle = $settings['subtitle'];
        $autoplay = $settings['autoplay'] ? '1' : '0';
        $playbackRate = $settings['playbackRate'];
        $title = $settings['title'] ? '1' : '0';
        $warningTitle = $settings['warningTitle'] ? '1' : '0';
        $p2p = $settings['p2p'] ? '1' : '0';
        $bigPlayBackgroundColor = $settings['bigPlayBackgroundColor'];
        $foregroundColor = $settings['foregroundColor'];
        $mode = $settings['mode'];
        $playlistPosition = $settings['playlistPosition'];
        $api = $settings['api'] ? '1' : '0';
        $waitPasswordFromEmbedAPI = $settings['waitPasswordFromEmbedAPI'] ? '1' : '0';
        // $width = isset($settings['width']) ? $settings['width']['size'] . $settings['width']['unit'] : '100%';
        // $alignment = isset($settings['alignment']) ? $settings['alignment'] : 'center';

        ?>
        <div class="peertube-container" style="display: flex;">
            <div class=" peertube-video-wrapper">
                <div style="position: relative; width: 100%; padding-top: 56.25%;">
                    <iframe title="<?php echo esc_attr($settings['title']); ?>" width="100%" height="100%"
                        src="<?php echo esc_url($src); ?>?start=<?php echo esc_attr($start); ?>&stop=<?php echo esc_attr($stop); ?>&controls=<?php echo esc_attr($controls); ?>&controlBar=<?php echo esc_attr($controlBar); ?>&peertubeLink=<?php echo esc_attr($peertubeLink); ?>&muted=<?php echo esc_attr($muted); ?>&loop=<?php echo esc_attr($loop); ?>&subtitle=<?php echo esc_attr($subtitle); ?>&autoplay=<?php echo esc_attr($autoplay); ?>&playbackRate=<?php echo esc_attr($playbackRate); ?>&title=<?php echo esc_attr($title); ?>&warningTitle=<?php echo esc_attr($warningTitle); ?>&p2p=<?php echo esc_attr($p2p); ?>&bigPlayBackgroundColor=<?php echo esc_attr($bigPlayBackgroundColor); ?>&foregroundColor=<?php echo esc_attr($foregroundColor); ?>&mode=<?php echo esc_attr($mode); ?>&playlistPosition=<?php echo esc_attr($playlistPosition); ?>&api=<?php echo esc_attr($api); ?>&waitPasswordFromEmbedAPI=<?php echo esc_attr($waitPasswordFromEmbedAPI); ?>"
                        frameborder="0" allowfullscreen="" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
                        style="position: absolute; inset: 0px;">
                    </iframe>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template()
    {
        ?>
        <div class="peertube-container" style="display: flex;">
            <div class="peertube-video-wrapper">
                <div style="position: relative; width: 100%; padding-top: 56.25%;">
                    <iframe title="{{{ settings.title }}}" width="100%" height="100%"
                        src="{{{ settings.src }}}?start={{{ settings.start }}}&stop={{{ settings.stop }}}&controls={{{ settings.controls ? '1' : '0' }}}&controlBar={{{ settings.controlBar ? '1' : '0' }}}&peertubeLink={{{ settings.peertubeLink ? '1' : '0' }}}&muted={{{ settings.muted ? '1' : '0' }}}&loop={{{ settings.loop ? '1' : '0' }}}&subtitle={{{ settings.subtitle }}}&autoplay={{{ settings.autoplay ? '1' : '0' }}}&playbackRate={{{ settings.playbackRate }}}&title={{{ settings.title ? '1' : '0' }}}&warningTitle={{{ settings.warningTitle ? '1' : '0' }}}&p2p={{{ settings.p2p ? '1' : '0' }}}&bigPlayBackgroundColor={{{ settings.bigPlayBackgroundColor }}}&foregroundColor={{{ settings.foregroundColor }}}&mode={{{ settings.mode }}}&playlistPosition={{{ settings.playlistPosition }}}&api={{{ settings.api ? '1' : '0' }}}&waitPasswordFromEmbedAPI={{{ settings.waitPasswordFromEmbedAPI ? '1' : '0' }}}"
                        frameborder="0" allowfullscreen="" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
                        style="position: absolute; inset: 0px;">
                    </iframe>
                </div>
            </div>
        </div>
        <?php
    }
}