<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 10/14/16
 * Time: 8:56 PM
 */
class Club
{
    public $club_id;
    public $club_title;
    public $club_description;
    public $club_president_id;
    public $club_school_code;
    public $club_officer_1;
    public $club_officer_2;
    public $club_officer_3;
    public $club_general_email;
    public $club_start;
    public $club_end;


    public static function _JOIN(PDO $pdo, $uid, $cid){
        $query = "UPDATE Users SET user_club_id = :club_id WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":club_id", $cid);
        $stmt->bindParam(":user_id", $uid);
        if($stmt->execute()){
            if($stmt->rowCount() > 0) return true;
            else {
                return false;
            }
        }else{
            return false;
        }
    }

    public static function _GET_ALL_CLUBS($pdo)
    {
        $query = "SELECT * FROM Clubs WHERE 1";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute()) {
            /**
             * @var Club[] $club
             */
            $club = $stmt->fetchAll(PDO::FETCH_CLASS, 'Club');
            foreach ($club as $club_object) {
                if ($club_object->club_president_id != 0) {
                    $club_object->club_president_id = User::_GET($pdo, $club_object->club_president_id);
                    if($club_object->club_president_id == false) $club_object->club_president_id = null;
                }
                if ($club_object->club_officer_1 != 0) {
                    $club_object->club_officer_1 = User::_GET($pdo, $club_object->club_officer_1);
                    if($club_object->club_officer_1 == false) $club_object->club_officer_1 = null;
                }
                if ($club_object->club_officer_2 != 0) {
                    $club_object->club_officer_2 = User::_GET($pdo, $club_object->club_officer_2);
                    if($club_object->club_officer_2 == false) $club_object->club_officer_2 = null;
                }
                if ($club_object->club_officer_3 != 0) {
                    $club_object->club_officer_3 = User::_GET($pdo, $club_object->club_officer_3);
                    if($club_object->club_officer_3 == false) $club_object->club_officer_3 = null;
                }
                if($club_object->club_school_code != 0){
                    $club_object->club_school_code = School::_GET($pdo,$club_object->club_school_code);
                    if($club_object->club_school_code == false) $club_object->club_school_code = null;
                }           }
            return $club;
        }
        return NULL;
    }

    /**
     * @param PDO $pdo
     * @param $id
     * @return Club[]|null
     */
    public static function _GET(PDO $pdo, $club_title)
    {
        $query = "SELECT * FROM Clubs WHERE club_title LIKE ?";
        $array = array("%$club_title%");
        $stmt = $pdo->prepare($query);
        if ($stmt->execute($array)) {
            /**
             * @var Club[] $club
             */
            $club = $stmt->fetchAll(PDO::FETCH_CLASS, 'Club');
            foreach ($club as $club_object) {
                if ($club_object->club_president_id != 0) {
                    $club_object->club_president_id = User::_GET($pdo, $club_object->club_president_id);
                    if($club_object->club_president_id == false) $club_object->club_president_id = null;
                }
                if ($club_object->club_officer_1 != 0) {
                    $club_object->club_officer_1 = User::_GET($pdo, $club_object->club_officer_1);
                    if($club_object->club_officer_1 == false) $club_object->club_officer_1 = null;
                }
                if ($club_object->club_officer_2 != 0) {
                    $club_object->club_officer_2 = User::_GET($pdo, $club_object->club_officer_2);
                    if($club_object->club_officer_2 == false) $club_object->club_officer_2 = null;
                }
                if ($club_object->club_officer_3 != 0) {
                    $club_object->club_officer_3 = User::_GET($pdo, $club_object->club_officer_3);
                    if($club_object->club_officer_3 == false) $club_object->club_officer_3 = null;
                }
                if($club_object->club_school_code != 0){
                    $club_object->club_school_code = School::_GET($pdo,$club_object->club_school_code);
                    if($club_object->club_school_code == false) $club_object->club_school_code = null;
                }           }
            return $club;
        }
        return NULL;
    }




    /**
     * @param PDO $pdo
     * @param $id
     * @return Club[]|null
     */
    public static function _GET_BY_SCHOOL(PDO $pdo, $school_code, $name = null)
    {
        $query = "SELECT * FROM Clubs WHERE  Clubs.club_school_code = :club_school_code";
        if($name != null) $query .= " AND Clubs.club_title LIKE :club_title";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":club_school_code", $school_code);
        if($name != null)
            $stmt->bindValue(":club_title", "%$name%");

        if ($stmt->execute()) {
            /**
             * @var Club $club_object
             */
            /**
             * @var Club[] $club
             */
            $club = $stmt->fetchAll(PDO::FETCH_CLASS, 'Club');
            foreach ($club as $club_object) {
                if ($club_object->club_president_id != 0) {
                    $club_object->club_president_id = User::_GET($pdo, $club_object->club_president_id);
                    if($club_object->club_president_id == false) $club_object->club_president_id = null;
                }
                if ($club_object->club_officer_1 != 0) {
                    $club_object->club_officer_1 = User::_GET($pdo, $club_object->club_officer_1);
                    if($club_object->club_officer_1 == false) $club_object->club_officer_1 = null;
                }
                if ($club_object->club_officer_2 != 0) {
                    $club_object->club_officer_2 = User::_GET($pdo, $club_object->club_officer_2);
                    if($club_object->club_officer_2 == false) $club_object->club_officer_2 = null;
                }
                if ($club_object->club_officer_3 != 0) {
                    $club_object->club_officer_3 = User::_GET($pdo, $club_object->club_officer_3);
                    if($club_object->club_officer_3 == false) $club_object->club_officer_3 = null;
                }
                if($club_object->club_school_code != 0){
                    $club_object->club_school_code = School::_GET($pdo,$club_object->club_school_code);
                    if($club_object->club_school_code == false) $club_object->club_school_code = null;
                }
            }
            return $club;
        }
        return NULL;
    }


    /**
     * @param PDO $pdo
     * @param $id
     * @return Club|null
     */
    public static function _GET_BY_ID(PDO $pdo, $id)
    {
        $query = "SELECT * FROM Clubs WHERE Clubs.club_id = :club_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":club_id", $id);
        if ($stmt->execute()) {
            /**
             * @var Club $club_object
             */
            $club_object = $stmt->fetchObject(Club::class);
            if ($club_object->club_president_id != 0) {
                $club_object->club_president_id = User::_GET($pdo, $club_object->club_president_id);
                if($club_object->club_president_id == false) $club_object->club_president_id = null;
            }
            if ($club_object->club_officer_1 != 0) {
                $club_object->club_officer_1 = User::_GET($pdo, $club_object->club_officer_1);
                if($club_object->club_officer_1 == false) $club_object->club_officer_1 = null;
            }
            if ($club_object->club_officer_2 != 0) {
                $club_object->club_officer_2 = User::_GET($pdo, $club_object->club_officer_2);
                if($club_object->club_officer_2 == false) $club_object->club_officer_2 = null;
            }
            if ($club_object->club_officer_3 != 0) {
                $club_object->club_officer_3 = User::_GET($pdo, $club_object->club_officer_3);
                if($club_object->club_officer_3 == false) $club_object->club_officer_3 = null;
            }
            if($club_object->club_school_code != 0){
                $club_object->club_school_code = School::_GET($pdo,$club_object->club_school_code);
                if($club_object->club_school_code == false) $club_object->club_school_code = null;
            }
            return $club_object;
        }
        return NULL;
    }


}