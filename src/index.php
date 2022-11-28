<?php
// a helper function to lookup "env_FILE", "env", then fallback
if ( ! function_exists( 'getenv_docker' ) ) {
	function getenv_docker( $env, $default ) {
		if ( $fileEnv = getenv( $env . '_FILE' ) ) {
				return rtrim( file_get_contents( $fileEnv ), "\r\n" );
		} elseif ( ( $val = getenv( $env ) ) !== false ) {
				return $val;
		} else {
				return $default;
		}
	}
}

echo getenv_docker( 'MYSQL_ROOT_PASSWORD', 'test' );

// Test DB Connection
$con = new mysqli( 'mysql_db', 'root', 'root' );

if ( $con ) {
	echo 'Connected to db';
}

// Check PHP Info
phpinfo();
