PHP-standalone-scripts
======================

All PHP standalone scripts without using 

/* TEST - Usage*/
/* We are calling fetching info from http://www.binlist.net/ API */

$format = 'json'; //format can be (json, xml etc.)
$bin    = 429503; //checking (Bank Identification Number)
$apiUrl = "http://www.binlist.net/{$format}/{$bin}"; 

$api = new Api(); //instantiate API Class
$checkBin = $api->call('GET', $apiUrl); //call API call method
var_dump($checkBin); //check output
