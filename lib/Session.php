<?php

	class Session {

		public static function init() {
			session_start();
		// public static function init() End here...
		}

		public static function set( $name, $value ) {
			return $_SESSION[$name] = $value;
		// public static function set( $name, $value ) End here...
		}

		public static function get( $name ) {
			if( isset( $_SESSION[$name] ) ) {
				return $_SESSION[$name];
			// if( isset( $_SESSION[$name] ) ) End here...
			} else {
				return false;
			}
		// public static function get( $name ) End here...
		}

		public static function checkSession() {
			self::init();
			if( self::get( "login" ) == false  ) {
				self::destroy();
				header( "Location: login.php" );
			// if( self::get( "login" ) == false  ) End here...
			}
		// public static function checkSession() End here...
		}

		public static function checkLogin() {
			self::init();
			if( self::get( "login" ) == true ) {
				header( "Location: index.php" );
			// if( self::get( "login" ) == true ) End here...
			}
		// public static function checkLogin() End here...
		}

		public static function destroy() {
			session_destroy();
			header( "Location: login.php" );
		// public static function destroy() End here...
		}

	// class Session End here...	
	}

?>