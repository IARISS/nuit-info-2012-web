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
    header('Location: /home');
    exit();
}

// Contenu de la page
str_replace("\0", '', $_GET['page']); //Protection bytenull
str_replace(DIRECTORY_SEPARATOR, '', $_GET['page']); //Protection navigation
$contentPage = 'pages/'.$_GET['page'].'.php';
$contentPage = file_exists($contentPage)?$contentPage:'pages/404.php';

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
        <link rel="stylesheet" media="screen" href="/css/style.css" />
    </head>
    
    <body>
        
        <header>
            <h1><a href="/" title="IarissTeam">IarissTeam</a></h1>
            <nav id="header-menu">
                  
            </nav>
        </header>
        
        <div id="content">
            <?php include($contentPage); ?>
        </div>
        
        <footer>
           
        </footer>
    </body>
</html>

