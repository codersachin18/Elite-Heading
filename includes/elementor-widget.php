<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! class_exists( 'Elite_Heading_Widget' ) ) {

    class Elite_Heading_Widget extends Widget_Base {

        public function get_name() {
            return 'elite_heading';
        }

        public function get_title() {
            return 'Elite Heading';
        }

        public function get_icon() {
            return 'eicon-t-letter';
        }

        public function get_categories() {
            return [ 'elite-heading-category' ];
        }

        public function get_keywords() {
            return [ 'heading', 'elite', 'title', 'text' ];
        }

        protected function register_controls() {

            $this->start_controls_section(
                'content_section',
                [
                    'label' => 'Content',
                ]
            );

            $this->add_control(
                'heading_text',
                [
                    'label' => 'Heading Text',
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Elite Heading',
                    'placeholder' => 'Type your heading here',
                ]
            );

            $this->add_control(
                'typing_animation',
                [
                    'label' => 'Typing Animation',
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none' => 'None',
                        'whole' => 'Whole heading types',
                        'first_word' => 'First word types',
                        'last_word' => 'Last word types',
                    ],
                ]
            );

            $this->add_control(
                'gradient_preset',
                [
                    'label' => 'Gradient Preset',
                    'type' => Controls_Manager::SELECT,
                    'default' => 'preset-1',
                    'options' => [
                        'preset-1' => 'Sunset (orange → pink)',
                        'preset-2' => 'Ocean (teal → blue)',
                        'preset-3' => 'Royal (purple → pink)',
                        'preset-4' => 'Lime (lime → green)',
                        'preset-5' => 'Fire (red → orange)',
                    ],
                ]
            );

            $this->add_control(
                'alignment',
                [
                    'label' => 'Alignment',
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => 'Left',
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => 'Center',
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => 'Right',
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_control(
                'font_weight',
                [
                    'label' => 'Font Weight',
                    'type' => Controls_Manager::SELECT,
                    'default' => '700',
                    'options' => [
                        '400' => 'Normal 400',
                        '600' => 'Semibold 600',
                        '700' => 'Bold 700',
                        '800' => 'Extra Bold 800',
                    ],
                ]
            );

            $this->add_control(
                'font_family',
                [
                    'label' => 'Font Family',
                    'type' => Controls_Manager::SELECT,
                    'default' => 'inherit',
                    'options' => [
                        'inherit' => 'Theme Default',
                        'Arial, Helvetica, sans-serif' => 'Arial',
                        'Georgia, serif' => 'Georgia',
                        'Poppins, sans-serif' => 'Poppins',
                    ],
                ]
            );

            $this->add_responsive_control(
                'font_size',
                [
                    'label' => 'Font Size (px)',
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 12,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elite-heading-title' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 36,
                    ],
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'style_section',
                [
                    'label' => 'Style',
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'letter_spacing',
                [
                    'label' => 'Letter Spacing (px)',
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -5,
                            'max' => 20,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elite-heading-title' => 'letter-spacing: {{SIZE}}{{UNIT}};',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                ]
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $text = isset( $settings['heading_text'] ) ? $settings['heading_text'] : '';
            $gradient = isset( $settings['gradient_preset'] ) ? $settings['gradient_preset'] : 'preset-1';
            $alignment = isset( $settings['alignment'] ) ? $settings['alignment'] : 'left';
            $typing = isset( $settings['typing_animation'] ) ? $settings['typing_animation'] : 'none';
            $font_weight = isset( $settings['font_weight'] ) ? $settings['font_weight'] : '700';
            $font_family = isset( $settings['font_family'] ) ? $settings['font_family'] : 'inherit';

            $text_esc = wp_kses_post( $text );
            $unique_id = 'elite-heading-' . wp_rand( 1000, 9999 );

            $data_attrs = 'data-typing="' . esc_attr( $typing ) . '" data-uid="' . esc_attr( $unique_id ) . '"';

            ?>
            <div class="elite-heading-wrapper <?php echo esc_attr( $gradient ); ?>" style="text-align:<?php echo esc_attr( $alignment ); ?>;">
                <h2 id="<?php echo esc_attr( $unique_id ); ?>" class="elite-heading-title" <?php echo $data_attrs; ?>
                    style="font-weight:<?php echo esc_attr( $font_weight ); ?>; font-family:<?php echo esc_attr( $font_family ); ?>;">
                    <?php echo $text_esc; ?>
                </h2>
            </div>
            <?php
        }

    } // end class

    // Add category on init (safe)
    add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {
        if ( method_exists( $elements_manager, 'add_category' ) ) {
            $elements_manager->add_category(
                'elite-heading-category',
                [
                    'title' => 'Elite Heading',
                    'icon' => 'font'
                ],
                1
            );
        }
    } );
}