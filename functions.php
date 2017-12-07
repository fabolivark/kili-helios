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

			//Add theme Support
			add_theme_support( 'post-thumbnails' );

			$kili_framework->render_pages( $this->theme_context() );
		}

		public function add_actions() {
			// Init Widgets
			add_action( 'widgets_init', array($this, 'helios_widgets_init') );

			if (!is_admin()) {
				add_action( 'wp_enqueue_scripts', array($this, 'load_assets') );
			}
		}

		public function helios_widgets_init() {
			register_sidebar( array(
				'name' => __( 'Main Sidebar', 'helios' ),
				'id' => 'sidebar-1',
				'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'helios' ),
				'before_widget' => '<section id="%1$s" class="%2$s">',
				'after_widget' => '</section><hr>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
				)
			);
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
