<?php
namespace Siddharth;

class WP_Compat_Checks {
	private $plugin_name = '';
	private $min_php_version = '';

	public function set_plugin_name( $plugin_name = '' ) {
		$this->plugin_name = $plugin_name;

		return $this;
	}

	public function set_min_php_version( $min_php_version = '' ) {
		$this->min_php_version = $min_php_version;

		return $this;
	}

	public function check() {
		if ( empty( $this->plugin_name ) || empty( $this->min_php_version ) ) {
			return null;
		}

		if ( ! version_compare( phpversion(), $this->min_php_version, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'render_php_compat_error' ) );
			return true;
		}

		return false;
	}

	public function render_php_compat_error() {
		?>
		<div class="notice notice-error">
			<p>
				<?php
				printf(
					esc_html__( '%1$s requires PHP version %2$s or later. Please upgrade PHP or disable the plugin.' ),
					$this->plugin_name,
					$this->min_php_version
				);
				?>
			</p>
		</div>
		<?php
	}
}
