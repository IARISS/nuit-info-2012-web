<?php
namespace lib;
use lib\content\Form;
use lib\content\Image;
use lib\content\Menu;
use lib\content\Message;

include 'common.php';

$_javascripts = array();

//Affichage
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <!--
    
    $$$$$$\                    $$\                           $$$$$$$$\                                
    \_$$  _|                   \__|                          \__$$  __|                               
      $$ |  $$$$$$\   $$$$$$\  $$\  $$$$$$$\  $$$$$$$\          $$ | $$$$$$\   $$$$$$\  $$$$$$\$$$$\  
      $$ |  \____$$\ $$  __$$\ $$ |$$  _____|$$  _____|         $$ |$$  __$$\  \____$$\ $$  _$$  _$$\ 
      $$ |  $$$$$$$ |$$ |  \__|$$ |\$$$$$$\  \$$$$$$\           $$ |$$$$$$$$ | $$$$$$$ |$$ / $$ / $$ |
      $$ | $$  __$$ |$$ |      $$ | \____$$\  \____$$\          $$ |$$   ____|$$  __$$ |$$ | $$ | $$ |
    $$$$$$\\$$$$$$$ |$$ |      $$ |$$$$$$$  |$$$$$$$  |         $$ |\$$$$$$$\ \$$$$$$$ |$$ | $$ | $$ |
    \______|\_______|\__|      \__|\_______/ \_______/          \__| \_______| \_______|\__| \__| \__|
    
    -->
    <meta name="author" content="IarissTeam" />
    <!--<meta http-equiv="X-UA-Compatible" content="chrome=1" />-->
    <meta name="viewport" content="width=device-width" />
    <meta name="robots" content="index, follow, archive" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <title>Le guide du berêt</title>
    
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Imprima" type="text/css" />
    <link rel="stylesheet" media="screen" href="theme/defaut/css/bootstrap.min.css" />
    <link rel="stylesheet" media="screen" href="theme/defaut/css/bootstrap-responsive.min.css" />
    <?php foreach( array('defaut', $_theme) as $t ): if( empty($t) ) continue; ?>
    <link rel="stylesheet" media="screen" href="theme/<?php echo $t; ?>/css/style.css" />
    <?php endforeach; ?>
    
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
		<link rel="icon" type="image/png" href="/favicon.png" />
  </head>
  <body>
    <div id="background"></div>
    <div id="background-filter"></div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="./"><img class="logo" src="/theme/defaut/img/french-beret.png" alt="" /><span id="nav-title">Le guide du berêt</span></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li<?php echo ($_GET['page'] != 'add'?' class="active"':''); ?>><a href="./"><i class="icon-home"></i> Recherche</a></li>
              <li<?php echo ($_GET['page'] == 'add'?' class="active"':''); ?>><a href="./add"><i class="icon-plus"></i> Cultivez</a></li>
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
                    <a href="?theme=<?php echo urlencode($theme); ?>"><?php echo ucwords($theme); ?></a>
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
      <section id="container" class="container">
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
       &copy; Iariss Team pour la <a href="http://www.nuitdelinfo.com/nuitinfo2012/">Nuit de l'info 2012</a> - <a href="http://blog.iarissme.me">Blog &amp; l'équipe</a>
    </footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="./theme/defaut/js/bootstrap.min.js"></script>
    <script src="./theme/defaut/js/jquery.snow.js"></script>
    <?php echo implode(PHP_EOL, $_javascripts); ?>
  </body>
</html>