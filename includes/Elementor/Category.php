<?php
namespace MayuriElementorVisits\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Category {
	public static function register( $elements_manager ) {
		$elements_manager->add_category(
			'mev-visits',
			[
				'title' => esc_html__( 'Mayuri Visits', 'mayuri-elementor-visits' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}
}
