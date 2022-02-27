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
			$this->y=480;
			$this->dir=$_SERVER["DOCUMENT_ROOT"]."storage/bg/";
		}
	}
	
	function UpdateAvatar(int $id){
		$uid=$id;
		$file=$this->file;
		require_once("./imagick.php");
		$img=new lib_image_imagick();
		$img->open($file["tmp_name"]);
		$type=$img->get_type();
		if(file_exists($this->dir.$uid.".gif")){
			unlink($this->dir.$uid.".gif");
		}
		if(file_exists($this->dir.$uid.".png")){
			unlink($this->dir.$uid.".png");
		}
		if($type=="gif"){
			$img->save_to($this->dir.$uid.".gif");
		}elseif($type=="png"||$type=="png8"||$type=="png24"||$type=="png32"){
		$w=$img->get_width();
		$h=$img->get_height();
		if($w>$h){
			$img->resize_to($w,256,"scale");
		}elseif($h>$w){
			$img->resize_to(256,$h,"scale");
		}
		$img->resize_to(256,256,"center");
		$img->save_to($this->dir.$uid.".png");
		}elseif($type=="jpg"||$type=="jpeg"||$type=="tiff"||$type=="bmp"){
			$w=$img->get_width();
			$h=$img->get_height();
			if($w>$h){
				$img->resize_to($w,256,"scale");
			}elseif($h>$w){
				$img->resize_to(256,$h,"scale");
			}
			$img->resize_to(256,256,"center");
			$img->set_type("png");
			$img->save_to($this->dir.$uid.".png");
		}
		return true;
	}
	
	function UpdateBackground(int $id){
		$uid=$id;
		$file=$this->file;
		require_once("./imagick.php");
		$img=new lib_image_imagick();
		$img->open($file["tmp_name"]);
		$type=$img->get_type();
		if(file_exists($this->dir.$uid.".gif")){
			unlink($this->dir.$uid.".gif");
		}
		if(file_exists($this->dir.$uid.".jpg")){
			unlink($this->dir.$uid.".jpg");
		}
		if($type=="gif"){
			$img->save_to($this->dir.$uid.".gif");
		}elseif($type=="jpg"||$type=="jpeg"){
			$w=$img->get_width();
			$h=$img->get_height();
			if($w>$h){
				$img->resize_to($w,480,"scale");
			}elseif($h>$w){
				$img->resize_to(960,$h,"scale");
			}
			$img->resize_to(960,480,"center");
			$img->save_to($this->dir.$uid.".jpg");
		}elseif($type=="png"||$type=="png8"||$type=="png24"||$type=="png32"||$type=="tiff"||$type=="bmp"){
			$w=$img->get_width();
			$h=$img->get_height();
			if($w>$h){
				$img->resize_to($w,480,"scale");
			}elseif($h>$w){
				$img->resize_to(960,$h,"scale");
			}
			$img->resize_to(256,256,"center");
			$img->set_type("jpg");
			$img->image->setImageCompressionQuality(90);
			$img->save_to($this->dir.$uid.".jpg");
		}
		return true;
	}
}
?>