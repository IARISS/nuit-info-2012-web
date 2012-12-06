<?php
namespace lib\tag;
/**
 * @author Karl
 */
class OtherTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE[OTHER];
  }
}
?>