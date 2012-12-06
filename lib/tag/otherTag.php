<?php
namespace lib\tag;

class OtherTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE_OTHER;
  }
}