<?php

$cfg_host = 'localhost' ;
$cfg_port = '6379' ; // or 0 if use socket
$cfg_pswd = '' ; // Set if has
$cfg_db = 0 ;


$conn = new Redis() ;
$conn->connect( $cfg_host, $cfg_port ) ;
if ( $cfg_pswd ) $conn->auth( $cfg_pswd ) ;
if ( $cfg_db ) $conn->select( $cfg_db ) ;

var_dump( $this->_conn->ping() ) ; // Should give a `+PONG`
?>
