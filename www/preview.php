<?php
$file = isset($_GET['file']) ? $_GET['file'] : false;


if($file){

	header("Pragma: no-cache");
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Type: ".mime_content_type($file));
	header("Content-Location:\"$file\"");
	header("Content-Disposition: attachment; filename=\"".basename($file)."\";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($file));
	@readfile($file);
}