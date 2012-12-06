<?php

spl_autoload_extensions('.php');
spl_autoload_register();

session_start();

/* SET Theme */
define('_DIR_', dirname(__FILE__) . DIRECTORY_SEPARATOR);

$theme = null;
if( isset($_GET['theme']) ) {
  $_COOKIE['theme'] = htmlspecialchars($_GET['theme']);
  setcookie('theme', $_COOKIE['theme']);
}

if( isset($_COOKIE['theme']) ) {
  $theme = htmlspecialchars($_COOKIE['theme']);
  if( !file_exists(_DIR_ . 'theme/' . $theme . '/') )
    $theme = null;
}



//Template maitre, les pages supplémentaires sont à mettre dans le dossier pages
if (empty($_GET['page'])) {
  $_GET['page'] = 'home';
  //header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/home');
  exit();
}

// Contenu de la page
str_replace("\0", '', $_GET['page']); //Protection bytenull
str_replace(DIRECTORY_SEPARATOR, '', $_GET['page']); //Protection navigation

$contentPage = 'pages/'.$_GET['page'].'/view.php';
$contentPage = file_exists($contentPage)?$contentPage:'pages/errors/404.php';
