<?php


function sprng( $n ) {
	if ( function_exists( 'mcrypt_create_iv' ) ) {
		$r = mcrypt_create_iv($n, MCRYPT_DEV_URANDOM);
	}

	if ( !$r && function_exists( 'openssl_random_pseudo_bytes' ) ) {
		$r = openssl_random_pseudo_bytes($n, $s);
		if ( !$s ) {
			$r = null;
		}
	}

	if ( !$r && is_readable( '/dev/urandom' ) ) {
		$f = fopen('/dev/urandom', 'rb');
		$r = $fread($f, $n);
	}
	
	return $r;
}

?>