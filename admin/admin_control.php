<?php

namespace nebula\console;

class admin_control {

	public $google_console_code;

  public function __construct(){
		add_action('admin_notices', array($this, 'empty_field_notice'));
		add_action('admin_menu', array($this, 'add_options_page'));
		add_action('admin_post_gsearch_settings', array($this, 'ValidatePage'));
	}

	public function add_options_page(){
		add_options_page('Google Search Admin', 'Google Search', 'manage_options', 'gsearch_admin_page', array($this, 'render_admin'));
	}

	public function render_admin(){
		?>

			<form method="post" enctype="multipart/form-data" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
				<label name="Google_search-value" for="Google_search-value">Search Console Value</label>
				<input name="Google_search-value" type="text" value="<?php echo get_option('my-options'); ?>">
				<input type="hidden" name="action" value="gsearch_settings">
				<?php
					wp_nonce_field('Gsearch-settings-save', 'Gsearch-custom-message');
					submit_button();
				?>
			</form>

		<?php
	}

	function ValidatePage(){
		$this->google_console_code = sanitize_text_field($_POST['Google_search-value']);
		$this->SavePage();
	}

	private function SavePage(){
		if(!($this->has_valid_nonce() && current_user_can('manage_options'))){
			echo "Error: You can not save this data";
			exit;
		}

		update_option('my-options', $this->google_console_code);
		$this->redirect();
	}

	private function has_valid_nonce(){
		if(!isset($_POST['Gsearch-custom-message'])){
			return false;
		}

		$field = wp_unslash($_POST['Gsearch-custom-message']);
		$action = 'Gsearch-settings-save';

		return wp_verify_nonce($field, $action);
	}

	private function redirect(){
		if(!isset($_POST['_wp_http_referer'])){
			$_POST['_wp_http_referer'] = wp_login_url();
		}

		$url = sanitize_text_field(wp_unslash($_POST['_wp_http_referer']));

		wp_safe_redirect(urldecode($url));
		exit;
	}

	function empty_field_notice(){
		if(strlen(get_option('my_options')) > 10) return;

		?>
			<div class="notice notice-warning is-dismissible">
				<p>
					You need to enter your Google Search Console value - <a href="/wp-admin/options-general.php?page=gsearch-admin-page">Click here to fix</a>
				</p>
			</div>

		<?php
	}

}
