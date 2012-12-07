<?php
namespace lib\tag;
use lib\db\DataBase;
use PDO;
/**
 * @author Karl
 */
class Tag {
  public static $TYPE = array("OTHER" => "other", "POS" => "pos", "THEME" => "theme", "DATE" => "date");

  private $id = 0;
  private $name;
  private $tagType;

  public function __construct(){
  }

  private function hydrate(array $datas){
    foreach($datas as $key => $value){
      $this->$key = $value;
    }
  }

  public function getId(){
    return $this->id;
  }
  private function setId($id){
    $this->id = (int) $id;
  }
  public function getName(){
    return ucfirst($this->name);
  }
  public function setName($name){
    $this->name = $name;
  }
  public function getTagType(){
    return $this->tagType;
  }
  public function setTagType($tagType){
    $this->tagType = $tagType;
  }

  public function __toString(){
    return $this->getName();
  }

  public function toJson(){
    return array('id' => $this->getId(),'name' => $this->getName(),'tagType' => $this->getTagType());
  }

  static public function countTags(){
    $req = DataBase::getInstance()->prepare('SELECT COUNT(id) FROM tags');
    $req->execute();
    $count = $req->fetchColumn();
    $req->closeCursor();
    return $count;
  }
  static public function saveTag(Tag $obj){
    $req = DataBase::getInstance()->prepare('SELECT COUNT(id) FROM tags WHERE id = :id');
    $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    $req->closeCursor();
    if($count == 0){
      $req = DataBase::getInstance()->prepare('INSERT INTO tags(name, tagType) VALUES (:name, :tagType)');
    }
    else{
      $req = DataBase::getInstance()->prepare('UPDATE tags SET name = :name, tagType = :tagType WHERE id = :id');
      $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    }
    $req->bindValue('name', $obj->name, PDO::PARAM_STR);
    $req->bindValue('tagType', $obj->tagType, PDO::PARAM_STR);
    $req->execute();
    if($count == 0){
      $obj->setId(DataBase::getInstance()->lastInsertId());
    }
    $req->closeCursor();
  }
  static public function getTag($id){
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE id = :id');
    $req->bindvalue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $datas = $req->fetch();
    $req->closeCursor();
    if(empty($datas)) return null;
    $obj = new Tag();
    $obj->hydrate($datas);
    return $obj;
  }
  static public function getTags(){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Tag();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function learnTags($str){
    $pattern = '/[[:space:][:punct:]]/';
    $strWords = preg_split($pattern, strtolower($str));
    $words = array_unique($strWords);
    $toLearn = array();
    foreach($words as $word){
      if(substr($word, 0, 1) == '#'){
        $toLearn[] = substr($word, 1);
      }
    }
    $know = Tag::getTagsNameIn($toLearn);
    $toLearn = array_diff($toLearn, $know);
    foreach($toLearn as $tag){
      $t = new OtherTag();
      $t->setName($tag);
      Tag::saveTag($t);
    }
  }
  static public function getTagsExtractedFromString($str){
    $pattern = '/[[:space:][:punct:]]/';
    $strWords = preg_split($pattern, strtolower($str));
    $words = array_unique($strWords);
    return Tag::getTagsNameIn($words);
  }
  static public function getTagsIdIn(array $tagsId){
    $in = implode(",", $tagsId);
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE id IN ('.(empty($in)?'0':$in).')');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Tag();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getTagsNameIn(array $tagsName){
    $func = function($str){return '"'.$str.'"';};
    $in = implode(",", array_map($func, $tagsName));
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE LOWER(name) IN ('.(empty($in)?'0':$in).')');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Tag();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getTagsWhereType($tagType){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE tagType = :tagType');
    $req->bindvalue('tagType', $tagType, PDO::PARAM_STR);
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Tag();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getRandomTags($limit){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags ORDER BY RAND() LIMIT '.(is_numeric($limit)?$limit:0));
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Tag();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }

  static public function install(){
    DataBase::getInstance()->query('
      CREATE TABLE IF NOT EXISTS tags (
        id int NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        tagType varchar(255) NOT NULL,
        PRIMARY KEY (id)
      ) ENGINE=InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;
    ');
  }
}
?>