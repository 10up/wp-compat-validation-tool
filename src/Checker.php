<?php
namespace WP_Compat_Validation_Tools;

class Validator {
	/**
	 * Array of checks.
	 *
	 * @var array
	 */
	private $checklist = array();

	/**
	 * Array of error messages
	 *
	 * @var string[]
	 */
	private $messages = array();

	/**
	 * Constructor function.
	 */
	public function __construct() {
		$this->checklist = array(
			'plugin_name'              => array(
				'value'    => '',
				'required' => true,
			),
			'php_min_required_version' => array(
				'value'    => '',
				'required' => false,
			),
			'php_max_required_version' => array(
				'value'    => '',
				'required' => false,
			),
			'wp_min_required_version' => array(
				'value'    => '',
				'required' => false,
			),
			'wp_max_required_version' => array(
				'value'    => '',
				'required' => false,
			),
		);
	}

	/**
	 * Sets the plugin name.
	 *
	 * @param string $value Plugin name.
	 * @return Validator
	 */
	public function set_plugin_name( $value = '' ) {
		$this->checklist['plugin_name']['value'] = $value;

		return $this;
	}

	/**
	 * Sets the minimum PHP version supported by a plugin.
	 *
	 * @param string $value Minimum PHP version.
	 * @return Validator
	 */
	public function set_php_min_required_version( $value = '' ) {
		$this->checklist['php_min_required_version']['value'] = $value;

		return $this;
	}

	/**
	 * Sets the maximum PHP version supported by a plugin.
	 *
	 * @param string $value Maximum PHP version.
	 * @return Validator
	 */
	public function set_php_max_required_version( $value = '' ) {
		$this->checklist['php_max_required_version']['value'] = $value;

		return $this;
	}

	/**
	 * Sets the minimum WordPress version supported by a plugin.
	 *
	 * @param string $value Minimum WordPress version.
	 * @return Validator
	 */
	public function set_wordpress_min_required_version( $value = '' ) {
		$this->checklist['wp_min_required_version']['value'] = $value;

		return $this;
	}

	/**
	 * Sets the maximum WordPress version supported by a plugin.
	 *
	 * @param string $value Maximum WordPress version.
	 * @return Validator
	 */
	public function set_wordpress_max_required_version( $value = '' ) {
		$this->checklist['wp_max_required_version']['value'] = $value;

		return $this;
	}

	/**
	 * Returns true if the plugin meets all compatibility checks, false otherwise.
	 *
	 * @return boolean
	 */
	public function is_plugin_compatible() {
		foreach ( $this->checklist as $item_name => $item_details ) {
			if ( $item_details['required'] && empty( $item_details['value'] ) ) {
				return false;
			}

			switch ( $item_name ) {
				case 'php_min_required_version':
					if ( ! empty( $item_details['value'] ) && version_compare( phpversion(), $item_details['value'], '<' ) ) {
						$this->messages[] = sprintf( esc_html__( 'The minimum PHP version required is %s' ), $item_details['value'] );
					}
					break;

				case 'php_max_required_version':
					if ( ! empty( $item_details['value'] ) && version_compare( phpversion(), $item_details['value'], '>' ) ) {
						$this->messages[] = sprintf( esc_html__( 'The maximum PHP version supported is %s' ), $item_details['value'] );
					}
					break;

				default:
					break;
			}
		}

		if ( ! empty( $this->messages ) ) {
			add_action( 'admin_notices', array( $this, 'render_php_compat_error' ) );
			return false;
		}

		return true;
	}

	/**
	 * Renders the error messages as notice.
	 */
	public function render_php_compat_error() {
		?>
		<div class="notice notice-error">
			<p>
				<strong>
					<?php printf( esc_html__( '%s error:' ), $this->checklist['plugin_name']['value'] ); ?>
				</strong>
			</p>
			<?php if ( count( $this->messages ) > 1 ) : ?>
				<ul>
					<?php foreach ( $this->messages as $message ) : ?>
						<li><?php echo esc_html( $message ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php elseif ( 1 === count( $this->messages ) ): ?>
				<p>
					<?php echo esc_html( $this->messages[0] ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}
