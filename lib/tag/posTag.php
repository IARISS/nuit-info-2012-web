<?php
namespace lib\tag;

class PosTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE_POS;
  }
}
?>