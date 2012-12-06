<?php
namespace lib\tag;
/**
 * @author Karl
 */
class DateTag extends Tag{
  public function __construct(){
  	$this->setTagType(Tag::$TYPE[DATE]);
  }
}
?>