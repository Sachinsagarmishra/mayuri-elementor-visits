<?php
namespace MayuriElementorVisits\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Locations_Widget extends Widget_Base {
	public function get_name() {
		return 'mev_locations_visit';
	}

	public function get_title() {
		return esc_html__( 'Locations Visit', 'mayuri-elementor-visits' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'mev-visits' ];
	}

	public function get_keywords() {
		return [ 'mayuri', 'visit', 'locations', 'grid', 'storefront', 'maps' ];
	}

	public function get_style_depends() {
		return [ 'mev-elementor-visits-locations' ];
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls() {
		// Content Settings Section
		$this->start_controls_section(
			'mev_section_locations_content',
			[
				'label' => esc_html__( 'Locations', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'card_type',
			[
				'label'   => esc_html__( 'Card Size Type', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'large'    => esc_html__( 'Large Card (2x2 Spanning)', 'mayuri-elementor-visits' ),
					'standard' => esc_html__( 'Standard Card (1x1 Spanning)', 'mayuri-elementor-visits' ),
					'wide'     => esc_html__( 'Wide Card (2x1 Spanning)', 'mayuri-elementor-visits' ),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Store Title', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Location Name', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'address',
			[
				'label'       => esc_html__( 'Address / Sub-title', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Address details here', 'mayuri-elementor-visits' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'label_text',
			[
				'label'   => esc_html__( 'Label Text', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://maps.google.com/?q=address', 'mayuri-elementor-visits' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Storefront Image', 'mayuri-elementor-visits' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_control(
			'locations',
			[
				'label'       => esc_html__( 'Store Locations', 'mayuri-elementor-visits' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_default_locations(),
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
		// Grid and Layout Style
		$this->start_controls_section(
			'mev_section_locations_layout_style',
			[
				'label' => esc_html__( 'Layout', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'grid_gap',
			[
				'label'     => esc_html__( 'Grid Gap', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mev-locations-grid' => 'gap: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => esc_html__( 'Card Inner Padding', 'mayuri-elementor-visits' ),
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
					'{{WRAPPER}} .mev-location-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Content Typography and Styling
		$this->start_controls_section(
			'mev_section_locations_text_style',
			[
				'label' => esc_html__( 'Content Styles', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_text_title',
			[
				'label' => esc_html__( 'Label Settings', 'mayuri-elementor-visits' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-location-card-label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(252, 251, 248, 0.7)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mev-location-card-label svg' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'store_title_title',
			[
				'label'     => esc_html__( 'Store Title Settings', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-location-card-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(252, 251, 248)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'store_address_title',
			[
				'label'     => esc_html__( 'Address / Sub-title Settings', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'address_typography',
				'label'    => esc_html__( 'Typography', 'mayuri-elementor-visits' ),
				'selector' => '{{WRAPPER}} .mev-location-card-address',
			]
		);

		$this->add_control(
			'address_color',
			[
				'label'     => esc_html__( 'Color', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(252, 251, 248, 0.8)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-address' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Overlay / Zoom transitions
		$this->start_controls_section(
			'mev_section_locations_hover_style',
			[
				'label' => esc_html__( 'Hover & Overlay', 'mayuri-elementor-visits' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_gradient_start',
			[
				'label'     => esc_html__( 'Overlay Gradient Start', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(20, 20, 20, 0.8)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-overlay' => '--mev-overlay-start: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_gradient_mid',
			[
				'label'     => esc_html__( 'Overlay Gradient Middle', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(20, 20, 20, 0.2)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-overlay' => '--mev-overlay-mid: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_gradient_end',
			[
				'label'     => esc_html__( 'Overlay Gradient End', 'mayuri-elementor-visits' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0)',
				'selectors' => [
					'{{WRAPPER}} .mev-location-card-overlay' => '--mev-overlay-end: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'zoom_effect',
			[
				'label'        => esc_html__( 'Enable Hover Zoom Effect', 'mayuri-elementor-visits' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'mayuri-elementor-visits' ),
				'label_off'    => esc_html__( 'No', 'mayuri-elementor-visits' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$locations = ! empty( $settings['locations'] ) && is_array( $settings['locations'] ) ? $settings['locations'] : [];
		$title_tag = $this->get_safe_title_tag( $settings['title_tag'] ?? 'h3' );

		if ( empty( $locations ) ) {
			return;
		}

		$zoom_class = $settings['zoom_effect'] === 'yes' ? ' mev-location-card--zoom-enabled' : '';
		?>
		<div class="mev-locations-grid">
			<?php foreach ( $locations as $index => $location ) : 
				$card_type = ! empty( $location['card_type'] ) ? $location['card_type'] : 'standard';
				
				// Build classes
				$card_classes   = 'mev-location-card';
				$card_classes  .= ' mev-location-card--' . esc_attr( $card_type );
				$card_classes  .= esc_attr( $zoom_class );
				$card_classes  .= ' elementor-repeater-item-' . esc_attr( $location['_id'] ?? $index );

				// Get link attribute
				$link = ! empty( $location['link'] ) ? $location['link'] : [];
				$url  = ! empty( $link['url'] ) ? $link['url'] : '';

				$target    = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
				$rel_parts = [];

				if ( ! empty( $link['is_external'] ) ) {
					$rel_parts[] = 'noopener';
				}

				if ( ! empty( $link['nofollow'] ) ) {
					$rel_parts[] = 'nofollow';
				}

				$rel = $rel_parts ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';
				
				// Build image HTML
				$image_url = ! empty( $location['image']['url'] ) ? $location['image']['url'] : '';
				$image_alt = ! empty( $location['title'] ) ? $location['title'] : '';
				
				// Output container (a tag if link exists, otherwise div)
				if ( $url ) {
					echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $card_classes ) . '"' . $target . $rel . '>';
				} else {
					echo '<div class="' . esc_attr( $card_classes ) . '">';
				}
				?>
					<?php if ( $image_url ) : ?>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" class="mev-location-card-image" />
					<?php endif; ?>

					<div class="mev-location-card-overlay"></div>

					<div class="mev-location-card-content">
						<?php if ( ! empty( $location['label_text'] ) ) : ?>
							<p class="mev-location-card-label">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
									<circle cx="12" cy="10" r="3"></circle>
								</svg>
								<?php echo esc_html( $location['label_text'] ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $location['title'] ) ) : ?>
							<?php printf( '<%1$s class="mev-location-card-title">%2$s</%1$s>', tag_escape( $title_tag ), esc_html( $location['title'] ) ); ?>
						<?php endif; ?>

						<?php if ( ! empty( $location['address'] ) ) : ?>
							<p class="mev-location-card-address"><?php echo esc_html( $location['address'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php
				if ( $url ) {
					echo '</a>';
				} else {
					echo '</div>';
				}
			endforeach; ?>
		</div>
		<?php
	}

	private function get_safe_title_tag( $tag ) {
		$allowed = [ 'h2', 'h3', 'h4', 'h5', 'div' ];
		return in_array( $tag, $allowed, true ) ? $tag : 'h3';
	}

	private function get_default_locations() {
		return [
			[
				'card_type'  => 'large',
				'title'      => esc_html__( 'Overlake Extension', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( 'NE 24th & 148th Ave NE, Bellevue', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => 'https://www.google.com/maps/search/?api=1&query=Mayuri+Indian+Grocery+148th+Ave+NE+Bellevue',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-overlake.jpg',
				],
			],
			[
				'card_type'  => 'standard',
				'title'      => esc_html__( 'Bothell', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( 'Canyon Park, Bothell', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => 'https://www.google.com/maps/search/?api=1&query=Mayuri+Indian+Grocery+Bothell',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-bothell.jpg',
				],
			],
			[
				'card_type'  => 'standard',
				'title'      => esc_html__( 'South Lake Union', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( 'Westlake Ave N, Seattle', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => 'https://www.google.com/maps/search/?api=1&query=Mayuri+Indian+Grocery+South+Lake+Union+Seattle',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-slu.jpg',
				],
			],
			[
				'card_type'  => 'standard',
				'title'      => esc_html__( 'Redmond Town Center', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( '16480 NE 74th St, Redmond', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => 'https://www.google.com/maps/search/?api=1&query=Mayuri+Indian+Grocery+Redmond+Town+Center',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-redmond.jpg',
				],
			],
			[
				'card_type'  => 'standard',
				'title'      => esc_html__( 'Issaquah', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( 'Pickering Place, Issaquah', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => 'https://www.google.com/maps/search/?api=1&query=Mayuri+Indian+Grocery+Issaquah',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-issaquah.jpg',
				],
			],
			[
				'card_type'  => 'wide',
				'title'      => esc_html__( 'Catering Kitchen', 'mayuri-elementor-visits' ),
				'address'    => esc_html__( 'Bellevue, WA — by appointment', 'mayuri-elementor-visits' ),
				'label_text' => esc_html__( 'Visit Us', 'mayuri-elementor-visits' ),
				'link'       => [
					'url' => '/catering',
				],
				'image'      => [
					'url' => MEV_URL . 'assets/images/loc-catering.jpg',
				],
			],
		];
	}
}
