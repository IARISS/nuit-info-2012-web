<?php
namespace lib;
use lib\culture\Culture;
use lib\tag\Tag;

spl_autoload_extensions('.php');
spl_autoload_register();

/**
 * api.php?action=search&value={TAG}  : {TAG} = tag1+tag2 -> urlecode()
 *  @return [
 *    {
 *      id: #,
 *      name: #,
 *      description: #,
 *      img: #,
 *      position: [ #gpsX, #gpsY, #gpsZ],
 *      tags: [ #tag.name ]
 *    }
 *  ]
 * api.php?action=view&value={ID}
 */

$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : null;
$value  = isset($_GET['value'])  ? htmlspecialchars($_GET['value'])  : null;

$return = array();

switch($action) {
  case 'search' :
    // @param search = $value
    $cultures = Culture::findCultures($value);
    $return = array();
    foreach($cultures as $c){
      $return['culture'][] = $c->toJson();
    }
    break;

  case 'random' :
    // @param search = $value
    $tags = Tag::getRandomTags($value);
    $return = array();
    foreach($tags as $t){
      $return['tag'][] = $t->toJson();
    }
    break;

  case 'view' :
    // @param id = $value
    $return['culture'] = Culture::getCulture($value)->toJson();
    break;

  default:
    $return['error'] = 'Unknown action';
    break;
}

//Header('Content-type: application/json');
var_dump($return);
echo json_encode($return ?: new stdClass());




?>