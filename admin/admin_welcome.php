<?php

namespace nebula\console;

class admin_welcome {

	public function __construct()  {
        add_action( 'admin_init', array($this,'welcome_do_activation_redirect') );
        // Delete the redirect transient
        // Bail if activating from network, or bulk
        if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
            return;
        }
        // add to menu
        add_action('admin_menu', array($this, 'welcome_pages') );
        add_action('admin_head', array($this, 'welcome_remove_menus' ) );
    	}

    public function welcome_do_activation_redirect() {
      // Bail if no activation redirect
        if ( ! get_transient( '_gsearch_welcome' ) ) {
            return;
          }
      // Redirect
      wp_safe_redirect( add_query_arg( array( 'page' => 'google-search-about' ), admin_url( 'index.php' ) ) );
    }

    public function welcome_pages() {
      add_dashboard_page(
        'Google Search Welcome',
        'Google Search Welcome',
        'read',
        'google-search-about',
        array( $this,'welcome_content')
      );
    }

    public function welcome_remove_menus() {
        remove_submenu_page( 'index.php', 'google-search-about' );
    }

   // The welcome screen
    public static function welcome_content() {


    }



}
