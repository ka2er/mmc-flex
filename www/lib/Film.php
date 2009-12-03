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

			/*
			require_once "FilmAnalyser.php";
			$fa = new FilmAnalyser($file);
			$this->video_codec = $fa->getVideoCodec();
			$this->audio_codec = $fa->getAudioCodec();
			*/
		}
	}

	public function getASClassName(){
		return "FilmVO";
	}
}