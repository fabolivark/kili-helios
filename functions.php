<?php

include get_template_directory() . '/config/load.php';

if( ! class_exists( 'Helios' ) ) :
	/**
	* Child theme principal Class
	*/

	class Helios {


		function __construct() {

      		// Theme setup
      		$this->theme_setup();

			// Adding actions
      		$this->add_actions();

		}

		public function theme_context( $context = null ) {
			global $kili_framework;

			$context['html5shiv'] = $kili_framework->asset_path( 'scripts/html5shiv.js' );
			$context['respond'] = $kili_framework->asset_path( 'scripts/respond.min.js' );
			$context['ie8css'] = $kili_framework->asset_path( 'styles/ie8.css' );

			return $context;
		}

		public function theme_setup() {
			global $kili_framework;
			register_nav_menus( array(
				'primary_navigation' => __( 'Primary Navigation', 'helios' ),
				'footer_navigation' => __( 'Footer Navigation', 'helios' ),
			) );
			$kili_framework->render_pages( $this->theme_context() );
		}
		public function add_actions() {
			if (!is_admin()) {
				add_action( 'wp_enqueue_scripts', array($this, 'load_assets') );
			}
		}
		public function load_assets() {
			global $kili_framework;
			wp_enqueue_style( 'theme-style', $kili_framework->asset_path( 'styles/main.css' ), false, null );
			wp_enqueue_style( 'theme-style-overwrite', $kili_framework->asset_path( 'styles/block-styles.css'), array( 'theme-style' ) );
			wp_enqueue_script( 'theme-scripts', $kili_framework->asset_path('scripts/main.js'), ['jquery'], null, true );

	    }
	}

	$helios_class = new Helios;

endif;
