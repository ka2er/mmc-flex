<?php
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('./lib'),
    get_include_path(),
)));

require_once "Zend/Loader/Autoloader.php";
require_once "SettingsMapper.php";
require_once "FilmMapper.php";
require_once "FilmAnalyser.php";
require_once "Film.php";

$autoload = Zend_Loader_Autoloader::getInstance();
$autoload->registerNamespace('Zend');

$logger = new Zend_Log(new Zend_Log_Writer_Null());

/* la base de données */

$db = Zend_Db::factory('Pdo_Sqlite', array(
	'dbname' => 'db/mmc.db'
));
Zend_Db_Table::setDefaultAdapter($db);


//$sM = new SettingsMapper();

$fM = new FilmMapper();

$fa = new FilmAnalyser('/home/seb/Desktop/rw/New police story.avi');
Zend_Debug::dump($fa->_data['audio']);
Zend_Debug::dump($fa->getAudioNumberStream());


//Zend_Debug::dump($fM->rename(new Film('/home/seb/Desktop/rw/x.mkv'), '/home/seb/Desktop/rw/x.mkv'));
Zend_Debug::dump($fM->fetchAll());
//Zend_Debug::dump($sM->getList());
