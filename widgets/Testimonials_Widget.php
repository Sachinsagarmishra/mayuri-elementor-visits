<?php
namespace MayuriElementorVisits\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Testimonials_Widget extends Widget_Base {
	public function get_name() {
		return 'mev_testimonials_visit';
	}

	public function get_title() {
		return esc_html__( 'Testimonials Visit', 'mayuri-elementor-visits' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'mev-visits' ];
	}

	public function get_keywords() {
		return [ 'mayuri', 'visit', 'testimonials', 'slider', 'carousel', 'reviews' ];
	}

	public function get_style_depends() {
		return [ 'mev-elementor-visits-testimonials' ];
	}

	public function get_script_depends() {
		return [ 'mev-elementor-visits-frontend' ];
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls() {
		// Content Settings Section
		$this->start_controls_section(
			'mev_section_testimonials_content',
			[
				'label' => esc_html__( 'Content', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_label',
			[
				'label'       => esc_html__( 'Section Label', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'WHAT OUR CLIENTS SAY', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'quote_symbol',
			[
				'label'   => esc_html__( 'Quote Symbol', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '❞',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label'       => esc_html__( 'Quote text', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'I drive forty minutes just for their halal meat counter. The quality is exceptional and the butchers genuinely care about their craft.', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'author',
			[
				'label'       => esc_html__( 'Author Name', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'AMBADIPUDI CHAITANYA', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'location',
			[
				'label'       => esc_html__( 'Location / Sub-title', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'SEATTLE, WA', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'slides',
			[
				'label'       => esc_html__( 'Testimonial Slides', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_default_slides(),
				'title_field' => '{{{ author }}}',
			]
		);

		$this->end_controls_section();

		// Carousel Settings Section
		$this->start_controls_section(
			'mev_section_testimonials_carousel',
			[
				'label' => esc_html__( 'Carousel Settings', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'mayuri-elementor-visits' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'mayuri-elementor-visits' ),
				'label_off'    => esc_html__( 'No', 'mayuri-elementor-visits' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed (ms)', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 1000,
						'max'  => 15000,
						'step' => 100,
					],
				],
				'default'   => [
					'size' => 5000,
					'unit' => 'px',
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label'   => esc_html__( 'Transition Speed (ms)', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 100,
						'max'  => 3000,
						'step' => 50,
					],
				],
				'default' => [
					'size' => 500,
					'unit' => 'px',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause on Hover', 'mayuri-elementor-visits' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'mayuri-elementor-visits' ),
				'label_off'    => esc_html__( 'No', 'mayuri-elementor-visits' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	private function register_style_controls() {
		// Layout Styles Section
		$this->start_controls_section(
			'mev_section_testimonials_layout_style',
			[
				'label' => esc_html__( 'Layout & Section', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#204D00',
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-section' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => esc_html__( 'Section Padding', 'mayuri-elementor-visits' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .mev-testimonial-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'      => esc_html__( 'Max Content Width', 'mayuri-elementor-visits' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 500,
						'max' => 1600,
					],
				],
				'default'    => [
					'size' => 1200,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .mev-testimonial-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Top Elements Styles Section
		$this->start_controls_section(
			'mev_section_testimonials_top_style',
			[
				'label' => esc_html__( 'Label & Quote Icon', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_title',
			[
				'label' => esc_html__( 'Label Styling', 'mayuri-elementor-visits' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-testimonial-label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d7d7d7',
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_spacing',
			[
				'label'     => esc_html__( 'Margin Bottom', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-label' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'quote_title',
			[
				'label'     => esc_html__( 'Quote Icon Styling', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'quote_size',
			[
				'label'     => esc_html__( 'Size (Font Size)', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 80,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-quote-icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c8921c',
				'selectors' => [
					'{{WRAPPER}} .mev-quote-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_spacing',
			[
				'label'     => esc_html__( 'Margin Bottom', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-quote-icon' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		// Text & Author Styles Section
		$this->start_controls_section(
			'mev_section_testimonials_text_style',
			[
				'label' => esc_html__( 'Quote & Author Text', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'quote_text_title',
			[
				'label' => esc_html__( 'Quote Text Styling', 'mayuri-elementor-visits' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quote_text_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-testimonial-text',
			]
		);

		$this->add_control(
			'quote_text_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f3f1ea',
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_text_spacing',
			[
				'label'     => esc_html__( 'Margin Bottom', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 60,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-text' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'author_text_title',
			[
				'label'     => esc_html__( 'Author Styling', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-testimonial-author',
			]
		);

		$this->add_control(
			'author_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f5f5',
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'author_spacing',
			[
				'label'     => esc_html__( 'Margin Bottom', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 14,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-author' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'location_text_title',
			[
				'label'     => esc_html__( 'Location Styling', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'location_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-testimonial-location',
			]
		);

		$this->add_control(
			'location_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d4d4d4',
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-location' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'location_spacing',
			[
				'label'     => esc_html__( 'Margin Bottom', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 80,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-testimonial-location' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		// Dots Styles Section
		$this->start_controls_section(
			'mev_section_testimonials_dots_style',
			[
				'label' => esc_html__( 'Slider Dots', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Dots Inactive Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.35)',
				'selectors' => [
					'{{WRAPPER}} .mev-slider-dots span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dots_active_color',
			[
				'label'     => esc_html__( 'Dots Active Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d79b1e',
				'selectors' => [
					'{{WRAPPER}} .mev-slider-dots span.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_width',
			[
				'label'     => esc_html__( 'Dot Width', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 60,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-slider-dots span' => 'width: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'dots_height',
			[
				'label'     => esc_html__( 'Dot Height', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-slider-dots span' => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'dots_gap',
			[
				'label'     => esc_html__( 'Gap between dots', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 14,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-slider-dots' => 'gap: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$slides   = ! empty( $settings['slides'] ) && is_array( $settings['slides'] ) ? $settings['slides'] : [];

		if ( empty( $slides ) ) {
			return;
		}

		$autoplay = $settings['autoplay'] === 'yes' ? 'true' : 'false';
		$autoplay_speed = ! empty( $settings['autoplay_speed']['size'] ) ? $settings['autoplay_speed']['size'] : 5000;
		$transition_speed = ! empty( $settings['transition_speed']['size'] ) ? $settings['transition_speed']['size'] : 500;
		$pause_on_hover = $settings['pause_on_hover'] === 'yes' ? 'true' : 'false';

		$this->add_render_attribute( 'wrapper', [
			'class'                 => 'mev-testimonial-section',
			'data-autoplay'         => $autoplay,
			'data-autoplay-speed'   => $autoplay_speed,
			'data-transition-speed' => $transition_speed,
			'data-pause-on-hover'   => $pause_on_hover,
		] );
		?>
		<section <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="mev-testimonial-container">
				<div class="mev-testimonial-top">
					<?php if ( ! empty( $settings['section_label'] ) ) : ?>
						<span class="mev-testimonial-label"><?php echo esc_html( $settings['section_label'] ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $settings['quote_symbol'] ) ) : ?>
						<div class="mev-quote-icon"><?php echo esc_html( $settings['quote_symbol'] ); ?></div>
					<?php endif; ?>
				</div>

				<div class="mev-testimonial-slides-wrapper">
					<div class="mev-testimonial-slides-track">
						<?php foreach ( $slides as $index => $slide ) : 
							$slide_classes = 'mev-testimonial-slide';
							if ( $index === 0 ) {
								$slide_classes .= ' active';
							}
							?>
							<div class="<?php echo esc_attr( $slide_classes ); ?>" data-slide-index="<?php echo esc_attr( $index ); ?>">
								<?php if ( ! empty( $slide['text'] ) ) : ?>
									<h2 class="mev-testimonial-text"><?php echo esc_html( $slide['text'] ); ?></h2>
								<?php endif; ?>

								<?php if ( ! empty( $slide['author'] ) ) : ?>
									<div class="mev-testimonial-author"><?php echo esc_html( $slide['author'] ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $slide['location'] ) ) : ?>
									<div class="mev-testimonial-location"><?php echo esc_html( $slide['location'] ); ?></div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="mev-slider-dots">
					<?php foreach ( $slides as $index => $slide ) : 
						$dot_classes = 'mev-slider-dot';
						if ( $index === 0 ) {
							$dot_classes .= ' active';
						}
						?>
						<span class="<?php echo esc_attr( $dot_classes ); ?>" data-slide-to="<?php echo esc_attr( $index ); ?>"></span>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	private function get_default_slides() {
		return [
			[
				'text'     => esc_html__( 'I drive forty minutes just for their halal meat counter. The quality is exceptional and the butchers genuinely care about their craft.', 'mayuri-elementor-visits' ),
				'author'   => esc_html__( 'AMBADIPUDI CHAITANYA', 'mayuri-elementor-visits' ),
				'location' => esc_html__( 'SEATTLE, WA', 'mayuri-elementor-visits' ),
			],
			[
				'text'     => esc_html__( 'The variety of Asian and Indian imports here is unmatched. It feels like stepping right into a store back home. Everything is fresh.', 'mayuri-elementor-visits' ),
				'author'   => esc_html__( 'PRIYA RATNAM', 'mayuri-elementor-visits' ),
				'location' => esc_html__( 'BELLEVUE, WA', 'mayuri-elementor-visits' ),
			],
			[
				'text'     => esc_html__( 'Their custom catering services were a massive hit at our daughter\'s wedding. The chaats, sweets, and curry dishes were absolutely delicious.', 'mayuri-elementor-visits' ),
				'author'   => esc_html__( 'HARIS IQBAL', 'mayuri-elementor-visits' ),
				'location' => esc_html__( 'KENT, WA', 'mayuri-elementor-visits' ),
			],
		];
	}
}
