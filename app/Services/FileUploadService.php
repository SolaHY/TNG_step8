<?php
 
namespace App\Services;
 
class FileUploadService {
 
    public function saveImage($img_path){
      $path = '';
      if( isset($img_path) === true ){
          $path = $img_path->store('photos', 'public');
      }
      return $path;; // 画像が存在しない場合は空文字
    }
}