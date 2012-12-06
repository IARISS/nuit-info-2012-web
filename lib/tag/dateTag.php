<?php
namespace lib\tag;
/**
 * @author Karl
 */
class DateTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE_DATE;
  }
}
?>