<?php
add_action( 'wp_enqueue_scripts', 'portio_enqueue_styles' );
function portio_enqueue_styles() {
  $parent_style = 'portio-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/styles.css', array('themify-icons', 'flaticon', 'bootstrap', 'animate','owl-carousel','owl-theme', 'slick', 'slick-theme','owl-transitions','fancybox','fancybox') );
  wp_enqueue_style( 'portio-child',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style ),
      wp_get_theme()->get('Version')
    );
}
if( ! function_exists( 'portio_child_theme_language_setup' ) ) {
  function portio_child_theme_language_setup(){
    load_theme_textdomain( 'portio-child', get_template_directory() . '/languages' );
  }
  add_action('after_setup_theme', 'portio_child_theme_language_setup');
}


function add_fancybox_for_carousel() {
    // Fancybox CSS
    wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css', array(), null );

    // Fancybox JS
    wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'add_fancybox_for_carousel' );

/**
 * Add a custom rewrite rule for 'fillmypipeline'.
 */
function portio_child_custom_routes() {
    add_rewrite_rule(
        '^fillmypipeline/?$',
        'index.php?custom_route=fillmypipeline',
        'top'
    );
}
add_action('init', 'portio_child_custom_routes');

function portio_child_query_vars($vars) {
    $vars[] = 'custom_route';
    return $vars;
}
add_filter('query_vars', 'portio_child_query_vars');

function portio_child_template_include($template) {
    if (get_query_var('custom_route') === 'fillmypipeline') {
        // Look for a file named fillmypipeline.php in the child theme folder
        $new_template = locate_template(array('fillmypipeline.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'portio_child_template_include');

/* ============================================================
 * TRACKING: Capture fbclid + UTM params and inject into forms
 * ============================================================ */

/**
 * 1. Capture fbclid / UTM params from URL and store in 30-day cookies.
 */
function tk_capture_tracking_params() {
    if ( is_admin() ) {
        return;
    }

    $params = array( 'fbclid', 'gclid', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' );

    foreach ( $params as $param ) {
        if ( ! empty( $_GET[ $param ] ) ) {
            $value = sanitize_text_field( wp_unslash( $_GET[ $param ] ) );

            // Set a 30-day cookie so it survives navigation across the site
            setcookie(
                'tk_' . $param,
                $value,
                time() + ( 30 * DAY_IN_SECONDS ),
                '/'
            );

            // Make it immediately available in this same request
            $_COOKIE[ 'tk_' . $param ] = $value;
        }
    }
}
add_action( 'init', 'tk_capture_tracking_params' );

/**
 * 2. Inject tracking values into any hidden fields on the page.
 *    Works with GHL embeds, CF7, WPForms, Elementor, etc.
 */
function tk_inject_tracking_into_forms() {
    ?>
    <script>
    (function() {
        function getCookie(name) {
            var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? decodeURIComponent(match[2]) : '';
        }

        var tracking = {
            fbclid:       getCookie('tk_fbclid'),
            gclid:        getCookie('tk_gclid'),
            utm_source:   getCookie('tk_utm_source'),
            utm_medium:   getCookie('tk_utm_medium'),
            utm_campaign: getCookie('tk_utm_campaign'),
            utm_content:  getCookie('tk_utm_content'),
            utm_term:     getCookie('tk_utm_term')
        };

        function fillHiddenFields() {
            Object.keys(tracking).forEach(function(name) {
                if (!tracking[name]) return;

                // Fill any matching input / textarea / select
                document.querySelectorAll('[name="' + name + '"]').forEach(function(el) {
                    if (el.value === '' || el.value === undefined) {
                        el.value = tracking[name];
                    }
                });
            });

            // Also store in sessionStorage as a fallback for GHL iframes
            try {
                sessionStorage.setItem('tk_tracking', JSON.stringify(tracking));
            } catch (e) {}
        }

        // Run on DOMContentLoaded and again after a delay in case forms render late
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fillHiddenFields);
        } else {
            fillHiddenFields();
        }
        setTimeout(fillHiddenFields, 1500);
        setTimeout(fillHiddenFields, 3500);
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'tk_inject_tracking_into_forms' );

/**
 * 3. (Optional) Shortcode to output the stored fbclid anywhere.
 *    Usage: [tk_fbclid]
 */
function tk_fbclid_shortcode() {
    if ( ! empty( $_COOKIE['tk_fbclid'] ) ) {
        return esc_html( sanitize_text_field( $_COOKIE['tk_fbclid'] ) );
    }
    return '';
}
add_shortcode( 'tk_fbclid', 'tk_fbclid_shortcode' );