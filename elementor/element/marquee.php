<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class ANAFE_Marquee extends \Elementor\Widget_Base {
    public function get_name() {
        return 'ANAFE_marquee';
    }

    public function get_title() {
        return esc_html__('Marquee', 'an-addon-for-elementor');
    }

    public function get_icon() {
        return 'eicon-frame-expand';
    }
    
    public function get_categories() {
        return [ 'ANAFE_category_advanced' ];
    }

    public function get_keywords() {
        return ['marquee', 'infinite scroll', 'topbar'];
    }

        
    public function get_style_depends() {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim',
        ];
    }

    public function get_script_depends() {
        return [
            'font-awesome-4-shim'
        ];
    }
    
    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'an-addon-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'marquee_items',
            [
                'label' => esc_html__('Repeater Plan', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'marquee_text',
                        'label' => esc_html__('Text', 'an-addon-for-elementor'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('List Title', 'an-addon-for-elementor'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'marquee_icon',
                        'label' => esc_html__('Icon', 'an-addon-for-elementor'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'marquee_image',
                        'label' => esc_html__('Choose Image', 'an-addon-for-elementor'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => esc_url(\Elementor\Utils::get_placeholder_image_src()),
                        ],
                    ]
                ],
                'default' => [
                    [
                        'marquee_text' => esc_html__('Spring Clearance Event', 'an-addon-for-elementor'),
                    ],
                ],
                'title_field' => '{{{ marquee_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ANAFE_section_general_style',
            [
                'label' => esc_html__('Settings', 'an-addon-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ANAFE_general_gap',
            [
                'label' => esc_html__('Gap', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 48,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_items' => 'gap: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ANAFE_section_padding_style',
            [
                'label' => esc_html__('Padding', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => 20,
                    'right' => 0,
                    'bottom' => 20,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .anafe-marquee' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ANAFE_group_background_color',
            [
                'label' => esc_html__('Background Color', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fcffb2',
                'selectors' => [
                    '{{WRAPPER}} .anafe-marquee' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'ANAFE_autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed (s)', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 100,
                'step' => 5,
                'default' => 15,
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_inner' => '--em-marquee-speed: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
            'ANAFE_marquee_heading_style',
            [
                'label' => esc_html__('Heading', 'an-addon-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ANAFE_heading_color',
            [
                'label' => esc_html__('Color', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_item .marquee_heading' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_heading_typography',
                'selector' => '{{WRAPPER}} .ANAFE_marquee_item .marquee_heading',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ANAFE_marquee_icon_style',
            [
                'label' => esc_html__('Icon', 'an-addon-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ANAFE_icon_color',
            [
                'label' => esc_html__('Color', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_item .ANAFE_icon i' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'ANAFE_icon_size',
            [
                'label' => esc_html__('Size', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_item .ANAFE_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ANAFE_marquee_item .ANAFE_icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            'ANAFE_marquee_image_style',
            [
                'label' => esc_html__('Image', 'an-addon-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ANAFE_image_width',
            [
                'label' => esc_html__('Width', 'an-addon-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ANAFE_marquee_item .ANAFE_image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();  
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty($settings['marquee_items']) ) {
            return;
        }
        
        if ( !empty($settings['ANAFE_autoplay_speed']) ) {
            $playspeed = $settings['ANAFE_autoplay_speed'];
        } else {
            $playspeed = 1;            
        }

        ?>
        <div class="anafe-marquee">
            <div class="ANAFE_marquee_inner">
                <div class="ANAFE_marquee_items" data-playspeed="<?php echo esc_attr( $playspeed ); ?>">
                    <?php 
                        foreach ($settings['marquee_items'] as $item): 
                        $image_id = isset($item['marquee_image']['id']) ? absint($item['marquee_image']['id']) : 0;
                    ?>
                        <div class="ANAFE_marquee_item">
                            <span class="ANAFE_image">
                                <?php echo wp_kses_post(wp_get_attachment_image( $image_id, 'full' )); ?>
                            </span>
                            <span class="ANAFE_icon">
                                <?php if (!empty($item['marquee_icon']['value'])): ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $item['marquee_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php endif; ?>
                            </span>
                            <span class="marquee_heading"><?php echo esc_html($item['marquee_text']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div> 
            </div>    
        </div>
        <?php 
    }
    
    protected function content_template() {
        ?>
        <div class="anafe-marquee">
            <div class="ANAFE_marquee_inner">
                <div class="ANAFE_marquee_items" data-playspeed="1000">

                    <# jQuery.each( settings.marquee_items, function( index, item ) { #>
                    <#
                    var image_url = item.marquee_image.url;
                    var iconHTML = elementor.helpers.renderIcon( view, item.marquee_icon, { 'aria-hidden': true }, 'i' , 'object' );
                    #>
                        <div class="ANAFE_marquee_item">
                            <# if ( '' !== item.marquee_image.url ) { #>
                            <span class="ANAFE_image">
                                <img src="{{ image_url }}" />
                            </span>
                            <# } #>

                            <# if ( '' !== iconHTML ) { #>
                            <span class="ANAFE_icon">
                                <div class="elementor-icon">
                                    <# if ( iconHTML && iconHTML.rendered ) { #>
                                        {{{ iconHTML.value }}}
                                    <# } else { #>
                                        <i class="{{ item.marquee_icon }}"></i>
                                    <# } #>
                                </div>
                            </span>
                            <# } #>
                            <span class="marquee_heading">{{ item.marquee_text }}</span>
                        </div>
                    <# } ); #>
                </div> 
            </div>    
        </div>
        <?php 
    }    
}