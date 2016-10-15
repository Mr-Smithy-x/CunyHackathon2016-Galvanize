<?php
//Require all libraries that will be used for the API.

require 'config.php';
require_once 'api.php';
require_once 'models/User.php';
require_once 'models/Announcement.php';
require_once 'models/ScheduleDate.php';
require_once 'models/Major.php';
require_once 'models/Club.php';


// Start session management

class MyAPI extends API
{

    //API Variables for whatever we are getting.

    //Create the main object for the API.
    public function __construct($request, $origin)
    {
        parent::__construct($request);
        /*
        if($request == 'user_register');
        else if($request == 'user_login');
        else if($request == 'announcements');
        else if($request == 'dates_from');
        else if (!array_key_exists('apikey', getallheaders())) {
            throw new Exception('No API Key provided');
        } else if (getallheaders()['apikey'] != INTERNAL_API_KEY) {
            throw new Exception('Invalid API Key');
        }*/
        header('Content-Type: application/json');
        date_default_timezone_set('America/New_York');
    }

    /**
     * All Endpoints go here.
     */

    /**
     *
     * "GET" Endpoints.
     */
    protected function example()
    {
        if ($this->method == 'GET') {
            return $this->response(200, "Connection made", "Welcome to", $_SERVER['HTTP_HOST']);
        } else {
            return $this->method_mismatch_get();
        }
    }

    /*
     * User endpoint
     * Description: Gets a specific user and all their details.
     */

    function get_major($id = null)
    {
        if ($this->method == 'GET' || $id != null) {
            $major_id = $id != null ? $id : $this->api_param("id", true);
            $major = Major::_GET($this->getPdoInstance(), $major_id);
            if ($id != null) {
                return $major;
            } else {
                return $this->response($major != null ? 200 : 500, $major != null ? "Major Found" : "No Major Found", "Major", $major);
            }
        } else {
            return $this->method_mismatch_get();
        }
    }

    function get_user($id = null)
    {
        if ($this->method == 'GET' || $id != null) {
            $user_id = $id != null ? $id : $this->api_param("id", true);
            $user = User::_GET($this->getPdoInstance(), $user_id);
            if ($user != null) {
                $_user['user'] = $user;
                $_user['major'] = $this->get_major($user->user_major_id);
                return $this->response(200, "User Found", "User information", $_user);
            }else return $this->response(500, "User Not Found", "No user information", null);
        } else {
            return $this->method_mismatch_get();
        }
    }

    function update_profile(){
        if ($this->method == 'POST') {
            $key = $this->api_param('key', true);
            $user = User::_GET_BY_KEY($this->getPdoInstance(),$key);
            $response = false;
            if($user != null) {
                $user->user_firstname = $this->api_param('firstname', false, $user->user_firstname);
                $user->user_lastname = $this->api_param('lastname', false, $user->user_lastname);
                $user->user_email = $this->api_param('email', false, $user->user_email);
                $user->user_profile_photo = $this->api_param('profile', false, $user->user_profile_photo);
                $user->user_splash_photo = $this->api_param('splash', false, $user->user_splash_photo);
                $user->user_major_id = $this->api_param('major_id', false, $user->user_major_id);
                $user->user_phone = $this->api_param('phone', false, $user->user_phone);
                $user->setUserPassword($this->api_param($this->getHash('password'), false, $user->getUserPassword()));
                $response = User::_UPDATE($this->getPdoInstance(), $user);
            }
            return $this->response($response == true ? 200 : 500, $response == true ? "Updated" : "Failed",  $response == true ? "You're profile was updated successfully" : "You're profile was not updated", $response == true ? $user : null);
        }else{
            return $this->method_mismatch_post();
        }
    }

    function get_clubs()
    {
        if ($this->method == 'GET') {
            $name = $this->api_param("name",true);
            $club = Club::_GET(self::getPdoInstance(),$name);
            return $this->response($club != NULL ? 200 : 500, "Clubs","Clubs", $club);
        }else{
            return $this->method_mismatch_get();
        }
    }
    function user_register()
    {
        if ($this->method == 'GET') {
            $email = $this->api_param('email', true);
            $password = $this->api_param('pass', true);
            $first = $this->api_param('first_name', true);
            $last = $this->api_param('last_name', true);
            $number = $this->api_param('phone', false);
            $result = null;
            try {
                $query = "INSERT INTO Users (user_email, user_password, user_firstname, user_lastname, user_phone, user_act_key) VALUES (:user_email,:user_password, :user_firstname, :user_lastname, :user_phone, :user_act_key)";
                $stmt = self::getPdoInstance()->prepare($query);
                $stmt->bindParam(":user_email", $email);
                $stmt->bindParam(":user_password", self::getHash($password));
                $stmt->bindParam(":user_firstname", $first);
                $stmt->bindParam(":user_lastname", $last);
                $stmt->bindParam(":user_phone", $number);
                $stmt->bindValue(":user_act_key", md5($email . $password));
                if ($stmt->execute()) {
                    $id = self::getPdoInstance()->lastInsertId();
                    if (intval($id) > 0) {
                        $user = User::_GET($this->getPdoInstance(), intval($id));

                        return $this->response(200, "Success", 'Thank you for registering', $user);
                    }
                }
                return $this->response(500, "Error", 'Unable to create user');
            } catch (Exception $exception) {
                return $this->response(500, "Error", 'Unable to create user', $exception);
            }
        } else {
            return $this->method_mismatch_get();
        }
    }

