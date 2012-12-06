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

echo "TEST START<br/>";

echo "DB START<br/>";

DataBase::install();

echo "DB END<br/>";
echo "TAG START<br/>";
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

var_dump($oTag);
var_dump($pTag);
var_dump($tTag);
var_dump($dTag);

var_dump(Tag::countTags());
var_dump(Tag::getTags());
echo "DETELE TAG TEST<br/>";
var_dump(Tag::getTag($dTag->getId()));
var_dump(Tag::deleteTag($dTag->getId()));
var_dump(Tag::getTag($dTag->getId()));
echo "WHERE TYPE TEST<br/>";
var_dump(Tag::getTagsWhereType(Tag::$TYPE['OTHER']));
echo "IN TEST<br/>";
var_dump(Tag::getTagsIn(array(1,2,3,4,5,6,7,8,9,10,11)));

echo "TAG END<br/>";
echo "CULTURE START<br/>";

$c = new Culture();
$c->setName('Culture Test');
$c->setDescription('Description OtherTag de test pour la ThemeTag culture');
$c->setGpsX(2568.26);
$c->setGpsY(657.28);
$c->setGpsZ(798413.552);
$c->setImg('test.png');

var_dump(Culture::saveCulture($c));
var_dump($c);

var_dump(Culture::countCultures());
var_dump(Culture::getCulture($c->getId()));
var_dump(Culture::getCultures());

echo "CULTURE END<br/>";
?>