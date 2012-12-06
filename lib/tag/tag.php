<?php
namespace lib\tag;
use lib\db\DataBase;
use PDO;

abstract class Tag {
  private $id = 0;
  private $name;

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
      $req = DataBase::getInstance()->prepare('INSERT INTO tags(name) VALUES (:name)');
    }
    else{
      $req = DataBase::getInstance()->prepare('UPDATE tags SET (name = :name) WHERE id = :id');
      $req->bindvalue('id', $obj->getId(), PDO::PARAM_INT);
    }
    $req->bindValue('name', $obj->name, PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
    if($count == 0){
      $obj->setId(DataBase::getInstance()->lastInsertId());
    }
  }
  static public function getTag($id){
    $req = DataBase::getInstance()->prepare('SELECT id, name FROM tags WHERE id = :id');
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
    $req = DataBase::getInstance()->prepare('SELECT id, name FROM tags');
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
        PRIMARY KEY (id)
      ) ENGINE=InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;
    ');
  }
}
?>