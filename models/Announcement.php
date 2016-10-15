<?php

/**
 * Created by PhpStorm.
 * User: cj
 * Date: 9/29/16
 * Time: 4:40 PM
 */
class Announcement {
    public $anmt_id;
    public $anmt_title;
    public $anmt_content;
    public $anmt_author_id;
    public $anmt_creation;
    public $anmt_header_img;
    public $anmt_gallery_id;

    public static function _GET(PDO $pdo, $id){
        $query = "SELECT * FROM Announcement WHERE Announcement.anmt_id = :anmt_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":anmt_id", $id);
        if($stmt->execute()){
            /**
             * @var Announcement $anmt
             */
            $anmt = $stmt->fetchObject(Announcement::class);
            return $anmt;
        }
        return NULL;
    }

    /**
     * @param PDO $pdo
     * @return Announcement[]|null
     */
    public static function _GETALL(PDO $pdo){
        $query = "SELECT * FROM Announcement WHERE 1 ORDER BY Announcement.anmt_id DESC ";
        $stmt = $pdo->prepare($query);
        if($stmt->execute()){
            /**
             * @var Announcement[] $anmt
             */
            $anmt = $stmt->fetchAll(PDO::FETCH_CLASS, 'Announcement');
            return $anmt;
        }
        return NULL;
    }

    /**
     * @return mixed
     */
    public function getAnmtId()
    {
        return $this->anmt_id;
    }

    /**
     * @param mixed $anmt_id
     */
    public function setAnmtId($anmt_id)
    {
        $this->anmt_id = $anmt_id;
    }

    /**
     * @return mixed
     */
    public function getAnmtTitle()
    {
        return $this->anmt_title;
    }

    /**
     * @param mixed $anmt_title
     */
    public function setAnmtTitle($anmt_title)
    {
        $this->anmt_title = $anmt_title;
    }

    /**
     * @return mixed
     */
    public function getAnmtContent()
    {
        return $this->anmt_content;
    }

    /**
     * @param mixed $anmt_content
     */
    public function setAnmtContent($anmt_content)
    {
        $this->anmt_content = $anmt_content;
    }

    /**
     * @return mixed
     */
    public function getAnmtAuthorId()
    {
        return $this->anmt_author_id;
    }

    /**
     * @param mixed $anmt_author_id
     */
    public function setAnmtAuthorId($anmt_author_id)
    {
        $this->anmt_author_id = $anmt_author_id;
    }

    /**
     * @return mixed
     */
    public function getAnmtCreation()
    {
        return $this->anmt_creation;
    }

    /**
     * @param mixed $anmt_creation
     */
    public function setAnmtCreation($anmt_creation)
    {
        $this->anmt_creation = $anmt_creation;
    }

    /**
     * @return mixed
     */
    public function getAnmtHeaderImg()
    {
        return $this->anmt_header_img;
    }

    /**
     * @param mixed $anmt_header_img
     */
    public function setAnmtHeaderImg($anmt_header_img)
    {
        $this->anmt_header_img = $anmt_header_img;
    }

    /**
     * @return mixed
     */
    public function getAnmtGalleryId()
    {
        return $this->anmt_gallery_id;
    }

    /**
     * @param mixed $anmt_gallery_id
     */
    public function setAnmtGalleryId($anmt_gallery_id)
    {
        $this->anmt_gallery_id = $anmt_gallery_id;
    }


}

?>