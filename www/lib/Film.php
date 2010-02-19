<?php


class Film {

	public $video_codec;
	public $audio_codec;
	public $resolution;
	public $nb_audio_stream;

	public $titre;

	public $file;
	public $path;
	public $ext;

	public $nfo;

	public $_explicitType = "FilmVO";

	public function Film($file = null){
		global $logger;

		if($file) {
			$logger->log("creating Film $file", Zend_Log::DEBUG);

			$t = pathinfo($file);

			$this->file = $t['basename'];
			$this->path = $t['dirname'];
			$this->ext = $t['extension'];

			$this->titre = $t['filename'];

			// il y a t'il un NFO
			$nfo = $this->getNfoName();
			if(file_exists($nfo)) {
				$logger->log("$nfo found", Zend_Log::DEBUG);
				$this->nfo = $nfo;
			}


			/*
			require_once "FilmAnalyser.php";
			$fa = new FilmAnalyser($file);
			$this->video_codec = $fa->getVideoCodec();
			$this->audio_codec = $fa->getAudioCodec();
			*/
		}
	}

	public function getNfoName(){
		$film_name = $this->path . DIRECTORY_SEPARATOR . $this->file;
		$nfo = substr($film_name, 0, strlen($this->ext)*-1).'nfo';
		return $nfo;
	}

	public function getASClassName(){
		return "FilmVO";
	}
}