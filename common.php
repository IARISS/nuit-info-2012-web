<?php

spl_autoload_extensions('.php');
spl_autoload_register();

session_start();

/* SET Theme */
define('_DIR_', dirname(__FILE__) . DIRECTORY_SEPARATOR);

$_theme = null;
if( isset($_GET['theme']) ) {
  $_COOKIE['theme'] = htmlspecialchars($_GET['theme']);
  setcookie('theme', $_COOKIE['theme']);
}

if( isset($_COOKIE['theme']) ) {
  $_theme = htmlspecialchars($_COOKIE['theme']);
  if( !file_exists(_DIR_ . 'theme/' . $_theme . '/') )
    $_theme = null;
}



//Template maitre, les pages supplémentaires sont à mettre dans le dossier pages
if (empty($_GET['page'])) {
  $_GET['page'] = 'home';
  //header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/home');
  //exit();
}

// Contenu de la page
str_replace("\0", '', $_GET['page']); //Protection bytenull
str_replace(DIRECTORY_SEPARATOR, '', $_GET['page']); //Protection navigation

$contentPage = 'pages/'.$_GET['page'].'/view.php';
$contentPage = file_exists($contentPage)?$contentPage:'pages/errors/404.php';



function print_error($errors) {
  $return = null;
  
  if( $errors ) {
    $return  = '<div class="alert alert-error" style="margin: 2% 5%"><h2>Erreur</h2><ul>';
    foreach( (array) $errors as $error )
      $return .= '<li>' . $error . '</li>';
    $return .= '</ul></div>';
  }

  echo $return;
}