<?php
class Upload{
	var int $x;
	var int $y;
	var string $dir;
	var $file;
	
	public function __construct($file,$type){
		if($type=="ava"){
			$this->file=$file;
			$this->x=256;
			$this->y=256;
			$this->dir=$_SERVER["DOCUMENT_ROOT"]."storage/avatar/";
		}elseif($type=="bg"){
			$this->file=$file;
			$this->x=960;
			$this->y=640;
			$this->dir=$_SERVER["DOCUMENT_ROOT"]."storage/background/";
		}
	}
	
	function UpdateAvatar(int $id){
		$uid=$id;
		$file=$this->file;
		require_once("./imagick.php");
		$img=new lib_image_imagick();
		$img->open($file["tmp_name"]);
		$type=$img->get_type();
	}
}
?>