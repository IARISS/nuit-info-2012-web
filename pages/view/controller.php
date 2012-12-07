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

$tags2 = array();
foreach( array_map('preg_quote', $tags) as $t )
  if( !empty($t) )
    $tags2[] = $t;

if( $tags2 )
  $description = preg_replace('`(' . implode('|', $tags2) . ')`sUi', '<a href="./search?search=$1">#$1</a>', str_replace('#', '', $description));

$mapsLink = 'https://maps.google.fr/maps?q='.$entity->getGpsX().'+'.$entity->getGpsY().'&amp;hl=fr&amp;ll='.$entity->getGpsX().','.$entity->getGpsY().'&amp;sll='.$entity->getGpsY().','.$entity->getGpsY().'&amp;t=h&amp;z=16';


$img = $entity->getImg();

if( empty($img) ) // /!\ @TODO getImageSize ouvre l'image ... à modifier
  $img = 'theme/defaut/img/noimage.png';


?>