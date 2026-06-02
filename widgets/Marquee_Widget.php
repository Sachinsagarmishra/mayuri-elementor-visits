<?php
namespace MayuriElementorVisits\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Marquee_Widget extends Widget_Base {
	public function get_name() {
		return 'mev_marquee_visit';
	}

	public function get_title() {
		return esc_html__( 'Marquee Visit', 'mayuri-elementor-visits' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'mev-visits' ];
	}

	public function get_keywords() {
		return [ 'mayuri', 'visit', 'marquee', 'scrolling', 'text' ];
	}

	public function get_style_depends() {
		return [ 'mev-elementor-visits-marquee' ];
	}

	public function get_script_depends() {
		return [ 'mev-elementor-visits-frontend' ];
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls() {
		$this->start_controls_section(
			'mev_section_marquee_items',
			[
				'label' => esc_html__( 'Items', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Grocery Item', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'mayuri-elementor-visits' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Marquee Items', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_default_items(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->add_control(
			'separator',
			[
				'label'     => esc_html__( 'Separator Symbol', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '✦',
				'selectors' => [
					'{{WRAPPER}} .mev-marquee span' => '--mev-marquee-separator: "{{VALUE}}";',
				],
			]
		);

		$this->end_controls_section();
	}

	private function register_style_controls() {
		// Layout Settings Section
		$this->start_controls_section(
			'mev_section_marquee_layout_style',
			[
				'label' => esc_html__( 'Layout', 'mayuri-elementor-visits' ),
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
					'{{WRAPPER}} .mev-marquee-wrapper' => '--mev-marquee-bg: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => esc_html__( 'Vertical Padding', 'mayuri-elementor-visits' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 20,
					'bottom'   => 20,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .mev-marquee-wrapper' => '--mev-marquee-padding-top: {{TOP}}{{UNIT}}; --mev-marquee-padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'duration',
			[
				'label'     => esc_html__( 'Scroll Duration (Speed)', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 2,
						'max' => 100,
					],
				],
				'default'   => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-marquee' => '--mev-marquee-duration: {{SIZE}}s;',
				],
			]
		);

		$this->add_control(
			'direction',
			[
				'label'     => esc_html__( 'Direction', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => [
					'normal'  => esc_html__( 'Right to Left', 'mayuri-elementor-visits' ),
					'reverse' => esc_html__( 'Left to Right', 'mayuri-elementor-visits' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mev-marquee' => '--mev-marquee-direction: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Text Settings Section
		$this->start_controls_section(
			'mev_section_marquee_text_style',
			[
				'label' => esc_html__( 'Text & Style', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-marquee span',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mev-marquee span' => '--mev-marquee-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'label'     => esc_html__( 'Text Hover Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F95F06',
				'selectors' => [
					'{{WRAPPER}} .mev-marquee span' => '--mev-marquee-hover-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F95F06',
				'selectors' => [
					'{{WRAPPER}} .mev-marquee span' => '--mev-marquee-separator-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_gap',
			[
				'label'     => esc_html__( 'Item Gap', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'default'   => [
					'size' => 40,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-marquee-content' => '--mev-marquee-gap: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'separator_spacing',
			[
				'label'     => esc_html__( 'Separator Spacing', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default'   => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-marquee span' => '--mev-marquee-sep-spacing: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = ! empty( $settings['items'] ) && is_array( $settings['items'] ) ? $settings['items'] : [];

		if ( empty( $items ) ) {
			return;
		}

		echo '<div class="mev-marquee-wrapper">';
		echo '<div class="mev-marquee">';

		// First loop for content
		echo '<div class="mev-marquee-content">';
		foreach ( $items as $item ) {
			$this->render_item( $item );
		}
		echo '</div>';

		// Duplicate loop for seamless infinite scrolling
		echo '<div class="mev-marquee-content" aria-hidden="true">';
		foreach ( $items as $item ) {
			$this->render_item( $item );
		}
		echo '</div>';

		echo '</div>';
		echo '</div>';
	}

	private function render_item( $item ) {
		$text = ! empty( $item['text'] ) ? $item['text'] : '';
		$link = ! empty( $item['link'] ) ? $item['link'] : [];
		$url  = ! empty( $link['url'] ) ? $link['url'] : '';

		if ( '' === $text ) {
			return;
		}

		if ( $url ) {
			$target    = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
			$rel_parts = [];

			if ( ! empty( $link['is_external'] ) ) {
				$rel_parts[] = 'noopener';
			}

			if ( ! empty( $link['nofollow'] ) ) {
				$rel_parts[] = 'nofollow';
			}

			$rel = $rel_parts ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';

			echo '<a href="' . esc_url( $url ) . '"' . $target . $rel . '>';
			echo '<span>' . esc_html( $text ) . '</span>';
			echo '</a>';
		} else {
			echo '<span>' . esc_html( $text ) . '</span>';
		}
	}

	private function get_default_items() {
		return [
			[ 'text' => esc_html__( 'Indian Grocery', 'mayuri-elementor-visits' ) ],
			[ 'text' => esc_html__( 'Pakistani Grocery', 'mayuri-elementor-visits' ) ],
			[ 'text' => esc_html__( 'Srilankan Grocery', 'mayuri-elementor-visits' ) ],
			[ 'text' => esc_html__( 'Nepali Grocery', 'mayuri-elementor-visits' ) ],
		];
	}
}
