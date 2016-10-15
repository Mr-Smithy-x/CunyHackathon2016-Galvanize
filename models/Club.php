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
                }
                if ($club_object->club_officer_1 != 0) {
                    $club_object->club_officer_1 = User::_GET($pdo, $club_object->club_officer_1);
                }
                if ($club_object->club_officer_2 != 0) {
                    $club_object->club_officer_2 = User::_GET($pdo, $club_object->club_officer_2);
                }
                if ($club_object->club_officer_3 != 0) {
                    $club_object->club_officer_3 = User::_GET($pdo, $club_object->club_officer_3);
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
             * @var Club $club
             */
            $club = $stmt->fetchObject(Club::class);
            return $club;
        }
        return NULL;
    }

}