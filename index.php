<?php
namespace lib;
use lib\content\Form;
use lib\content\Image;
use lib\content\Menu;
use lib\content\Message;

spl_autoload_extensions('.php');
spl_autoload_register();

session_start();


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

//Affichage
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="IarissTeam" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width" />
    <meta name="robots" content="index, follow, archive" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <title>IarissTeam</title>
    
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" media="screen" href="theme/defaut/css/bootstrap.min.css" />
    <link rel="stylesheet" media="screen" href="theme/defaut/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" media="screen" href="theme/defaut/css/style.css" />
    
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
		<link rel="icon" type="image/png" href="/favicon.png" />
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Iariss Team</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Accueil</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input type="text" class="search-query" placeholder="Search">
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <div>
      <section class="container">
      <?php
      $controllerPage = dirname($contentPage) . '/controller.php';
      
      // Controller
      if( file_exists($controllerPage) )
        require $controllerPage;

      include $contentPage; // view
      ?>
      </section>
    </div>
    
    <footer>
       
    </footer>
  </body>
</html>