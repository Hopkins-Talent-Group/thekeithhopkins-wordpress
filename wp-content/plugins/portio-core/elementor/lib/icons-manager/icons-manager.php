<?php
namespace Elementor;

defined( 'ABSPATH' ) || die();

class Grafco_Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_portio_icons_tab' ] );
    }

    public static function add_portio_icons_tab( $tabs ) {
        $tabs['portio-icons'] = [
            'name' => 'portio-icons',
            'label' => __( 'Portio Icons', 'portio-elementor-addons' ),
            'url' => GRAFCO_PLUGIN_URL . 'elementor/assets/css/flaticon.css',
            'enqueue' => [ GRAFCO_PLUGIN_URL . 'elementor/assets/css/flaticon.css' ],
            'prefix' => 'flaticon-',
            'displayPrefix' => 'fi',
            'labelIcon' => 'flaticon-charity',
            'ver' => '1.0.0',
            'fetchJson' => GRAFCO_PLUGIN_URL . 'elementor/assets/js/portio-icons.js?v=1.0.0',
            'native' => false,
        ];
        return $tabs;
    }

    /**
     * Get a list of portio icons
     *
     * @return array
     */
    public static function get_portio_icons() {
        return [
            'flaticon-loupe' => 'loupe',
            'flaticon-shopping-cart' => 'shopping-cart',
            'flaticon-shopping-cart-1' => 'shopping-cart-1',
            'flaticon-shopping-bag' => 'shopping-bag',
            'flaticon-shopping-cart-2' => 'shopping-cart-2',
            'flaticon-placeholder' => 'placeholder',
            'flaticon-email' => 'email',
            'flaticon-play-button' => 'play-button',
            'flaticon-user' => 'user',
            'flaticon-quotation' => 'quotation',
            'flaticon-quotation-1' => 'quotation-1',
            'flaticon-house' => 'house',
            'flaticon-phone-call' => 'phone-call',
            'flaticon-badge' => 'badge',
            'flaticon-vegan' => 'vegan',
            'flaticon-diary' => 'diary',
            'flaticon-support' => 'support',
            'flaticon-family' => 'family',
            'flaticon-broken-arm' => 'broken-arm',
            'flaticon-wounded' => 'wounded',
            'flaticon-handcuffs' => 'handcuffs',
            'flaticon-graduation-cap' => 'graduation-cap',
            'flaticon-book' => 'book',
            'flaticon-auction' => 'auction',
            'flaticon-balance' => 'balance'
        ];
    }
}

Grafco_Icons_Manager::init();