    function getHash($pass)
    {
        return openssl_encrypt($pass, 'AES-256-ECB', HASH);
    }


    function user_login()
    {
        if ($this->method == 'GET') {
            $email = $this->api_param('email');
            $pass = $this->api_param('pass');
            $user = User::_LOGIN($this->getPdoInstance(), $email, self::getHash($pass));
            if ($user != null) {
                return $this->response(200, "Success", "Welcome $user->user_firstname", $user);
            }
            return $this->response(500, "Error", "Invalid Username or Password");
        } else {
            return $this->method_mismatch_get();
        }
    }


    function whats_happening_now()
    {
        if ($this->method == 'GET') {
            $from = $this->api_param('from', false, date('Y-m-d H:i:s', strtotime('now', time())));
            $to = $this->api_param('to', false, date('Y-m-d H:i:s', strtotime('now', time())));
            return $this->response(200, "DATES", "DATES Announcements", ScheduleDate::_GETALL_DATES_FROM_BETWEEN($this->getPdoInstance(), $from, $to));
        } else {
            return $this->method_mismatch_get();
        }
    }

    function whats_happening_today()
    {
        if ($this->method == 'GET') {
            $from = $this->api_param('from', false, date('Y-m-d H:i:s', strtotime('today', time())));
            $to = $this->api_param('to', false, date('Y-m-d H:i:s', strtotime('tomorrow', time()) - 1));
            return $this->response(200, "DATES", "DATES Announcements", ScheduleDate::_GETALL_DATES_FROM_BETWEEN($this->getPdoInstance(), $from, $to));
        } else {
            return $this->method_mismatch_get();
        }
    }

    function whats_happening_tomorrow()
    {
        if ($this->method == 'GET') {
            $from = $this->api_param('from', false, date('Y-m-d H:i:s', strtotime('tomorrow', time())));
            $to = $this->api_param('to', false, date('Y-m-d H:i:s', strtotime('tomorrow +1 day', time()) - 1));
            return $this->response(200, "DATES", "DATES Announcements", ScheduleDate::_GETALL_DATES_FROM_BETWEEN($this->getPdoInstance(), $from, $to));
        } else {
            return $this->method_mismatch_get();
        }
    }

    function whats_happening_next_week()
    {
        if ($this->method == 'GET') {
            $from = $this->api_param('from', false, date('Y-m-d H:i:s', strtotime('this week', time())));
            $to = $this->api_param('to', false, date('Y-m-d H:i:s', strtotime('next week', time()) - 1));
            return $this->response(200, "DATES", "DATES Announcements", ScheduleDate::_GETALL_DATES_FROM_OUT($this->getPdoInstance(), $from, $to));
        } else {
            return $this->method_mismatch_get();
        }
    }


    function dates_from()
    {
        if ($this->method == 'GET') {
            $from = $this->api_param('from', false, date('Y-m-d H:i:s', strtotime('first day of this month', time())));
            $to = $this->api_param('to', false, date('Y-m-d H:i:s', strtotime('last day of this month', time())));
            return $this->response(200, "DATES", "DATES Announcements", ScheduleDate::_GETALL_DATES_FROM($this->getPdoInstance(), $from, $to));
        } else {
            return $this->method_mismatch_get();
        }
    }

    function announcements()
    {
        if ($this->method == 'GET') {
            return $this->response(200, "Announcements", "Latest Announcements", Announcement::_GETALL($this->getPdoInstance()));
        } else {
            return $this->method_mismatch_get();
        }
    }

    //region Application Database

    public function response($status = 200, $message, $explain, $data = null)
    {
        return array("status" => $status, "message" => $message, "explain" => $explain, "data" => $data);
    }

//endregion

    /**
     * Helper functions.
     */
    protected
    function method_mismatch_get()
    {
        return $this->response(500, "Undefined", "error", "Only accepts GET requests");
    }

    protected
    function method_mismatch_post()
    {
        return $this->response(500, "Undefined", "error", "Only accepts POST requests");
    }

    protected
    function method_mismatch_put()
    {
        return $this->response(500, "Undefined", "error", "Only accepts PUT requests");
    }

    protected
    function method_mismatch_delete()
    {
        return $this->response(500, "Undefined", "error", "Only accepts DELETE requests");
    }

    protected
    function api_param($name, $required = true, $default = null)
    {
        if ($name == null || $name == '') throw new Exception("Paramater name required.");

        $param_val = $this->request;

        if (isset($param_val[$name])) {
            if (is_string($param_val[$name])) {
                return $param_val[$name];
            }
            return $param_val[$name];
        }
        if ($required)
            throw new Exception('Parameter ' . ucfirst($name) . ' is required');

        return $default;
    }
}

?>