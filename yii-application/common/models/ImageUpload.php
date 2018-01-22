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

	/**
     * Путь к изображениям
     */
	private function getFolder(){
		return Yii::getAlias('@frontend') . '/web/uploads/';
	}

	/**
     * Генерация уникального имени
     */
	private function generateFilename(){
		return strtolower(md5(uniqid($this->image->baseName)). '.' . $this->image->extension);
	}

	/**
     * Сохранение изображения по пути getFolder()
     */
	public function saveImage()
	{
		$filename  = $this->generateFilename();

		$this->image->saveAs($this->getFolder() . $filename);
		
		return $filename;
	}

	/**
     * Загрузка файла
     */
	public function uploadImage(UploadedFile $file){

		$this->image = $file;

		if($this->validate()){

			return $this->saveImage();
		}
	}
}