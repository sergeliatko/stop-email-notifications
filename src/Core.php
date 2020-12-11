<?php


namespace SergeLiatko\StopEmailNotifications;


/**
 * Class Core
 *
 * @package SergeLiatko\StopEmailNotifications
 */
class Core {

	/**
	 * @var \SergeLiatko\StopEmailNotifications\Core $instance
	 */
	protected static $instance;

	/**
	 * @return \SergeLiatko\StopEmailNotifications\Core
	 */
	public static function getInstance(): Core {

		if ( !( self::$instance instanceof Core ) ) {
			self::setInstance( new self() );
		}

		return self::$instance;
	}

	/**
	 * @param \SergeLiatko\StopEmailNotifications\Core $instance
	 */
	protected static function setInstance( Core $instance ) {

		self::$instance = $instance;
	}

	/**
	 * Core constructor.
	 */
	protected function __construct() {
	}

}

