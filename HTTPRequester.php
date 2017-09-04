<?php

class HTTPRequester {
    /**
     * @description Make HTTP-POST call
     * @param       $url
     * @param       array $params
     * @return      HTTP-Response body or an empty string if the request fails or is empty
     */
    public static function HTTPPost($url, array $params = [], array $headers = []) {
		if(in_array('Content-Type: application/json',$headers)){
			$query = json_encode($params);    
		}else{
			$query = http_build_query($params);
		}
        $ch    = curl_init();
		
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		
		if (defined('HTTPRVERBOSE') && HTTPRVERBOSE) {
			curl_setopt($ch, CURLOPT_VERBOSE, true);
#			$verbose = fopen('./curl.log', 'w+');
#			curl_setopt($ch, CURLOPT_STDERR, $verbose);
		}		
		
	  	$response = curl_exec($ch);
    	curl_close($ch);
    	return $response;
      
    }
}

?>
