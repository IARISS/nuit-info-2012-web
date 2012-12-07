<?php

use lib\db\DataBase;
use lib\culture\Culture;
use lib\tag\Tag;

$get_search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;

$entitiesTags = Tag::getTagsExtractedFromString($get_search);

// insert history

$entities = Culture::findCultures($get_search);

$otherTags1 = array();
$otherTags  = array();

foreach( $entities as $entity ) {
  foreach( $entity->getTagsId() as $tag )
    if( !isset($otherTags[$tag]) )
      $otherTags1[$tag] = 1;
    else
      $otherTags1[$tag]++;
}

krsort($otherTags1);

$i = 0;
foreach( $otherTags1 as $tag => $nb ) {
  if( $i > 5 )
    break;
  $otherTags[] = Tag::getTag($tag);
}


?>