<?php
define('_HOST_NAME_', 'localhost');
define('_USER_NAME_', 'bcc');
define('_DB_PASSWORD', 'cuny');
define('_DATABASE_NAME_', 'BCC');
define('HASH','ILOVESAM4711SHEISMYBABYGIRL<3');
const INTERNAL_API_KEY = "EA71EBA8F0DAF5DBEDA00919B7FE174B";
const INTERNAL_API_KEY_LOWER = "ea71eba8f0daf5dbeda00919b7fe174b";

abstract class API
{

    protected $headers = array();
    /**
     * Property: method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     */
    protected $method = '';
    /**
     * Property: endpoint
     * The Model requested in the URI. eg: /files
     */
    protected $endpoint = '';
    /**
     * Property: verb
     * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods. eg: /files/process
     */
    protected $verb = '';
    /**
     * Property: args
     * Any additional URI components after the endpoint and verb have been removed, in our
     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
     */
    protected $args = Array();
    /**
     * Property: file
     * Stores the input of the PUT request
     */
    protected $file = Null;

    protected $pdoInstance = Null;

    /**
     * @return null|PDO
     */
    public function getPdoInstance()
    {
        return $this->pdoInstance;
    }

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct($request)
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        try {
            $this->pdoInstance = new PDO('mysql:host=' . _HOST_NAME_ . ';dbname=' . _DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
            $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdoInstance->exec("set names utf8");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $this->headers = getallheaders();
        $this->args = explode('/', rtrim($request, '/'));
        $this->endpoint = array_shift($this->args);
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->verb = array_shift($this->args);
        }
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        switch ($this->method) {
            case 'DELETE':
            case 'POST':
                $this->request = $this->_cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                $this->_response(405,"Invalid Request","You made an invalid api request.", 'Invalid Method');
                break;
        }
        foreach ($_FILES as $key => $val){
            $this->request[$key] = $val;
        }
    }

    protected function headerHasKey($key){
        return array_key_exists($key, $this->headers);
    }

    protected function headerHasKeys(){
        return !empty($this->headers);
    }

    protected function getHeaderValueFromKey($key){
        return $this->headers[$key];
    }

    public function processAPI()
    {
        if (method_exists($this, $this->endpoint)) {
            return $this->_response(200,"Response","Found Endpoint",$this->{$this->endpoint}($this->args));
        }
        return $this->_response(404,"No Endpoint",$this->endpoint, "Invalid Endpoint");
    }

    function _response($status, $message, $explain, $data = null)
    {
        if(isset($data['status'])) {
            header("HTTP/1.1 " . $data['status'] . " " . $this->_requestStatus($status));
        }else{
            header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        }
        return json_encode($data, 128);
    }


    private function _cleanInputs($data)
    {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    private function _requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }

    function getPackage($link)
    {
        $db = getDB();
        $query = "SELECT * FROM Product WHERE product_os = :pos";
        $rec = $db->prepare($query);
        $rec->bindParam(":pos", $link);
        $rec->execute();
        $res = $rec->fetchAll(PDO::FETCH_ASSOC);
        $arr = array_values($res);
        return $arr[0]["product_link"];
    }

    public static function httpRequest($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        return $result;
    }

}

?>