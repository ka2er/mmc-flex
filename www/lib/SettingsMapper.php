<?php
require_once "Setting.php";
require_once "Settings.php";

/**
 * Settins manipulation class (load, add, del)
 */
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
	 * array of object wich describe the tables
	 */
	protected $_description = array(
		'lang' => 'Code de langue (version courte) : FR, EN, etc...',
		'quality' => 'Qualité du film : DVDRiP, SCREENER, etc...',
		'video_codec' => 'Codec vidéo : DiVX, X264, etc..',
		'audio_codec' => 'Codec audio : AC3, OGG, etc ...',
		'container' => 'Format du conainter : avi, mkv, etc...',
		'separator_keywords' => 'Chaine de séparation entre les mots à utiliser dans le nouveau nom',
		'path' => "Chemin que l'application peut gérer (répertoires où sont les films)",
		'unwanted_chars' => "Chaines de caractères à supprimer"
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
	 * Move down/up setting into the table
	 */
	public function reorder($setting, $table, $sens) {
		global $logger;

		$cur_id = $setting->id;
		$other_id = $sens == 'up' ? $cur_id - 1 : $cur_id + 1;

		$oTable = new Zend_Db_Table($table);
		$where_cur = $oTable->getAdapter()->quoteInto('id = ?', $cur_id);
		$where_other = $oTable->getAdapter()->quoteInto('id = ?', $other_id);
		$where_tmp = $oTable->getAdapter()->quoteInto('id = ?', 999);

		$oTable->update(array('id' => 999), $where_cur);
		$oTable->update(array('id' => $cur_id), $where_other);
		$result = $oTable->update(array('id' => $other_id), $where_tmp);

		$logger->log("Reorder setting $table=$setting->id $sens", Zend_Log::INFO);
		return $result;
	}

	/**
	 * retourne tous les parametres
	 *
	 * @return Settings
	 */
	public function load(){

		global $logger;

		$this->_init();

		foreach ($this->_tables as $holder => $table) {
			$oTable = new Zend_Db_Table($table);

			$xt = array();
			foreach($oTable->fetchAll($oTable->select()->order('id ASC'))->toArray() as $o) {
				$xsetting = new Setting();
				$xsetting->name = $o['name'];
				$xsetting->id = $o['id'];
				$xt[] = $xsetting;
			}

			$t[$holder] = $xt;
		}

		$s = new Settings($this->_description, $t[0], $t[1], $t[2], $t[3], $t[4], $t[5], $t[6], $t[7]);
		return $s;
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
