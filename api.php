<?php
namespace lib;
use lib\culture\Culture;

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
    $return = Culture::findCultures($value);
    break;


  case 'view' :
    // @param id = $value
    $return = Culture::getCulture($value);;
    break;

  default:
    $return['error'] = 'Unknown action';
    break;
}

Header('Content-type: application/json');
echo json_encode($return ?: new stdClass());




?>