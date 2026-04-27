<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( 'Woocommerce/woocommerce-api.php' );

class Woocommerce
{
	protected $options;
	function __construct()	
	{
		// parent::__construct();
		$this->options = array(
			'debug'           => true,
			'return_as_array' => false,
			'validate_url'    => false,
			'timeout'         => 30,
			'ssl_verify'      => false,
		);
	}
	public function request()
	{
	 	$client = new WC_API_Client( 'https://formacall.fr', 'ck_5b041764b615cd207cea4a5fb7ea1ea6d38ae2a7', 'cs_0fbe77d253b78d5271eb2b891e08e22315f20395', $this->options );
	 	return $client;
	}
}