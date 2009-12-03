<?php
$db = New Zend_Db_Adapter();
$db = Zend_Db::factory('Pdo_Sqlite', array(
	'dbname' => '/tmp/mmc.db'
))
Zend_Db_Table::setDefaultAdapter($db);

$db->