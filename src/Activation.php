<?php

namespace DF\SocialLocker;

/**
 * Activation class.
 */
class Activation {

	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}

	/**
	 * Plugin activation.
	 */
	public function install() {
		// initialise activation data.
		$this->container['license']->init(); //License init while activating.

		// flush_rewrite_rules();
	}
}
