<?php
namespace lib;
use lib\content\Form;
use lib\content\Image;
use lib\content\Menu;
use lib\content\Message;

include 'common.php';

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
    <?php foreach( array('defaut', $_theme) as $t ): if( empty($t) ) continue; ?>
    <link rel="stylesheet" media="screen" href="theme/<?php echo $t; ?>/css/style.css" />
    <?php endforeach; ?>
    
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
            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Thèmes <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="nav-header">Selectionnez un thème</li>
                  <?php
                  foreach( new \DirectoryIterator('./theme/') as $theme ):
                    if( !$theme->isDir() || $theme->isDot() )
                        continue;
                  ?>
                  <li <?php echo $_theme == (string) $theme ? 'class="active"' : null; ?>>
                    <a href="?theme=<?php echo $theme; ?>"><?php echo ucfirst($theme); ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <div>
      <section class="container">
      <?php
      try {
        $controllerPage = dirname($contentPage) . '/controller.php';
      
        // Controller
        if( file_exists($controllerPage) )
          require $controllerPage;

        include $contentPage; // view
      }
      catch(\Exception $e) {
        echo '<div class="alert alert-error"><h1>Erreur</h1>', $e->getMessage(), '</div>';
      }

      ?>
      </section>
    </div>
    
    <footer>
       
    </footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="./theme/defaut/js/bootstrap.min.js"></script>
  </body>
</html>