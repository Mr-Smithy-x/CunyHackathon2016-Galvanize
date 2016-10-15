<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 9/29/16
 * Time: 11:00 PM
 */
class ScheduleDate
{
    public $schd_id;
    public $schd_start_date;
    public $schd_end_date;
    public $schd_title;
    public $schd_description;
    public $schd_article_id;
    public $schd_link;
    public $schd_image;

    /**
     * @param PDO $pdo
     * @param $id
     * @return ScheduleDate[]|null
     */
    public static function _GET_ANCMT_DATES(PDO $pdo, $id){
        $query = "SELECT * FROM ScheduleDates WHERE schd_article_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScheduleDate');
        }else return null;
    }

    /**
     * @param PDO $pdo
     * @param $id
     * @return ScheduleDate[]|null
     */
    public static function _GETALL_DATES(PDO $pdo){
        $query = "SELECT * FROM ScheduleDates WHERE 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScheduleDate');
        }else return null;
    }

    /**<
     * @param PDO $pdo
     * @param $id
     * @return ScheduleDate[]|null
     */
    public static function _GETALL_DATES_FROM(PDO $pdo, $from, $to){
        $query = "SELECT * FROM ScheduleDates WHERE (schd_start_date BETWEEN :from_date AND :to_date) OR (schd_end_date BETWEEN :from_date AND :to_date)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":from_date", $from);
        $stmt->bindParam(":to_date", $to);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScheduleDate');
        }else return null;
    }

    /**<
     * @param PDO $pdo
     * @param $id
     * @return ScheduleDate[]|null
     */
    public static function _GETALL_DATES_FROM_BETWEEN(PDO $pdo, $from, $to){
        $query = "SELECT * FROM ScheduleDates WHERE (schd_start_date <= :from_date AND schd_end_date >= :to_date) OR (schd_start_date >= :from_date AND schd_end_date <= :to_date)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":from_date", $from);
        $stmt->bindParam(":to_date", $to);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScheduleDate');
        }else return null;
    }

    /**<
     * @param PDO $pdo
     * @param $id
     * @return ScheduleDate[]|null
     */
    public static function _GETALL_DATES_FROM_OUT(PDO $pdo, $from, $to){
        $query = "SELECT * FROM ScheduleDates WHERE  (schd_start_date BETWEEN :from_date AND :to_date) OR (schd_end_date BETWEEN :from_date AND :to_date)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":from_date", $from);
        $stmt->bindParam(":to_date", $to);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'ScheduleDate');
        }else return null;
    }


    /**
     * @return mixed
     */
    public function getSchdStartDate()
    {
        return $this->schd_start_date;
    }

    /**
     * @return mixed
     */
    public function getSchdEndDate()
    {
        return $this->schd_end_date;
    }


    /**
     * @param PDO $pdo
     * @param $id
     * @return null|ScheduleDate
     */
    public static function _GET(PDO $pdo, $id){
        $query = "SELECT * FROM ScheduleDates WHERE ScheduleDates.schd_id = :schd_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":schd_id", $id);
        if($stmt->execute()){
            /**
             * @var ScheduleDate $schd
             */
            $schd = $stmt->fetchObject(ScheduleDate::class);
            return $schd;
        }
        return NULL;
    }

    /**
     * @return mixed
     */
    public function getSchdId()
    {
        return $this->schd_id;
    }


    /**
     * @return mixed
     */
    public function getSchdTitle()
    {
        return $this->schd_title;
    }

    /**
     * @return mixed
     */
    public function getSchdDescription()
    {
        return $this->schd_description;
    }

    /**
     * @return mixed
     */
    public function getSchdArticleId()
    {
        return $this->schd_article_id;
    }

    /**
     * @return mixed
     */
    public function getSchdLink()
    {
        return $this->schd_link;
    }

    /**
     * @return mixed
     */
    public function getSchdImage()
    {
        return $this->schd_image;
    }



}