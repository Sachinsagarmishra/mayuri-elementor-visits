<?php
namespace MayuriElementorVisits;

use MayuriElementorVisits\Elementor\Category;
use MayuriElementorVisits\Elementor\Widgets\Services_Grid_Widget;
use MayuriElementorVisits\Elementor\Widgets\Marquee_Widget;
use MayuriElementorVisits\Elementor\Widgets\Testimonials_Widget;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Plugin {
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', [ $this, 'load_textdomain' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_frontend_assets' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'elementor_missing_notice' ] );
			return;
		}

		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_frontend_assets' ] );
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'mayuri-elementor-visits', false, dirname( plugin_basename( MEV_FILE ) ) . '/languages' );
	}

	public function register_frontend_assets() {
		wp_register_style(
			'mev-elementor-visits-services-grid',
			MEV_URL . 'assets/css/services-grid.css',
			[],
			MEV_VERSION
		);

		wp_register_style(
			'mev-elementor-visits-marquee',
			MEV_URL . 'assets/css/marquee.css',
			[],
			MEV_VERSION
		);

		wp_register_style(
			'mev-elementor-visits-testimonials',
			MEV_URL . 'assets/css/testimonials.css',
			[],
			MEV_VERSION
		);

		wp_register_script(
			'mev-elementor-visits-frontend',
			MEV_URL . 'assets/js/frontend.js',
			[ 'jquery' ],
			MEV_VERSION,
			true
		);

		// Enqueue assets to guarantee loading in all contexts (frontend & elementor editor)
		wp_enqueue_style( 'mev-elementor-visits-testimonials' );
		wp_enqueue_script( 'mev-elementor-visits-frontend' );
	}

	public function register_categories( $elements_manager ) {
		require_once MEV_PATH . 'includes/Category.php';
		Category::register( $elements_manager );
	}

	public function register_widgets( $widgets_manager ) {
		require_once MEV_PATH . 'widgets/Services_Grid_Widget.php';
		$widgets_manager->register( new Services_Grid_Widget() );

		require_once MEV_PATH . 'widgets/Marquee_Widget.php';
		$widgets_manager->register( new Marquee_Widget() );

		require_once MEV_PATH . 'widgets/Testimonials_Widget.php';
		$widgets_manager->register( new Testimonials_Widget() );
	}

	public function elementor_missing_notice() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		printf(
			'<div class="notice notice-warning"><p>%s</p></div>',
			esc_html__( 'Mayuri Elementor Visits requires Elementor to be installed and active.', 'mayuri-elementor-visits' )
		);
	}
}
