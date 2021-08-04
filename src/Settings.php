<?php


namespace SergeLiatko\StopEmailNotifications;

use SergeLiatko\WPSettings\UI;

/**
 * Class Settings
 *
 * @package SergeLiatko\StopEmailNotifications
 */
class Settings {

	/**
	 * @var \SergeLiatko\StopEmailNotifications\Settings $instance
	 */
	protected static $instance;

	/**
	 * @return \SergeLiatko\StopEmailNotifications\Settings
	 */
	public static function getInstance(): Settings {
		if ( !self::$instance instanceof Settings ) {
			self::setInstance( new self() );
		}

		return self::$instance;
	}

	/**
	 * @param \SergeLiatko\StopEmailNotifications\Settings $instance
	 */
	public static function setInstance( Settings $instance ) {
		self::$instance = $instance;
	}

	/**
	 * Settings constructor.
	 */
	protected function __construct() {
		new UI( array(
			'pages' => array(
				array(
					'slug'     => 'stop-email-notifications',
					'parent'   => 'options-general.php',
					'label'    => __( 'Stop notifications', 'stop-email-notifications' ),
					'title'    => __( 'Stop Email Notifications Settings', 'stop-email-notifications' ),
					'sections' => array(
						array(
							'id'          => 'registration',
							'title'       => __( 'User registration', 'stop-email-notifications' ),
							'description' => __( 'Email notifications sent on new user registration.', 'stop-email-notifications' ),
							'settings'    => array(
								array(
									'option' => Core::REGISTRATION_ADMIN,
									'type'   => 'checkbox',
									'label'  => __( 'Do not send to admins.', 'stop-email-notifications' ),
								),
								array(
									'option' => Core::REGISTRATION_USER,
									'type'   => 'checkbox',
									'label'  => __( 'Do not send to user.', 'stop-email-notifications' ),
								),
							),
						),
						array(
							'id'          => 'passwords_change',
							'title'       => __( 'User password changes', 'stop-email-notifications' ),
							'description' => __( 'Email notifications sent on user password changes.', 'stop-email-notifications' ),
							'settings'    => array(
								array(
									'option' => Core::PASSWORD_CHANGE_ADMIN,
									'type'   => 'checkbox',
									'label'  => __( 'Do not send to admins.', 'stop-email-notifications' ),
								),
							),
						),
					),
				),
			),
		) );
	}

}
