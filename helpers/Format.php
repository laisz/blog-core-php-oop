<?php
	
	class Format {

		private static $_errors = array();

		public static function formatDate( $date ) {
			return date( 'F j, Y, g:i a', strtotime( $date ) );

		// public function formatDate( $date ) End here...	
		}

		public static function textShorten( $text, $limit = 400 ) {
			
			$text = $text . " ";
			$text = substr( $text, 0, $limit );
			$text = substr( $text, 0, strrpos( $text, ' ' ) );
			$text = $text . "....";
			return $text;

		// public static function textShorten( $text ) End here..
		}

		public static function validation( $data ) {
			$data = trim( $data );
			$data = stripcslashes( $data );
			$data = htmlspecialchars( $data );
			//$data = htmlentities( $data );
			return $data;
		// public static function Validation( $data ) End here...
		}

		public static function title() {
			
			$path	= $_SERVER['SCRIPT_FILENAME'];
			$title	= basename( $path, '.php' );
			if( $title == 'index' ) {
				$title = 'home';
			// if( $title == 'index' ) End here...
			} elseif( $title == 'contact' ) {
				$title = 'contact';
			}
			return $title = ucwords( $title );

		// public static function title() End here...
		}

		public static function errExists( $name ) {
			return ( isset( self::$_errors[$name] ) ) ? true : false;
		}

		public static function setErrors( $name, $value ) {
			return self::$_errors[$name] = $value;
		// public static function setErrors( $name, $value ) End here...
		}



		public static function getErrors( $name ) {
			if( self::errExists( $name ) ) {
				return self::$_errors[$name];
			// if( isset( self::$_errors[$name] ) ) End here...
			}
		// public static function getErrors( $name ) End here
		}

	// class Format End here...	
	}

?>