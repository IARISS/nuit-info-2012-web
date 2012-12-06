<?php
namespace lib;
use lib\db\DataBase;
use lib\culture\Culture;
use lib\tag\Tag;
use lib\tag\OtherTag;
use lib\tag\PosTag;
use lib\tag\ThemeTag;
use lib\tag\DateTag;

spl_autoload_extensions('.php');
spl_autoload_register();

echo "TEST START\n";

echo "DB START\n";

DataBase::install();

echo "DB END\n";
echo "TAG START\n";
$oTag = new OtherTag();
$pTag = new PosTag();
$tTag = new ThemeTag();
$dTag = new DateTag();

$oTag->setName("OtherTagTest");
$pTag->setName("PosTagTest");
$tTag->setName("ThemeTagTest");
$dTag->setName("DateTagTest");

Tag::saveTag($oTag);
Tag::saveTag($pTag);
Tag::saveTag($tTag);
Tag::saveTag($dTag);

echo "TAG END\n";
?>