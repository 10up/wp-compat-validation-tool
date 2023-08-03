<?php
namespace WP_Compat_Checker;

class Checker {
	private $checklist = array();

	private $messages = array();

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
		);
	}

	public function set_plugin_name( $value = '' ) {
		$this->checklist['plugin_name']['value'] = $value;

		return $this;
	}

	public function set_php_min_required_version( $value = '' ) {
		$this->checklist['php_min_required_version']['value'] = $value;

		return $this;
	}

	public function set_php_max_required_version( $value = '' ) {
		$this->checklist['php_max_required_version']['value'] = $value;

		return $this;
	}

	public function is_plugin_compatible() {
		foreach ( $this->checklist as $item_name => $item_details ) {
			if ( $item_details['required'] && empty( $item_details['value'] ) ) {
				return false;
			}

			switch ( $item_name ) {
				case 'php_min_required_version':
					if ( version_compare( phpversion(), $item_details['value'], '<' ) ) {
						$this->messages[] = sprintf( esc_html__( 'The minimum PHP version required is %s', $item_details['value'] ) );
					}
					break;

				case 'php_max_required_version':
					if ( version_compare( phpversion(), $item_details['value'], '>' ) ) {
						$this->messages[] = sprintf( esc_html__( 'The maximum PHP version supported is %s', $item_details['value'] ) );
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

		return false;
	}

	public function render_php_compat_error() {
		?>
		<div class="notice notice-error">
			<strong>
				<?php printf( esc_html__( '%s error:' ), $this->checklist['plugin_name']['value'] ); ?>
			</strong>
			<?php if ( count( $this->messages ) > 1 ) : ?>
				<ul>
					<?php foreach ( $this->messages as $message ) : ?>
						<li><?php echo esc_html( $message ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php else: ?>
				<?php echo esc_html( $message ); ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
