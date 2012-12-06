<?php
namespace lib\tag;
/**
 * @author Karl
 */
class ThemeTag extends Tag{
  public function __construct(){
  	$this->setTagType(Tag::$TYPE['THEME']);
  }
}
?>