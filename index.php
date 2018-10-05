<?php 
/**
* 
*/
class Notification
{
	
	function __construct()
	{
		# code...
	}

	public function test()
	{
		include_once 'jwt/JWT.php';
		$url = 'http://localhost/puis/ApiServerToServer';
		$data = array(
				'adi' => 'adi'
			);

        $key = "UAP)(*";
        $JWT = new JWT();
        $Input = $JWT->encode($data,$key);

		$data = array(
		    'client_id' => '10.1.30.102',
		    'data' => $Input,
		);

		$response = $this->get_content($url, json_encode($data));
		$response_json = json_decode($response, true);
		print_r($response_json);
	}

	private function get_content($url, $post = '') {
	    $usecookie = __DIR__ . "/cookie.txt";
	    $header[] = 'Content-Type: application/json';
	    $header[] = "Accept-Encoding: gzip, deflate";
	    $header[] = "Cache-Control: max-age=0";
	    $header[] = "Connection: keep-alive";
	    $header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_VERBOSE, false);
	    // curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_ENCODING, true);
	    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

	    if ($post)
	    {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    }

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    $rs = curl_exec($ch);

	    if(empty($rs)){
	        var_dump($rs, curl_error($ch));
	        curl_close($ch);
	        return false;
	    }
	    curl_close($ch);
	    return $rs;
	}
}

$Notification = new Notification();
$Notification->test();



 ?>