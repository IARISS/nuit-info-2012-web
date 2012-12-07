<?php
namespace lib\culture;
use lib\db\DataBase;
use PDO;
use lib\tag\Tag;
/**
 * @author Karl
 */
class Culture {
  private $id = 0;
  private $name;
  private $description;
  private $img;
  private $gpsX;
  private $gpsY;
  private $gpsZ;
  private $tags = array();

  public function __construct(){
  }

  private function hydrate(array $datas){
    foreach($datas as $key => $value){
      if($key == "tags"){
        $this->tags = explode(",", $value);
      }
      else{
        $this->$key = $value;
      }
    }
  }

  public function getId(){
    return $this->id;
  }
  private function setId($id){
    $this->id = (int) $id;
  }
  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
  }
  public function getDescription(){
    return $this->description;
  }
  public function setDescription($description){
    $this->description = $description;
  }
  public function getImg(){
    return $this->img;
  }
  public function setImg($img){
    $this->img = $img;
  }
  public function getGpsX(){
    return $this->gpsX;
  }
  public function setGpsX($gpsX){
    $this->gpsX = $gpsX;
  }
  public function getGpsY(){
    return $this->gpsY;
  }
  public function setGpsY($gpsY){
    $this->gpsY = $gpsY;
  }
  public function getGpsZ(){
    return $this->gpsZ;
  }
  public function setGpsZ($gpsZ){
    $this->gpsZ = $gpsZ;
  }
  public function getTags(){
    return Tag::getTagsIdIn($this->tags);
  }
  public function getTagsId(){
    return $this->tags;
  }
  public function getTagsString(){
    return implode(',', $this->tags);
  }

  public function __toString(){
    return $this->getName();
  }

  public function toJson(){
    return array('id' => $this->getId(),'name' => $this->getName(),'description' => $this->getDescription(),'img' => $this->getImg(),'gpsX' => $this->getGpsX(),'gpsY' => $this->getGpsY(),'gpsZ' => $this->getGpsZ(),'tags' => $this->getTagsId());
  }

  public function parseTags(){
    $this->tags = array();
    $tags = Tag::getTagsExtractedFromString($this->name.' '.$this->description);
    $idArray = array();
    foreach($tags as $tag){
      $idArray[] = $tag->getId();
    }
    $this->tags = $idArray;
  }

  static public function countCultures(){
    $req = DataBase::getInstance()->prepare('SELECT COUNT(id) FROM cultures');
    $req->execute();
    $count = $req->fetchColumn();
    $req->closeCursor();
    return $count;
  }
  static public function saveCulture(Culture $obj){
    $req = DataBase::getInstance()->prepare('SELECT COUNT(id) FROM cultures WHERE id = :id');
    $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    $req->closeCursor();
    if($count == 0){
      $req = DataBase::getInstance()->prepare('INSERT INTO cultures(name, description, tags, img, gpsX, gpsY, gpsZ) VALUES (:name, :description, :tags, :img, :gpsX, :gpsY, :gpsZ)');
    }
    else{
      $req = DataBase::getInstance()->prepare('UPDATE cultures SET name = :name, description = :description, tags = :tags, img = :img, gpsX = :gpsX, gpsY = :gpsY, gpsZ = :gpsZ WHERE id = :id');
      $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    }
    $req->bindValue('name', $obj->name, PDO::PARAM_STR);
    $req->bindValue('description', $obj->description, PDO::PARAM_STR);
    $obj->parseTags();
    $req->bindValue('tags', $obj->getTagsString(), PDO::PARAM_STR);
    $req->bindValue('img', $obj->img, PDO::PARAM_STR);
    $req->bindValue('gpsX', $obj->gpsX, PDO::PARAM_STR);
    $req->bindValue('gpsY', $obj->gpsY, PDO::PARAM_STR);
    $req->bindValue('gpsZ', $obj->gpsZ, PDO::PARAM_STR);
    $req->execute();
    if($count == 0){
      $obj->setId(DataBase::getInstance()->lastInsertId());
    $req->closeCursor();
    }
  }
  static public function getCulture($id){
    $req = DataBase::getInstance()->prepare('SELECT id, name, description, tags, img, gpsX, gpsY, gpsZ FROM cultures WHERE id = :id');
    $req->bindvalue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $datas = $req->fetch();
    $req->closeCursor();
    if(empty($datas)) return null;
    $obj = new Culture();
    $obj->hydrate($datas);
    return $obj;
  }
  static public function getCultures(){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, description, tags, img, gpsX, gpsY, gpsZ FROM cultures');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Culture();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getCultugesWithTags(array $tags){
    $idArray = array();
    foreach($tags as $tag){
      $idArray[] = $tag->getId();
    }
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, description, tags, img, gpsX, gpsY, gpsZ FROM cultures WHERE tags REGEXP "(^|,)('.implode('|',$idArray).')(,|$)" AND tags != ""');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Culture();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getCulturesLike($search){
    $pattern = '/[[:space:][:punct:]]/';
    $strWords = preg_split($pattern, strtolower($search));
    $words = array_unique($strWords);
    $objs = array();
    
    $req = DataBase::getInstance()->prepare('SELECT id, name, description, tags, img, gpsX, gpsY, gpsZ FROM cultures WHERE CONCAT(description, " ", name) REGEXP "('.implode('|',$words).')"');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Culture();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function findCultures($search){
    $tags = Tag::getTagsExtractedFromString($search);
    $taggedCultures = Culture::getCultugesWithTags($tags);
    
    if(!empty($taggedCultures))
      return $taggedCultures;
    return Culture::getCulturesLike($search);
  }
  static public function deleteCulture($id){
    $req = DataBase::getInstance()->prepare('DELETE FROM cultures WHERE id = :id');
    $req->bindvalue('id', $id, PDO::PARAM_INT);
    $req->execute();
  }

  static public function install(){
    DataBase::getInstance()->query('
      CREATE TABLE IF NOT EXISTS cultures (
        id int NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        description text,
        tags text,
        img varchar(255),
        gpsX varchar(255),
        gpsY varchar(255),
        gpsZ varchar(255),
        PRIMARY KEY (id)
      ) ENGINE=InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;
    ');
  }
}