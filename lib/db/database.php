<?php
namespace lib\db;
use Exception;
use PDO;
use SimpleXMLElement;

//For install
use lib\culture\Culture;
use lib\tag\Tag;

/**
 * @author Karl
 */
class DataBase {
    private static $instance;
    private static $count = 0;

    static public function getInstance(){
        if(!isset(self::$instance)){
            $cfgFile = 'config/database.xml';
            if(!file_exists($cfgFile)){
                $xmlOut = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<root>\n\t<dsn>mysql:host=127.0.0.1;dbname=iariss</dsn>\n\t<login>root</login>\n\t<password></password>\n</root>";
                $xmlFile = fopen($cfgFile, 'w');
                fwrite($xmlFile,$xmlOut);
                fclose($xmlFile);
            }
            $xmlConfig = new SimpleXMLElement($cfgFile, null, true);
        
            self::$instance = new PDO($xmlConfig->dsn, $xmlConfig->login, $xmlConfig->password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::$instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        }
        self::$count++;
        return self::$instance;
    }
    static function install(){
        Tag::install();
        Culture::install();
    }
    static function countQuery(){
        return self::$count;
    }
}

?>
