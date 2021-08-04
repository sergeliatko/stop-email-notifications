<?php


namespace SergeLiatko\StopEmailNotifications;


/**
 * Class Core
 *
 * @package SergeLiatko\StopEmailNotifications
 */
class Core {

	//options
	public const REGISTRATION_USER     = 'sen_registration_user';
	public const REGISTRATION_ADMIN    = 'sen_registration_admin';
	public const PASSWORD_CHANGE_ADMIN = 'sen_password_change_admin';

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
		//load settings
		Settings::getInstance();
		//handle new user registration notifications
		add_action( 'init', array( $this, 'handle_notifications' ), 10, 0 );
	}

	/**
	 * Handles registration notifications depending on the user options.
	 */
	public function handle_notifications() {
		//registration
		if (
			$this->isSelected( self::REGISTRATION_ADMIN )
			|| $this->isSelected( self::REGISTRATION_USER )
		) {
			remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
			remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications' );
			add_action( 'register_new_user', array( $this, 'send_new_user_notification' ), 10, 1 );
			add_action( 'edit_user_created_user', array( $this, 'send_new_user_notification' ), 10, 1 );
		}
		//password changes
		if ( $this->isSelected( self::PASSWORD_CHANGE_ADMIN ) ) {
			remove_action( 'after_password_reset', 'wp_password_change_notification' );
		}
	}

	/**
	 * @param int $user_id
	 */
	public function send_new_user_notification( int $user_id ) {
		//if both notifications disabled - do nothing
		if ( $this->isSelected( self::REGISTRATION_ADMIN ) && $this->isSelected( self::REGISTRATION_USER ) ) {
			return;
		}
		//if user is disabled
		if ( $this->isSelected( self::REGISTRATION_USER ) ) {
			wp_send_new_user_notifications( $user_id, 'admin' );

			return;
		}
		//if admin is disabled
		if ( $this->isSelected( self::REGISTRATION_ADMIN ) ) {
			wp_send_new_user_notifications( $user_id, 'user' );

			return;
		}
		//here none is selected - send to both (both is default)
		wp_send_new_user_notifications( $user_id );
	}

	/**
	 * @param string $option
	 *
	 * @return bool
	 */
	protected function isSelected( string $option ): bool {
		return !$this->isEmpty( get_option( $option, false ) );
	}

	/**
	 * @param mixed|null $data
	 *
	 * @return bool
	 */
	protected function isEmpty( $data = null ): bool {
		return empty( $data );
	}

}

