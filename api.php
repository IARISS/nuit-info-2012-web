<?php


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
    // @param tags = $value
    $tags = preg_split('/[[:space:][:punct:][:digit:]]/', strtolower($value), -1, PREG_SPLIT_NO_EMPTY);

    $return = array();

    break;


  case 'view' :
    // @param id = $value

    $return = array();
    break;

  default:
    $return['error'] = 'Unknown action';
    break;
}

Header('Content-type: application/json');
echo json_encode($return);




?>