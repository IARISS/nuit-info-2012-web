<?php
namespace lib\tag;
use lib\db\DataBase;
use PDO;

abstract class Tag {
  private static $TYPE_OTHER = "other";
  private static $TYPE_POS = "pos";
  private static $TYPE_THEME = "theme";
  private static $TYPE_DATE = "date";

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
  public function getName(){
    return $this->name;
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
      $req = DataBase::getInstance()->prepare('UPDATE tags SET (name = :name, tagType = :tagType) WHERE id = :id');
      $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    }
    $req->bindValue('name', $obj->name, PDO::PARAM_STR);
    $req->bindValue('tagType', $obj->tagType, PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
    if($count == 0){
      $obj->setId(DataBase::getInstance()->lastInsertId());
    }
  }
  static public function getTag($id){
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE id = :id');
    $req->bindvalue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $datas = $req->fetch();
    $req->closeCursor();
    $obj = new Tag();
    $obj->hydrate($datas);
    return $obj;
  }
  static public function getTags(){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags');
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Game();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function getTags($tagType){
    $objs = array();
    $req = DataBase::getInstance()->prepare('SELECT id, name, tagType FROM tags WHERE tagType = :tagType');
    $req->bindvalue('tagType', $tagType, PDO::PARAM_STR);
    $req->execute();
    while($datas = $req->fetch()){
      $obj = new Game();
      $obj->hydrate($datas);
      $objs[] = $obj;
    }
    $req->closeCursor();
    return $objs;
  }
  static public function deleteTag($id){
    $req = DataBase::getInstance()->prepare('DELETE FROM tags WHERE id = :id');
    $req->bindvalue('id', $id, PDO::PARAM_INT);
    $req->execute();
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