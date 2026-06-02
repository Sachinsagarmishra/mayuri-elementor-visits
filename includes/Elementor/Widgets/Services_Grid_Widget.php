<?php
namespace MayuriElementorVisits\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Services_Grid_Widget extends Widget_Base {
	public function get_name() {
		return 'mev_services_grid_visit';
	}

	public function get_title() {
		return esc_html__( 'Services Grid Visit', 'mayuri-elementor-visits' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'mev-visits' ];
	}

	public function get_keywords() {
		return [ 'mayuri', 'visit', 'services', 'grid', 'cards' ];
	}

	public function get_style_depends() {
		return [ 'mev-elementor-visits-services-grid' ];
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
			'mev_section_cards',
			[
				'label' => esc_html__( 'Cards', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'card_type',
			[
				'label'   => esc_html__( 'Card Type', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'large'    => esc_html__( 'Large', 'mayuri-elementor-visits' ),
					'standard' => esc_html__( 'Standard', 'mayuri-elementor-visits' ),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Service Title', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Add your service description here.', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'EXPLORE', 'mayuri-elementor-visits' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Button Link', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'mayuri-elementor-visits' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label'   => esc_html__( 'Background Image', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'icon_image',
			[
				'label'   => esc_html__( 'Icon Image', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'overlay_start',
			[
				'label'     => esc_html__( 'Overlay Start', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(27,92,19,.95)',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '--mev-overlay-start: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'overlay_middle',
			[
				'label'     => esc_html__( 'Overlay Middle', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(27,92,19,.75)',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '--mev-overlay-middle: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'overlay_end',
			[
				'label'     => esc_html__( 'Overlay End', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(27,92,19,.15)',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '--mev-overlay-end: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cards',
			[
				'label'       => esc_html__( 'Service Cards', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_default_cards(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'h5'  => 'H5',
					'div' => 'div',
				],
			]
		);

		$this->end_controls_section();
	}

	private function register_style_controls() {
		$this->start_controls_section(
			'mev_section_layout_style',
			[
				'label' => esc_html__( 'Layout', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_padding',
			[
				'label'      => esc_html__( 'Section Padding', 'mayuri-elementor-visits' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 20,
					'right'    => 0,
					'bottom'   => 20,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .mev-services-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_gap',
			[
				'label'     => esc_html__( 'Grid Gap', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'default'   => [
					'size' => 16,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-services-grid' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_min_height',
			[
				'label'     => esc_html__( 'Card Minimum Height', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 120,
						'max' => 700,
					],
				],
				'default'   => [
					'size' => 245,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-service-card' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'large_card_min_height',
			[
				'label'     => esc_html__( 'Large Card Minimum Height', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 200,
						'max' => 900,
					],
				],
				'default'   => [
					'size' => 510,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-service-card--large' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Card Content Padding', 'mayuri-elementor-visits' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 28,
					'right'    => 28,
					'bottom'   => 28,
					'left'     => 28,
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .mev-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'default'   => [
					'size' => 0,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-service-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mev_section_content_style',
			[
				'label' => esc_html__( 'Content', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-service-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mev-service-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'large_title_color',
			[
				'label'     => esc_html__( 'Large Card Title Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1f1f1f',
				'selectors' => [
					'{{WRAPPER}} .mev-service-card--large .mev-service-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Description Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-service-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,.92)',
				'selectors' => [
					'{{WRAPPER}} .mev-service-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'large_description_color',
			[
				'label'     => esc_html__( 'Large Card Description Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => [
					'{{WRAPPER}} .mev-service-card--large .mev-service-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Button Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-explore-btn',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Button Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mev-explore-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'large_button_color',
			[
				'label'     => esc_html__( 'Large Card Button Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#466e3c',
				'selectors' => [
					'{{WRAPPER}} .mev-service-card--large .mev-explore-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mev_section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 12,
						'max' => 80,
					],
				],
				'default'   => [
					'size' => 26,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-icon-wrap img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_wrap_size',
			[
				'label'     => esc_html__( 'Icon Circle Size', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 24,
						'max' => 120,
					],
				],
				'default'   => [
					'size' => 58,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-icon-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label'     => esc_html__( 'Icon Circle Background', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mev-icon-wrap' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_shadow',
				'label'    => esc_html__( 'Icon Circle Shadow', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-icon-wrap',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$cards     = ! empty( $settings['cards'] ) && is_array( $settings['cards'] ) ? $settings['cards'] : [];
		$title_tag = $this->get_safe_title_tag( $settings['title_tag'] ?? 'h3' );

		if ( empty( $cards ) ) {
			return;
		}

		echo '<section class="mev-services-grid" aria-label="' . esc_attr__( 'Services', 'mayuri-elementor-visits' ) . '">';

		foreach ( $cards as $index => $card ) {
			$is_large       = isset( $card['card_type'] ) && 'large' === $card['card_type'];
			$card_classes   = 'mev-service-card elementor-repeater-item-' . esc_attr( $card['_id'] ?? $index );
			$card_classes  .= $is_large ? ' mev-service-card--large' : ' mev-service-card--standard';
			$style          = $this->get_card_style( $card );

			echo '<div class="' . esc_attr( $card_classes ) . '"' . $style . '>';
			echo '<div class="mev-card-content">';

			if ( $is_large ) {
				$this->render_icon( $card );
				$this->render_title( $title_tag, $card );
			} else {
				echo '<div class="mev-top-row">';
				$this->render_icon( $card );
				$this->render_title( $title_tag, $card );
				echo '</div>';
			}

			$this->render_description( $card );
			$this->render_button( $card );

			echo '</div>';
			echo '</div>';
		}

		echo '</section>';
	}

	private function render_icon( $card ) {
		$icon_url = $card['icon_image']['url'] ?? '';

		if ( ! $icon_url ) {
			return;
		}

		$alt = ! empty( $card['title'] ) ? wp_strip_all_tags( $card['title'] ) : esc_html__( 'Service icon', 'mayuri-elementor-visits' );

		echo '<div class="mev-icon-wrap">';
		echo '<img src="' . esc_url( $icon_url ) . '" alt="' . esc_attr( $alt ) . '">';
		echo '</div>';
	}

	private function render_title( $title_tag, $card ) {
		if ( empty( $card['title'] ) ) {
			return;
		}

		printf(
			'<%1$s class="mev-service-title">%2$s</%1$s>',
			tag_escape( $title_tag ),
			nl2br( esc_html( $card['title'] ) )
		);
	}

	private function render_description( $card ) {
		if ( empty( $card['description'] ) ) {
			return;
		}

		echo '<p class="mev-service-description">' . nl2br( esc_html( $card['description'] ) ) . '</p>';
	}

	private function render_button( $card ) {
		$button_text = $card['button_text'] ?? '';
		$link        = $card['button_link'] ?? [];
		$url         = $link['url'] ?? '';

		if ( '' === $button_text || '' === $url ) {
			return;
		}

		$target    = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
		$rel_parts = [];

		if ( ! empty( $link['is_external'] ) ) {
			$rel_parts[] = 'noopener';
		}

		if ( ! empty( $link['nofollow'] ) ) {
			$rel_parts[] = 'nofollow';
		}

		$rel = $rel_parts ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';

		echo '<a href="' . esc_url( $url ) . '" class="mev-explore-btn"' . $target . $rel . '>';
		echo esc_html( $button_text ) . ' <span aria-hidden="true">&rarr;</span>';
		echo '</a>';
	}

	private function get_card_style( $card ) {
		$styles         = [];
		$background_url = $card['background_image']['url'] ?? '';

		if ( $background_url ) {
			$styles[] = 'background-image:url(' . esc_url( $background_url ) . ')';
		}

		foreach ( [ 'overlay_start', 'overlay_middle', 'overlay_end' ] as $setting_name ) {
			if ( empty( $card[ $setting_name ] ) ) {
				continue;
			}

			$css_name = str_replace( '_', '-', $setting_name );
			$styles[] = '--mev-' . $css_name . ':' . $this->sanitize_css_value( $card[ $setting_name ] );
		}

		return $styles ? ' style="' . esc_attr( implode( ';', $styles ) ) . '"' : '';
	}

	private function sanitize_css_value( $value ) {
		return preg_replace( '/[^a-zA-Z0-9#(),.%\s-]/', '', $value );
	}

	private function get_safe_title_tag( $tag ) {
		$allowed = [ 'h2', 'h3', 'h4', 'h5', 'div' ];

		return in_array( $tag, $allowed, true ) ? $tag : 'h3';
	}

	private function get_default_cards() {
		$icon = Utils::get_placeholder_image_src();

		return [
			[
				'card_type'        => 'large',
				'title'            => "International &\nSpecialty Foods",
				'description'      => "A wide range of authentic\ningredients from South Asia\nand around the world.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/international-specialty-foods.jpg' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(255,250,245,.88)',
				'overlay_middle'   => 'rgba(255,250,245,.88)',
				'overlay_end'      => 'rgba(255,250,245,.88)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Organic Produce',
				'description'      => "Fresh, handpicked produce\nfor a healthier, happier\nyou and your family.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/mango.jpg' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(27,92,19,.95)',
				'overlay_middle'   => 'rgba(27,92,19,.75)',
				'overlay_end'      => 'rgba(27,92,19,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Bulk Spices',
				'description'      => "Pure spices in every form\nand flavor, perfect for\nevery kitchen creation.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/bulk-species.png' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(214,102,40,.95)',
				'overlay_middle'   => 'rgba(214,102,40,.75)',
				'overlay_end'      => 'rgba(214,102,40,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Halal Butcher',
				'description'      => "High-quality halal meat\nyou can trust, prepared\nwith care and hygiene.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/halal.png' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(201,39,39,.95)',
				'overlay_middle'   => 'rgba(201,39,39,.75)',
				'overlay_end'      => 'rgba(201,39,39,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Bakery, Classics & Sweets',
				'description'      => "Traditional favorites and\nfreshly baked delights for\nevery celebration.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/bekary.jpg' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(183,135,68,.95)',
				'overlay_middle'   => 'rgba(183,135,68,.75)',
				'overlay_end'      => 'rgba(183,135,68,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Restaurant & Catering',
				'description'      => "Delicious meals and catering\nservices for every occasion,\nbig or small.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/resturant.png' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(0,96,102,.95)',
				'overlay_middle'   => 'rgba(0,96,102,.75)',
				'overlay_end'      => 'rgba(0,96,102,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Floral Department',
				'description'      => "Beautiful floral arrangements\nfor events, poojas and\nspecial moments.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/05/florals-PuejW0zk.jpg' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(197,149,91,.95)',
				'overlay_middle'   => 'rgba(197,149,91,.75)',
				'overlay_end'      => 'rgba(197,149,91,.15)',
			],
			[
				'card_type'        => 'standard',
				'title'            => 'Grab & Go!',
				'description'      => "Fresh, delicious meals\nready for your quick,\nconvenient outing.",
				'button_text'      => 'EXPLORE',
				'button_link'      => [ 'url' => '#' ],
				'background_image' => [ 'url' => 'https://yellowgreen-newt-507420.hostingersite.com/wp-content/uploads/2026/06/grab-go.png' ],
				'icon_image'       => [ 'url' => $icon ],
				'overlay_start'    => 'rgba(48,85,20,.95)',
				'overlay_middle'   => 'rgba(48,85,20,.75)',
				'overlay_end'      => 'rgba(48,85,20,.15)',
			],
		];
	}
}
