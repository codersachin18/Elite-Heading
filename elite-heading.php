<?php
/**
 * Plugin Name: Elite Heading
 * Description: Elementor heading widget with predefined gradients, typography and typing animations.
 * Version: 1.6
 * Author: Coder Sachin
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: elite-heading
 * Domain Path: /languages
 * Requires PHP: 7.2
 * Requires at least: 5.0
 * Tested up to: 6.5
 *  */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ELITE_HEADING_DIR', plugin_dir_path( __FILE__ ) );
define( 'ELITE_HEADING_URL', plugin_dir_url( __FILE__ ) );
define( 'ELITE_HEADING_VERSION', '1.0' );

// Include admin pages only
require_once ELITE_HEADING_DIR . 'includes/admin-pages.php';

/**
 * Enqueue frontend assets for widget.
 */
function elite_heading_enqueue_assets() {
    wp_enqueue_style( 'elite-heading-frontend', ELITE_HEADING_URL . 'assets/css/frontend.css', array(), ELITE_HEADING_VERSION );
    wp_enqueue_script( 'elite-heading-frontend', ELITE_HEADING_URL . 'assets/js/frontend.js', array( 'jquery' ), ELITE_HEADING_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'elite_heading_enqueue_assets' );

/**
 * Load widget file and register after Elementor is ready.
 */
if ( ! function_exists( 'elite_heading_register_elementor_widget' ) ) {
    function elite_heading_register_elementor_widget( $widgets_manager ) {
        require_once ELITE_HEADING_DIR . 'includes/elementor-widget.php';
        if ( class_exists( 'Elite_Heading_Widget' ) ) {
            $widgets_manager->register( new \Elite_Heading_Widget() );
        }
    }

    
        add_action( 'elementor/widgets/register', 'elite_heading_register_elementor_widget' );
}

// ------------------------------
function elite_heading_plugin_action_links($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $dashboard_link = '<a href="' . admin_url('admin.php?page=elite-heading&tab=dashboard') . '">Dashboard</a>';
        array_unshift($links, $dashboard_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'elite_heading_plugin_action_links', 10, 2);
