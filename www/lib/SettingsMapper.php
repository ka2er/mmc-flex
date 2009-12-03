<?php
require_once "Setting.php";
require_once "Settings.php";

class SettingsMapper
{
	protected $_path;
	protected $_extensions; // comma separated

	protected $_tables = array(
			'lang',
			'quality',
			'video_codec',
			'audio_codec',
			'container',
			'separator_keywords',
			'path',
			'unwanted_chars'
	);

	/**
	 * Add new setting and return ID of the setting
	 */
	public function add($setting, $table) {
		global $logger;

		$oTable = new Zend_Db_Table($table);

		$data = array('name' => $setting->name);
		$result = $oTable->insert($data);
		$logger->log("Add setting $table=$setting->name", Zend_Log::INFO);
		return $result;
	}

	/**
	 * Del new setting and return ID of the setting
	 */
	public function del($setting, $table) {
		global $logger;

		$oTable = new Zend_Db_Table($table);
		$where = $oTable->getAdapter()->quoteInto('id = ?', $setting->id);
		$result = $oTable->delete($where);
		$logger->log("Del setting $table=$setting->id", Zend_Log::INFO);
		return $result;
	}

	/**
	 * retourne tous les parametres
	 */
	public function load(){

		global $logger;

		$this->_init();

		foreach ($this->_tables as $holder => $table) {
			$oTable = new Zend_Db_Table($table);

			$xt = array();
			foreach($oTable->fetchAll($oTable->select())->toArray() as $o) {
				$xsetting = new Setting();
				$xsetting->name = $o['name'];
				$xsetting->id = $o['id'];
				$xt[] = $xsetting;
			}

			$t[$holder] = $xt;
		}

		return new Settings($t[0], $t[1], $t[2], $t[3], $t[4], $t[5], $t[6], $t[7]);
	}

	/**
	 * cree les tables si elles n'existent pas
	 */
	private function _init(){
		global $db, $logger;

		$t_tables = $db->listTables();
		//$logger->log(implode($t_tables) , Zend_Log::DEBUG);
		$t = array_diff($this->_tables, $t_tables);

		foreach ($t as $table) {
			$db->query("
				create table $table(
					id integer not null primary key,
					name varchar(100)
				)
			");
		}
	}
}
