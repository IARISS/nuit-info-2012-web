<?php
namespace lib\tag;
/**
 * @author Karl
 */
class OtherTag extends Tag{
  public function __construct(){
  	$this->setTagType(Tag::$TYPE['OTHER']);
  }
}
?>