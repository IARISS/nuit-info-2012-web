<?php

use lib\db\DataBase;
use lib\culture\Culture;

$get_id = isset($_GET['n']) ? intval($_GET['n']) : null;

$entity = Culture::getCulture($get_id);

if( !$get_id || !$entity )
  throw new \Exception('Id not exits');

?>