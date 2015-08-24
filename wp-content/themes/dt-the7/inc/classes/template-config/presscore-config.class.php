<?php
/**
 * Config class.
 *
 * @since presscore 1.0
 */

interface Presscore_Config_Interface {
	public function set( $name, $value = null, $default = null );
	public function reset( $options = array() );
	public function get( $name = '' );
}

/**
 * Singleton.
 *
 */
class Presscore_Config implements Presscore_Config_Interface{

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new Presscore_Config();
		}

		return self::$instance;
	}

	protected function __construct() {}

	private function __clone() {}

	private function __wakeup() {}

	private static $instance = null;

	private $options = array();

	private $options_statistic = array(
		'miss' => array()
	);

	/**
	 * Description here
	 *
	 * @param string $name    Setting name
	 * @param mixed $value    Setting value
	 * @param mixed $default  Setting default value, used if $value === '' or $value === null
	 */
	public function set( $name, $value = null, $default = null ) {

		if ( ('' === $value || null === $value) && isset($default) ) {
			$this->options[ $name ] = $default;

		} else {
			$this->options[ $name ] = $value;

		}
	}

	public function reset( $options = array() ) {
		$this->options = $options;
	}

	public function get( $name = '' ) {
		if ( '' == $name ) {
			return $this->options;
		}

		if ( isset( $this->options[ $name ] ) ) {
			return $this->options[ $name ];

		} else {

			// debug
			array_push( $this->options_statistic['miss'], $name );

		}

		return null;
	}

	/**
	 * Debug method. Dump setting array that contains $search_name. If $search_name is empty - dump all stored settings.
	 *
	 * @since  4.1.4
	 * @param  string $search_name Setting name for search
	 */
	public function dump( $search_name = '' ) {

		echo '<pre style="background-color: #F1F1F1; padding: 10px;">';
		echo '<span style="background-color: #FFFFFF; color: red;">' . __METHOD__ . ' => ' . $search_name . '</span></br>';

		if ( $search_name ) {
			$options = array();

			foreach ( $this->options as $option_name => $value ) {

				if ( false !== strpos($option_name, $search_name) ) {
					$options[ $option_name ] = $value;
				}
			}
			var_dump( $options );

		} else {
			var_dump( $this->options );

		}
		echo '</pre>';

	}

	/**
	 * Debug method. Display statistic for settigs usage.
	 *
	 * @since 4.1.4
	 */
	public function stat() {

		echo '<pre style="background-color: #F1F1F1; padding: 10px;">';
		echo 'miss :' . count( $this->options_statistic['miss'] ) . "\n" . '</br>';

		print_r( $this->options_statistic['miss'] );

		echo '</pre>';
	}

}

if ( ! function_exists( 'presscore_get_config' ) ) :

	/**
	 * @return Presscore_Config
	 */
	function presscore_get_config() {
		return Presscore_Config::get_instance();
	}

endif;
