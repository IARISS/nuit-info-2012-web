<?php

use lib\db\DataBase;
use lib\culture\Culture;

$get_id = isset($_GET['n']) ? intval($_GET['n']) : null;

$entity = Culture::getCulture($get_id);

if( !$get_id || !$entity )
  throw new \Exception('Id not exits');


$description = $entity->getDescription();

$tags = array();
foreach( $entity->getTags() as $tag )
  $tags[] = $tag->getName();

$description = preg_replace('`(' . implode('|', array_map('preg_quote', $tags)) . ')`sUi', '<a href="./search?search=$1">#$1</a>', $description);

?>