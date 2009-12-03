<?php
class Setting {

	public $id;
	public $name;

	public $_explicitType = "SettingVO";


	public function getASClassName(){
		return "SettingVO";
	}
}