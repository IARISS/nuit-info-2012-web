<?php

use lib\db\DataBase;
use lib\culture\Culture;

$get_id = isset($_GET['n']) ? intval($_GET['n']) : null;

if( !$get_id )
  throw new \Exception('Id not exits');

$entity = Culture::getCulture($get_id);

?>