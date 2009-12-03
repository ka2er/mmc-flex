<?php
class FilmAnalyser {

	public $_data;

	public function __construct($film){
    	require_once('getid3/getid3.php');

    	error_log("analyse ".$film);

    	$id3 = new getid3();

    	$id3->option_tag_id3v1 = false;
    	$id3->option_tag_id3v2 = false;
    	$id3->option_tag_lyrics3 = false;
    	$id3->option_tag_apetag = false;
    	$id3->option_tags_html = false;
    	$id3->option_max_2gb_check = false;

    	//Zend_Debug::Dump($id3);
    	$this->_data = $id3->Analyze($film);// ==> v2
    	//getid3_lib::CopyTagsToComments($this->_data);
	}

	public function getVideoCodec(){
    	if(isset($this->_data['video']['fourcc']))
    		return $this->_data['video']['fourcc'];

    	return "VIDEO_CODEC_UNKNOW";
	}

	public function getAudioCodec(){
    	if(isset($this->_data['audio']['dataformat'])) {
    		$codec = $this->_data['audio']['dataformat'];

    		return $codec;
    		switch ($codec) {
    			case 'vorbis':
    				return 'OGG';

    			case 'mp3':
    				return '';

    			default:
    				return ".unknown($codec)";
    		}
    	}

    	return "AUDIO_CODEC_UNKNOW";
	}


	public function getAudioNumberStream(){
		if(isset($this->_data['audio']['streams']))
			return "#".count($this->_data['audio']['streams']);

		return "NB_AUDIO_STREAM_UNKNOW";
	}

    public function getResolution(){

    	/*
    	// 1 - is it screener ?
    	if(stripos($this->getFileName(), 'screener'))
    		return 'SCREENER';
		*/
    	// 2 - is it HD 720/1080
    	if(isset($this->_data['video']['resolution_x'])) {

    		return $this->_data['video']['resolution_x'].'x'.$this->_data['video']['resolution_y'];

    		$x_res = $t['video']['resolution_x'];

    		if($x_res >= 1080) return 'HD1080';
    		if($x_res >= 720) return 'HD720';

    	}

    	// fallback to DVD
    	return 'RESOLUTION_UNKNOW';
    }
}