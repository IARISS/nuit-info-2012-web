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

/*
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
var_dump(Tag::getTagsIdIn(array(1,2,3,4,5,6,7,8,9,10,11)));

echo "TAG END<br/>";

echo "CULTURE START<br/>";

$c = new Culture();
$c->setName('Culture Test');
$c->setDescription('Description OtherTagTest de test pour la ThemeTagTest culture');
$c->setGpsX(2568.26);
$c->setGpsY(657.28);
$c->setGpsZ(798413.552);
$c->setImg('test.png');
$c->parseTags();


var_dump(Culture::saveCulture($c));
var_dump($c);

var_dump(Culture::countCultures());
var_dump(Culture::getCulture($c->getId()));
var_dump(Culture::getCultures());

var_dump($c->getTags());

echo "CULTURE END<br/>";
*/

/*
$str = "Musée, Restaurant, Monument, Château, Piscine, Salle de sport, Bibliothèque, Zoo, Parc, Marché, Vignoble, Boutique";
foreach(explode(", ", $str) as $word){
	$t = new ThemeTag();
	$t->setName($word);
	Tag::saveTag($t);
}
$str = "Ain,Aisne,Allier,Alpes-de-Haute-Provence,Hautes-Alpes,Alpes-Maritimes,Ardèche,Ardennes,Ariège,Aube,Aude,Aveyron,Bouches-du-Rhône,Calvados,Cantal,Charente,Charente-Maritime,Cher,Corrèze,Corse-du-Sud,Haute-Corse,Côte-d-Or,Côtes-d-Armor,Creuse,Dordogne,Doubs,Drôme,Eure,Eure-et-Loir,Finistère,Gard,Haute-Garonne,Gers,Gironde,Hérault,Ille-et-Vilaine,Indre,Indre-et-Loire,Isère,Jura,Landes,Loir-et-Cher,Loire,Haute-Loire,Loire-Atlantique,Loiret,Lot,Lot-et-Garonne,Lozère,Maine-et-Loire,Manche,Marne,Haute-Marne,Mayenne,Meurthe-et-Moselle,Meuse,Morbihan,Moselle,Nièvre,Nord,Oise,Orne,Pas-de-Calais,Puy-de-Dôme ,Pyrénées-Atlantiques,Hautes-Pyrénées,Pyrénées-Orientales,Bas-Rhin,Haut-Rhin,Rhône,Haute-Saône,Saône-et-Loire,Sarthe,Savoie,Haute-Savoie,Paris,Seine-Maritime,Seine-et-Marne,Yvelines,Deux-Sèvres,Somme,Tarn,Tarn-et-Garonne,Var,Vaucluse,Vendée,Vienne,Haute-Vienne,Vosges,Yonne,Territoire-de-Belfort,Essonne,Hauts-de-Seine,Seine-Saint-Denis,Val-de-Marne,Val-d-Oise,Guadeloupe,Martinique,Guyane,La-Réunion,Mayotte";
foreach(explode(",", $str) as $word){
	$t = new PosTag();
	$t->setName($word);
	Tag::saveTag($t);
}
*/
$str = "préhistoire,antiquité,moyen-age,moderne,contemporain,renaissance,révolution,lumières,industrielle,glorieuses,guerres";
foreach(explode(",", $str) as $word){
	$t = new PosTag();
	$t->setName($word);
	Tag::saveTag($t);
}

foreach(Culture::getCultures() as $c){
	Culture::saveCulture($c);
}


?>