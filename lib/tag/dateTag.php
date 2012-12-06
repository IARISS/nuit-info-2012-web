<?php
namespace lib\tag;

class DateTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE_DATE;
  }
}
?>