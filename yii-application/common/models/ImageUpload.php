<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\base\ExitException;

class ImageUpload extends Model
{
	public $image;

	public function rules()
	{
		return [
			[['image'], 'required'],
			[['image'], 'file', 'extensions' => 'jpg,png']
		];
	}

	private function getFolder(){
		return Yii::getAlias('@frontend') . '/web/uploads/';
	}

	private function generateFilename(){
		return strtolower(md5(uniqid($this->image->baseName)). '.' . $this->image->extension);
	}

	public function saveImage()
	{
		$filename  = $this->generateFilename();

		$this->image->saveAs($this->getFolder() . $filename);
		
		return $filename;
	}

	public function uploadImage(UploadedFile $file){

		$this->image = $file;

		if($this->validate()){

			return $this->saveImage();
		}
	}
}