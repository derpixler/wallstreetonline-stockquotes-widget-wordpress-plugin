<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

/**
 * Handel transients
 * set, create and delete transietn
 *
 * @package wallstreetonline\stockquotes\\Service
 */
class TransientHandler implements TransientInterface {

	/**
	 * The current state of a transient
	 *
	 * @var bool
	 */
	public $status = FALSE;

	/**
	 * The transient key
	 *
	 * @var string
	 */
	private $key = FALSE;

	/**
	 *  Time until expiration in seconds. 0 (no expiration).
	 *
	 * @var int
	 */
	private $expire = 1440;

	/**
	 * @param $option_name
	 */
	public function __construct( $prefix ){

		$this->key = $prefix . '_transient';

	}

	/**
	 * Set transient
	 *
	 * @return bool
	 */
	public function set() {

		$this->status = set_transient( $this->key, true, $this->expire );

		return $this->status;

	}

	/**
	 * Get transient
	 *
	 * @return mixed|void
	 */
	public function get(){

		$this->status = get_transient( $this->key );

		return $this->status;

	}

	/**
	 * Delete transient
	 *
	 * @return bool
	 */
	public function delete(){

		delete_transient( $this->key );

		$this->status = FALSE;

	}

}

