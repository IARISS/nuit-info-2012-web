<?php
namespace lib\tag;
/**
 * @author Karl
 */
class PosTag extends Tag{
  public function __construct(){
  	$this->setTagType(Tag::$TYPE['POS']);
  }
}
?>