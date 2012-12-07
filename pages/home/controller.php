<?php

use lib\db\DataBase;
use lib\culture\Culture;
use lib\tag\Tag;

$get_search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;

$entitiesTopTags = Tag(); //  array::getTopTags();

?>