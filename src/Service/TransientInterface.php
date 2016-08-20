<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

/**
 * Handel transients interface
 * set, create and delete transietn
 *
 * @package wallstreetonline\stockquotes\\Service
 */
interface TransientInterface {


	/**
	 * Set transient
	 *
	 * @return bool
	 */
	public function set();

	/**
	 * Get transient
	 *
	 * @return mixed|void
	 */
	public function get();

	/**
	 * Delete transient
	 *
	 * @return bool
	 */
	public function delete();

}

