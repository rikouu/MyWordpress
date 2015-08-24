<?php
class Presscore_Action_Manager {

	private $actions;
	private $default_action;

	public function __construct() {
		$this->actions = array();
		$this->found = false;
		$this->unset_default_action();
	}

	public function action_exists( $handler ) {
		return array_key_exists( $handler, $this->actions );
	}

	public function add_action( $handler, $callback ) {
		$result = false;
		if ( is_callable( $callback ) ) {
			$result = true;
			$this->actions[ $handler ] = $callback;
		}

		return $result;
	}

	public function remove_action( $handler ) {
		if ( $this->action_exists( $handler ) ) {
			unset( $this->actions[ $handler] );
		}
	}

	public function do_action( $handler, $args = array() ) {
		$result = false;
		if ( $this->action_exists( $handler ) ) {
			$result = call_user_func_array( $this->actions[ $handler ], $args );
		} else if ( $this->default_action ) {
			$result = call_user_func_array( $this->default_action, $args );
		}

		return $result;
	}

	public function get_default_action() {
		return $this->default_action;
	}

	public function set_default_action( $callback ) {
		if ( is_callable( $callback ) ) {
			$this->default_action = $callback;
		}
	}

	public function unset_default_action() {
		$this->default_action = false;
	}
}
