<?php
namespace nebula\console;

class google_search {

  function __construct() {
    add_action( 'wp_head', array($this , 'google_search_meta' ),1);
  }

  // creates the meta tag
   public function google_search_meta() {
   ?>
    <meta name="google-site-verification" content="<?php echo  get_option('my-options'); ?>" />
   <?php
   }

}
