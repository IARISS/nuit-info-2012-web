<?php

use lib\db\DataBase;
use lib\culture\Culture;
use lib\tag\Tag;

$get_id = isset($_GET['n']) ? htmlspecialchars($_GET['n']) : null;

$entity = Culture::getCulture($get_id);

if( !$get_id || !$entity )
  throw new \Exception('Id not exits');

// Edition
if( isset($_POST['description'], $_POST['title']) ) {
  $entity->setName($_POST['title']);
  $entity->setDescription($_POST['description']);

  if( isset($_POST['img']) ) {
    $entity->setImg('http://' . preg_replace('`^http:\/\/`si', '', $_POST['img']));
  }

  if( isset($_POST['gpsX']) )
    $entity->setGpsX($_POST['gpsX']);
  
  if( isset($_POST['gpsY']) )
    $entity->setGpsY($_POST['gpsY']);

  Culture::saveCulture($entity);
}

?>