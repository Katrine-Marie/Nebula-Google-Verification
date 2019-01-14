<?php
/**********
* Plugin Name: Nebula Google Verification
* Plugin URI: http://google.com
* Description: Verify your site with Google Search Console by inserting the google meta tag into your site's head section.
* Version: 1.0.0
* Author: Katrine-Marie Burmeister
* Author URI: https://fjordstudio.dk
* License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace nebula\console;

if(!defined('ABSPATH')){
	exit('Go away!');
}

define('nebula_gsearch_DIR', plugin_dir_path(__FILE__));
$mystart = new MyInit();

// TODO: INCLUDE files and instantiate classes

class MyInit{
  public function __construct(){
    register_activation_hook( __FILE__, array($this, 'plugin_activated' ));
    register_deactivation_hook( __FILE__, array($this, 'plugin_deactivated' ));
    register_uninstall_hook( __FILE__, array($this, 'plugin_uninstall' ) );
  }
  public static function plugin_activated(){
		set_transient('_gsearch_welcome',true,30);
  }
  public function plugin_deactivated(){

  }
  public function plugin_uninstall() {

  }
}
