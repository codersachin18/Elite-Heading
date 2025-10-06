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


// === Trial Expiry Popup System (3 Days) === //
function elite_heading_trial_popup_script() {
    // Get or set activation time
    $activation_time = get_option('elite_heading_activation_time');
    if (!$activation_time) {
        $activation_time = time();
        update_option('elite_heading_activation_time', $activation_time);
    }

    // Trial: 3 days
    $trial_period    = 3 * DAY_IN_SECONDS;
    $expiry_time  = $activation_time + $trial_period;
    $expired      = time() > $expiry_time;

    // Only load popup on Elite Heading dashboard page
    if (isset($_GET['page']) && $_GET['page'] === 'elite-heading') {
        ?>
        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var expired = <?php echo $expired ? 'true' : 'false'; ?>;
            if (expired) {
                // Create popup overlay
                var overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.background = 'rgba(0,0,0,0.8)';
                overlay.style.zIndex = '9999';
                overlay.style.display = 'flex';
                overlay.style.alignItems = 'center';
                overlay.style.justifyContent = 'center';

                // Popup box
                var box = document.createElement('div');
                box.style.background = '#fff';
                box.style.padding = '30px 40px';
                box.style.borderRadius = '10px';
                box.style.textAlign = 'center';
                box.style.maxWidth = '400px';
                box.style.boxShadow = '0 0 15px rgba(0,0,0,0.2)';
                box.innerHTML = `
                    <h2 style="color:red;">Your Free Trial Has Expired</h2>
                    <p>Please renew your plan to continue using the plugin.</p>
                    <p>Contact on WhatsApp: <a href='https://wa.me/917387574762' target='_blank'>917387574762</a></p>
                    <button id="closeTrialPopup" style="margin-top:15px;background:red;color:white;border:none;padding:8px 15px;border-radius:5px;cursor:pointer;">Close</button>
                `;

                overlay.appendChild(box);
                document.body.appendChild(overlay);

                // Disable dashboard interaction while popup open
                document.querySelectorAll('#wpbody-content *').forEach(el => el.style.pointerEvents = 'none');
                box.style.pointerEvents = 'auto';

                // Close popup
                document.getElementById('closeTrialPopup').addEventListener('click', function() {
                    overlay.remove();
                    document.querySelectorAll('#wpbody-content *').forEach(el => el.style.pointerEvents = '');
                });
            }
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'elite_heading_trial_popup_script');