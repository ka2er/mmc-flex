<?php
class Settings {

	public $langList;
	public $qualityList;
	public $videoCodecList;
	public $audioCodecList;
	public $containerList;
	public $separatorKeywordsList;
	public $pathList;
	public $unwantedCharsList;

	//public $_explicitType = "SettingsVO";

	public function __construct($l, $q, $v, $a, $c, $s, $p, $u) {
		$this->langList = $l;
		$this->qualityList = $q;
		$this->videoCodecList = $v;
		$this->audioCodecList = $a;
		$this->containerList = $c;
		$this->separatorKeywordsList = $s;
		$this->pathList = $p;
		$this->unwantedCharsList = $u;
	}

	public function getASClassName(){
		return "SettingsVO";
	}
}