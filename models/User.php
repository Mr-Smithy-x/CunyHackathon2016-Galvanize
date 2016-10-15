<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 9/29/16
 * Time: 4:40 PM
 */
class User
{
    /**
     * @var int
     */
    public $user_id;
    public $user_firstname;
    public $user_lastname;
    public $user_email;
    protected $user_password;
    public $user_phone;
    public $user_act_key;
    public $user_creation;
    public $user_permission;
    public $user_profile_photo;
    public $user_splash_photo;

    /**
     * @var int
     */
    public $user_major_id;
    public $user_school_code;
    public $user_club_id;

    /**
     * @param PDO $pdo
     * @param User $user
     * @return bool|null
     */
    public static function _UPDATE(PDO $pdo, User $user)
    {
        $query = "UPDATE BCC.Users SET  user_email = :user_email, 
                                        user_firstname = :user_firstname,
                                        user_lastname = :user_lastname,
                                        user_email = :user_email,
                                        user_password = :user_password,
                                        user_phone = :user_phone,
                                        user_profile_photo = :user_profile_photo,
                                        user_splash_photo = :user_splash_photo,
                                        user_major_id = :user_major_id WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        foreach ($user as $key => $value) {
            if ($key == 'user_act_key') continue;
            else if ($key == 'user_creation') continue;
            else if ($key == 'user_permission') continue;
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            //unset($user->user_password);
            return $stmt->rowCount() > 0 ? true : false;
        }
        return false;
    }

    /**
     * @param PDO $pdo
     * @param $id
     * @return User|null
     */
    public static function _GET(PDO $pdo, $id)
    {
        $query = "SELECT * FROM Users WHERE Users.user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":user_id", $id);
        if ($stmt->execute()) {
            /**
             * @var User $user
             */
            $user = $stmt->fetchObject(User::class);
            $user->user_major_id = Major::_GET($pdo, $user->user_major_id);
            $user->user_school_code = School::_GET($pdo, $user->user_school_code);

            if($user->user_club_id === false) unset($user->user_club_id);
            if($user->user_major_id === false) unset($user->user_major_id);
            if($user->user_school_code === false) unset($user->user_school_code);
            return $user;
        }
        return NULL;
    }

    /**
     * @param PDO $pdo
     * @param $id
     * @return null|Club
     */
    public static function _IS_PRESIDENT(PDO $pdo, $id)
    {
        $query = "SELECT c.* FROM Clubs c, Users u WHERE c.club_president_id = u.user_id AND c.club_president_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $id);
        if ($stmt->execute()) {
            /**
             * @var Club $club
             */

            $club = $stmt->fetchObject(Club::class);
            return Club::_GET_BY_ID($pdo, $club->club_id);
        }
        return NULL;
    }

    /**
     * @param PDO $pdo
     * @param $id
     * @return null|User
     */
    public static function _GET_BY_KEY(PDO $pdo, $key)
    {
        $query = "SELECT * FROM Users WHERE Users.user_act_key = :key";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":key", $key);
        if ($stmt->execute()) {
            /**
             * @var User $user
             */
            $user = $stmt->fetchObject(User::class);
            //unset($user->user_password);
            $user->user_major_id = Major::_GET($pdo, $user->user_major_id);
            $user->user_school_code = School::_GET($pdo, $user->user_school_code);

            if($user->user_club_id === false) unset($user->user_club_id);
            if($user->user_major_id === false) unset($user->user_major_id);
            if($user->user_school_code === false) unset($user->user_school_code);

            return $user;
        }
        return null;
    }

    /**
     * @param PDO $pdo
     * @param $email
     * @param $pass
     * @return null|User
     */
    public static function _LOGIN(PDO $pdo, $email, $pass)
    {
        $query = "SELECT * FROM Users WHERE Users.user_email = :email AND Users.user_password = :pass";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass", $pass);
        if ($stmt->execute()) {
            /**
             * @var User $user
             */
            $user = $stmt->fetchObject(User::class);
            $user->user_major_id = Major::_GET($pdo, $user->user_major_id);
            $user->user_school_code = School::_GET($pdo, $user->user_school_code);

            if($user->user_club_id === false) unset($user->user_club_id);
            if($user->user_major_id === false) unset($user->user_major_id);
            if($user->user_school_code === false) unset($user->user_school_code);
            return $user;
        }
        return NULL;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserFirstname()
    {
        return $this->user_firstname;
    }

    /**
     * @param mixed $user_firstname
     */
    public function setUserFirstname($user_firstname)
    {
        $this->user_firstname = $user_firstname;
    }

    /**
     * @return mixed
     */
    public function getUserLastname()
    {
        return $this->user_lastname;
    }

    /**
     * @param mixed $user_lastname
     */
    public function setUserLastname($user_lastname)
    {
        $this->user_lastname = $user_lastname;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     * @param mixed $user_password
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }

    /**
     * @return mixed
     */
    public function getUserPhone()
    {
        return $this->user_phone;
    }

    /**
     * @param mixed $user_phone
     */
    public function setUserPhone($user_phone)
    {
        $this->user_phone = $user_phone;
    }

    /**
     * @return mixed
     */
    public function getUserActKey()
    {
        return $this->user_act_key;
    }

    /**
     * @param mixed $user_act_key
     */
    public function setUserActKey($user_act_key)
    {
        $this->user_act_key = $user_act_key;
    }

    /**
     * @return mixed
     */
    public function getUserCreation()
    {
        return $this->user_creation;
    }

    /**
     * @param mixed $user_creation
     */
    public function setUserCreation($user_creation)
    {
        $this->user_creation = $user_creation;
    }

    /**
     * @return mixed
     */
    public function getUserPermission()
    {
        return $this->user_permission;
    }

    /**
     * @param mixed $user_permission
     */
    public function setUserPermission($user_permission)
    {
        $this->user_permission = $user_permission;
    }

    /**
     * @return mixed
     */
    public function getUserMajorId()
    {
        return $this->user_major_id;
    }

    /**
     * @param mixed $user_major_id
     */
    public function setUserMajorId($user_major_id)
    {
        $this->user_major_id = $user_major_id;
    }


}