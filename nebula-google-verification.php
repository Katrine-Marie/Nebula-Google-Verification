<?php
/**********
* Plugin Name: Nebula Google Verification
* Plugin URI: https://github.com/Katrine-Marie/Nebula-Google-Verification
* Description: Verify your site with Google Search Console by inserting the google meta tag into your site's head section.
* Version: 1.3.0
* Author: Katrine-Marie Burmeister
* Author URI: https://fjordstudio.dk
* License:     GNU General Public License v3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

namespace nebula\console;

if(!defined('ABSPATH')){
	exit('Go away!');
}

define('nebula_gsearch_DIR', plugin_dir_path(__FILE__));
$mystart = new MyInit();

include_once nebula_gsearch_DIR . 'admin/admin_control.php';
$admin_page = new admin_control();

include_once nebula_gsearch_DIR . 'user/user_control.php';
$mysearch = new google_search();

// Welcome screen
include_once nebula_gsearch_DIR . 'admin/admin_welcome.php';
$welcome_page = new admin_welcome();

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
