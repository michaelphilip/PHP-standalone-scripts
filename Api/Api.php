<?php
/** 
 * PHP
 * Call Rest API using cURL Extension
 */

class Api
{	
	/**
	 *	@params: $method = POST, PUT, GET etc... 
	 *  	   : $data = array('param' => 'value') == api.php?param=value
	 *  @return: depends on API FORMAT 
	 */
	public function call($method, $url, $data = false) 
	{
		$curl = curl_init();
		
		switch ($method) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				
				if ($data) {
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				}
				break;
			
			case "PUT":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;
			default:
				if ($data) {
					$url = sprintf("%s?%s", $url, http_build_query($data));		
				}
		}
		
		// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
		return curl_exec($curl);
	}
}