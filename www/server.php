<?php
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('./lib'),
    get_include_path(),
)));

require "Zend/Loader/Autoloader.php";

require_once "FilmMapper.php";
require_once "SettingsMapper.php";

try {


	$autoload = Zend_Loader_Autoloader::getInstance();
	$autoload->registerNamespace('Zend');

	// pour debugger un film...
	if (isset($_GET['film'])) {
		require_once "FilmAnalyser.php";
		$fa = new FilmAnalyser($_GET['film']);
		Zend_Debug::dump($fa);
		exit();
	}

	/* le log de debug */
	$writer = new Zend_Log_Writer_Stream('php-errors.log');
	$logger = new Zend_Log($writer);

	/* la base de donn�es */
	if(!file_exists('db')) // on cree le rep de la base de donn�e si il n'existe pas
		mkdir('db');

	$db = Zend_Db::factory('Pdo_Sqlite', array(
		'dbname' => 'db/mmc.db'
	));
	Zend_Db_Table::setDefaultAdapter($db);

	//print_r($db);

	$server = new Zend_Amf_Server();
	$server->setClassMap('FilmVO', 'Film');
	$server->setClassMap('SettingVO', 'Setting');
	$server->setClassMap('SettingsVO', 'Settings');

	$server->setProduction(false);
	$server->setClass('FilmMapper', 'films');
	$server->setClass('SettingsMapper', 'settings');
	$response = $server->handle();
	echo $response;

} catch(Exception $e) {
	error_log($e->getMessage());
}
