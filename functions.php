<?php
if ( ! defined( 'ABSPATH' ) ) exit;
//
// 数値の安全化
//
function numeric_white( $q=0, $type='int' ) {
	$num = 0;
	if( is_numeric( $q ) ) {
		switch( $type ) {
			case 'float' :
				$num = floatval( $q );
				break;
			default :
				$num = intval( $q );
				break;
		}
	}
	return $num;
}
?>
