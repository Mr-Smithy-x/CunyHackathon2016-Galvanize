<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 10/14/16
 * Time: 9:57 PM
 */
class School
{
    public $school_id;
    public $school_code;
    public $school_name;
    public $school_lat;
    public $school_lng;
    public $school_address;

    /**
     * @param PDO $pdo
     * @param $id
     * @return School|null
     */
    public static function _GET(PDO $pdo, $school_code){
        $query = "SELECT * FROM School WHERE School.school_code = :school_code";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":school_code", $school_code);
        if($stmt->execute()){
            /**
             * @var School $school
             */
            $school = $stmt->fetchObject(School::class);
            return $school;
        }
        return NULL;
    }


    /**
     * @return mixed
     */
    public function getSchoolId()
    {
        return $this->school_id;
    }

    /**
     * @return mixed
     */
    public function getSchoolCode()
    {
        return $this->school_code;
    }

    /**
     * @return mixed
     */
    public function getSchoolName()
    {
        return $this->school_name;
    }

    /**
     * @return mixed
     */
    public function getSchoolLat()
    {
        return $this->school_lat;
    }

    /**
     * @return mixed
     */
    public function getSchoolLng()
    {
        return $this->school_lng;
    }

    /**
     * @return mixed
     */
    public function getSchoolAddress()
    {
        return $this->school_address;
    }



}