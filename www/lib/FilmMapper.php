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


    /**
     * rename film and handle nfo file if present
     */
    public function rename($film, $name){

    	global $logger;

    	//$logger->log("renaming $film->file to $name into $film->path", Zend_Log::DEBUG);
    	$logger->log("rename(".$film->path . DIRECTORY_SEPARATOR . $film->file.",". $name.");", Zend_Log::DEBUG);
    	$status = rename($film->path . DIRECTORY_SEPARATOR . $film->file, $name);

    	$status2 = true;
    	if($film->nfo) {
    		$ext_length = strlen(strrchr($name, ".")) - 1;
    		$new_nfo = substr($name, 0, -1*$ext_length).'nfo';
    		$status2 = rename($film->nfo, $new_nfo);
    		$logger->log("rename nfo(".$film->nfo.",". $new_nfo.");", Zend_Log::DEBUG);
    	}

    	return $status && $status2;
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

    public function createNfo($film, $nfo_txt) {
    	global $logger;

    	$nfo_name = $film->getNfoName();
    	$ret = file_put_contents($nfo_name, $nfo_txt."\n", FILE_APPEND);

    	$logger->log("Creating/modifing $nfo_name with content : ".$nfo_txt, Zend_Log::DEBUG);
    	if($ret)
    		return $nfo_name;
    	else
    		return '';
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
