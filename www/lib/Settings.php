<?php
/**
 * ne surtout pas utiliser de membres prefixes par _ : ils ne seront pas transmis
 */

class Settings {

	public $langList;
	public $qualityList;
	public $videoCodecList;
	public $audioCodecList;
	public $containerList;
	public $separatorKeywordsList;
	public $pathList;
	public $unwantedCharsList;
	public $unwantedProposedList;
	public $description;

	public function __construct($d, $l, $q, $v, $a, $c, $s, $p, $u, $up) {
		$this->description = $d;
		$this->langList = $l;
		$this->qualityList = $q;
		$this->videoCodecList = $v;
		$this->audioCodecList = $a;
		$this->containerList = $c;
		$this->separatorKeywordsList = $s;
		$this->pathList = $p;
		$this->unwantedCharsList = $u;
		$this->unwantedProposedList = $up;
	}
}