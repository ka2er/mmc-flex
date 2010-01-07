<?php
require_once "Film.php";

class FilmMapper
{
	protected $_path = array();
	protected $_extensions; // comma separated

	private function _init(){

		global $logger;

		$oTable = new Zend_Db_Table('path');
 		foreach($oTable->fetchAll($oTable->select())->toArray() as $xt) {
			$this->_path[] = $xt['name'];
		}

		$oTable = new Zend_Db_Table('container');
		$t = array();
 		foreach($oTable->fetchAll($oTable->select())->toArray() as $xt) {
			$t[] = $xt['name'];
		}

		$this->_extensions = implode(',', $t);
		$logger->log('Valid extensions are : '.$this->_extensions, Zend_Log::DEBUG);
	}

    /**
     * retourne la liste des films trouvés
     * @return array
     */
    public function fetchAll()
    {
    	$this->_init();

    	global $logger;

    	$t = array();

		foreach($this->_path as $path) {
	    	$pattern = $path . DIRECTORY_SEPARATOR .'*.{'.$this->_extensions.'}';
	    	//$logger->log($pattern, Zend_Log::DEBUG);
	    	foreach(glob($pattern, GLOB_BRACE) as $file) { // sql_regcase pour matcher avi et AVI
	    		$logger->log("Found film $file", Zend_Log::DEBUG);
	    		$t[] = new Film($file);
	    	}
		}

    	return $t;
    }

    /**
     * simulation de la liste des films trouvés
     * @return array
     */
    public function simulateFetchAll()
    {
    	$t_fake = array(
    		'b13 ultimatum-SCR.avi',
    		'b13 ultimatum-SCR.avi',
    		'l\'arme fatale 4.avi',
			'fantastic 4.avi',
    		'et plus.avi',
    	);

    	$t = array();
    	foreach($t_fake as $file) { // sql_regcase pour matcher avi et AVI
    		$t[] = new Film($file);
    		//$t[] = array('name' => $file);
    	}
    	return $t;
    }


    public function rename($film, $name){

    	global $logger;

    	//$logger->log("renaming $film->file to $name into $film->path", Zend_Log::DEBUG);
    	$logger->log("rename(".$film->path . DIRECTORY_SEPARATOR . $film->file.",". $name.");", Zend_Log::DEBUG);
    	$status = rename($film->path . DIRECTORY_SEPARATOR . $film->file, $name);
    	return $status;
    }

    public function getExtraInfos($film) {
    	require_once "FilmAnalyser.php";

    	$file = $film->path . DIRECTORY_SEPARATOR . $film->file;

    	$fa = new FilmAnalyser($file);
		$film->video_codec = $fa->getVideoCodec();
		$film->audio_codec = $fa->getAudioCodec();
		$film->resolution = $fa->getResolution();
		$film->nb_audio_stream = $fa->getAudioNumberStream();

    	return $film;
    }

    /**
     *
     * @param $file
     * @return unknown_type
     */
   /* public function get($file) {

    	if(file_exists($this->_path . DIRECTORY_SEPARATOR . $file))
    		return $this->_path . DIRECTORY_SEPARATOR . $file;

    	throw new Exception("Unable to found Film $file");
    }*/
}
