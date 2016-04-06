PHP-standalone-scripts
======================

All PHP standalone scripts
    <br/><br/>
    <strong>Class</strong>
    <ul>
      <li>API Class</li>
         Call REST Api using php cURL Extension
       <li>CookieTrait </li>
         Use to check whether browser cookie is enabled. You may use for storing, getting, destroying the cookies by name
    </ul>
    
Sample Usage
======================
API Class
--------
Im using http://www.binlist.net/ web service (REST API) to check the bank identification number.

    $format = 'json'; //format can be (json, xml etc.) <br />
    $bin    = 429503; //checking (Bank Identification Number)<br />
    $apiUrl = "http://www.binlist.net/{$format}/{$bin}";<br />
    $api = new Api(); //instantiate API Class<br />
    $checkBin = $api->call('GET', $apiUrl); //call API call method<br />
    var_dump($checkBin); //check output


Cookie Class
----------
Here's the sample on how to use the CookieTraits in your controller. 

    /**
     * Class SampleController
     */
    class SampleController extends AbstractController
    {
        use CookieTraits;
    
        /**
         * Get the index page
         *
         * @param Request $request
         */
        public function index(Request $request)
        {
            if (false === $this->isCookieEnabled()) {
                // do necessary action if cookie is not enabled
            }
            
            // proceed to the next step
        }
        
    }
