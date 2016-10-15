<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 10/13/16
 * Time: 12:10 AM
 */
class Major
{

    /**
     * @var integer
     */
    public $major_id;
    /**
     * @var string
     */
    public $major_title;

    /**
     * @var string
     */
    public $major_category;

    /**
     * @var string
     */
    public $major_file_link;

    /**
     * @param PDO $pdo
     * @param $id
     * @return Major|null
     */
    public static function _GET(PDO $pdo, $id){
        $query = "SELECT * FROM Majors WHERE Majors.major_id = :major_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":major_id", $id);
        if($stmt->execute()){
            /**
             * @var Major $major
             */
            $major = $stmt->fetchObject(Major::class);
            return $major;
        }
        return NULL;
    }


}
