<?php
/**
 * Plugin Name: One Click Master
 * Description: Get current template name on adminbar. It also shows woredpress current version and the current theme name.
 * Version: 1.0.0
 * Author: Nazrul Islam Nayan
 * Text Domain: one-click-master
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Final Class OneClickMaster {
    /**
     * plugin version
     * 
     * @var string 
     * @since 1.0.0
     */
    public $version = '1.0.0';

    /**
     * instance of 'one-click-master' plugin
     * 
     * @var boolean
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * Self Plugin Instant Function
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->setup();
        }

        return self::$instance;
    }

    /**
     * Setup OneClickMaster functions.
     *
     * @since 1.0.0
     * @return void
     */
    public function setup() {
        $this->define_constants();
        $this->plugin_init();
        $this->includes();
    }

    /**
     * Define OneClickMaster Constants.
     *
     * @since 1.0.0
     * @return void
     */
    private function define_constants() {
        define( 'OCM_VERSION', $this->version );
        define( 'OCM_FILE', __FILE__ );
        define( 'OCM_PATH', dirname( OCM_FILE ) );
        define( 'OCM_URL', plugins_url( '', OCM_FILE ) );
        define( 'OCM_ASSETS_URL', OCM_URL . '/assets' );
        define( 'OCM_ADMIN_URL', OCM_URL . '/admin' );
    }

    /**
     * Plugin Initialize Function
     * @since 1.0.0
     */
    public function plugin_init() {
        add_action( 'admin_enqueue_scripts', array( $this, "ocm_enqueue_scripts" ), 9999 );
        add_action( 'init', array( $this, 'init_functions' ) );
    }

    /**
     * Includes Files
     * @since 1.0.0
     */
    public function includes() {
        include_once OCM_PATH . '/modules/ocm-post-list-table.php';
    }

    /**
     * Enqueue Callback
     * @since 1.0.0
     */
    public function ocm_enqueue_scripts() {
        
        //admin styles
        if( is_admin() ) {
            wp_enqueue_style( 'ocm-fontawesome', OCM_ADMIN_URL . "/assets/css/font-awesome.min.css" );
            wp_enqueue_style( 'ocm-tooltipster', OCM_ADMIN_URL . "/assets/css/tooltipster.bundle.min.css" );
            wp_enqueue_style( 'ocm-tooltipster-theme', OCM_ADMIN_URL . "/assets/css/tooltipster-sideTip-borderless.min.css" );
            wp_enqueue_style( 'ocm-admin-stylesheet', OCM_ADMIN_URL . "/assets/css/ocm-admin-style.css" );

            
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'ocm-tooltipster-js', OCM_ADMIN_URL . "/assets/js/tooltipster.bundle.min.js", [ 'jquery' ], OCM_VERSION, true );
            wp_enqueue_script( 'ocm-admin-js', OCM_ADMIN_URL . "/assets/js/ocm-admin.js", [ 'jquery' ], OCM_VERSION, true );
        }
    }

    /**
     * Initialize plugin for localization
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init_functions() {
        load_plugin_textdomain( 'one-click-master', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
}


/**
 * Plugin Fire Function
 * 
 * @since 1.0.0
 */
if( ! function_exists('one_click_master') ) {
    function one_click_master() {
        return OneClickMaster::instance();
    }
}

//get set go!!!
one_click_master();