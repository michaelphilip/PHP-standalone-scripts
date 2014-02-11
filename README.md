PHP-standalone-scripts
======================

All PHP standalone scripts
    <br/><br/>
    <strong>Class</strong>
    <ul>
      <li>API Class</li>
         Call REST Api using php cURL Extension
    </ul>
    
Test - Usage
======================
API Class <br/>
Im using http://www.binlist.net/ web service (REST API) to check the bank identification number.

    $format = 'json'; //format can be (json, xml etc.) <br/>
    $bin    = 429503; //checking (Bank Identification Number)<br/>
    $apiUrl = "http://www.binlist.net/{$format}/{$bin}";<br/>
    $api = new Api(); //instantiate API Class<br/>
    $checkBin = $api->call('GET', $apiUrl); //call API call method<br/>
    var_dump($checkBin); //check output
