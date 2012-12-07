<?php

use lib\db\DataBase;
use lib\culture\Culture;
use lib\tag\Tag;

$entity = new Culture();
$errors = array();

try {
  $post_title       = isset($_POST['title'])       ? htmlspecialchars($_POST['title'])       : null;
  $post_description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;

  if( empty($post_title) )
    throw new Exception('Titre vide');

  if( empty($post_description) )
    throw new Exception('Description vide');

  $entity->setName($post_title);
  $entity->setDescription($post_description);
  Culture::saveCulture($entity);

  Header('Location: ./view-' . $entity->getId());
}
catch(Exception $e)
{
  $errors[] = $e->getMessage();
}

?>