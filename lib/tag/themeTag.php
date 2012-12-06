<?php
namespace lib\tag;
/**
 * @author Karl
 */
class ThemeTag extends Tag{
  public function __construct(){
  	$this->$tagType = Tag::$TYPE_THEME;
  }
}
?>