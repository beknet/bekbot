<?php
/*
Plugin Name: Bekbot
Plugin URI: https://bekbot.com/
Description: Плагин Bekbot для автоматического кросспостинга статей и других типов записей с Вашего сайта в соц.сети и мессенджеры.
Version: 1.0.0
Author: Bekker Y & Co.
VK group: 154076207
Chanel Telegram: @bekkercoil
Author URI: https://bekker.co.il
Copyright 2014-2018 Bekker Y & Co. (email: dev@bekker.co.il)
*/

define( 'BEKBOT_VERSION', '1.0.0' );
define( 'BEKBOT_URL', 'https://api.bekbot.com' );
define( 'BEKBOT_MINIMUM_WP_VERSION', '4.8' );

define( 'BEKBOT_PLUGIN', __FILE__ );
define( 'BEKBOT_PLUGIN_BASENAME', plugin_basename( BEKBOT_PLUGIN ) );
define( 'BEKBOT_PLUGIN_NAME', ucfirst( trim( dirname( BEKBOT_PLUGIN_BASENAME ), '/' ) ) );

define( 'BEKBOT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BEKBOT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'BEKBOT_PLUGIN_MODADMIN_DIR', BEKBOT_PLUGIN_DIR . '/modules/admin/' );
define( 'BEKBOT_PLUGIN_MODULES_DIR', BEKBOT_PLUGIN_DIR . '/modules/' );
define( 'BEKBOT_PLUGIN_DIR_IMAGES', BEKBOT_PLUGIN_URL . '/img/' );
define( 'BEKBOT_PLUGIN_DIR_CSS', BEKBOT_PLUGIN_URL . '/css/' );
define( 'BEKBOT_PLUGIN_DIR_JS', BEKBOT_PLUGIN_URL . '/js/' );

define( 'ARR_EXIST_TYPES', array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','elementor_library','shop_order','shop_order_refund','shop_coupon','shop_webhook','pojo_slideshow','pojo_forms') );

/* Install plugin
&& Create tables
============================================================*/
function bekbot_install() {
  global $wpdb;
  $newtable = $wpdb->query( "CHECK TABLE `".$wpdb->prefix."beknetbot`" );
  if( $wpdb->last_result[0]->Msg_type == 'Error' ){
    $wpdb->get_results( "CREATE TABLE `".$wpdb->prefix."beknetbot` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `idacc` varchar(10) NOT NULL,
     `lickey` varchar(32) NOT NULL,
     `datatypes` text NOT NULL,
     `datavk` text NOT NULL,
     `datatl` text NOT NULL,
     `datafc` text NOT NULL,
     `datain` text NOT NULL,
     `dataok` text NOT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8" );

    $wpdb->query("INSERT INTO `".$wpdb->prefix."beknetbot` (`id`, `idacc`, `lickey`, `datatypes`, `datavk`, `datatl`, `datafc`, `datain`, `dataok`)
                  VALUES (1, '', '', 'false', '', '', '', '', '')");
  }
  add_option( 'bekbot_db_version', BEKBOT_VERSION);
  add_option( 'active_plugins', BEKBOT_PLUGIN );
} // end function bekbot_install()
register_activation_hook( __FILE__, 'bekbot_install' );

function bekbot_uninstall(){
  global $wpdb;
  add_option( 'active_plugins', BEKBOT_PLUGIN );
} // end function bekbot_uninstall()
register_deactivation_hook( __FILE__, 'bekbot_uninstall' );

/* Install admin menu
============================================================*/
function bekbot_get_menu() {
  // global $server_output;
  // global $datadb_output;
  $current_page = isset($_REQUEST['page']) ? esc_html($_REQUEST['page']) : 'bekbot';

  //global $wpdb;
  require_once BEKBOT_PLUGIN_MODULES_DIR.'connector.ini.php';

  switch ($current_page) {
    case 'bekbot':
      $TITLEPAGE = 'Bekbot';
      require_once BEKBOT_PLUGIN_MODADMIN_DIR.'index.ini.php';
      break;
    case 'bekbot-settings':
      $TITLEPAGE = 'Bekbot Settings';
      require_once BEKBOT_PLUGIN_MODADMIN_DIR . 'settings.ini.php';
      break;
  }
}

function bekbot_admin_menu(){
  add_menu_page( 'Bekbot Plugin v.'.BEKBOT_VERSION, BEKBOT_PLUGIN_NAME, 'administrator', 'bekbot', 'bekbot_get_menu', BEKBOT_PLUGIN_DIR_IMAGES.'bekbot-icon.png', 6);
  //add_submenu_page('bekbot', 'Bekbot Settings', 'Bekbot Settings', 'administrator', 'bekbot-settings', 'bekbot_get_menu');
}
add_action( 'admin_menu', 'bekbot_admin_menu' );

/*
 * Change global style in admin
============================================================*/
function globalstyles_admin(){
  wp_register_style( 'bekbot-globalstyle', BEKBOT_PLUGIN_DIR_CSS.'global.css' );
  wp_enqueue_style( 'bekbot-globalstyle' );
}
add_action( 'admin_print_styles', 'globalstyles_admin' );

/*
 * Style plugin in admin
============================================================*/
function plugin_and_styles_admin(){
  wp_register_style( 'bekbot-mainstyle', BEKBOT_PLUGIN_DIR_CSS.'admin.css' );
  wp_register_style( 'bekbot-bootstrapcss', BEKBOT_PLUGIN_DIR_CSS.'bootstrap.min.css' );
  wp_register_script( 'bekbot-bootstrapjs', BEKBOT_PLUGIN_DIR_JS.'bootstrap.min.js' );

  wp_enqueue_style( 'bekbot-mainstyle' );
  wp_enqueue_style( 'bekbot-bootstrapcss' );
  wp_enqueue_script( 'bekbot-bootstrapjs' );
}

if( isset($_GET['page']) && in_array($_GET['page'], array('bekbot')) ){
  add_action( 'admin_print_styles', 'plugin_and_styles_admin' );
}

/*
 * Include functions
============================================================*/
require_once BEKBOT_PLUGIN_MODULES_DIR.'bekbotfun.ini.php';

/*
 * Include functions
============================================================*/
if( !class_exists( 'bekbotUpdater' ) ){
  include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new bekbotUpdater( __FILE__ );
$updater->set_username( 'beknet' );
$updater->set_repository( 'bekbot' );

// $updater->authorize( 'ed818e06557812cdc507e7f42b24f1a8c1bb13ca' ); // Your auth code goes here for private repos
$updater->initialize();