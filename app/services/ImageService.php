<?php

// namespace App\Services;
// use Illuminate\Support\Facades\Storage;
// use InterventionImage;

// class ImageService
// {
//     public static function upload($imageFile, $folderName){
//         // dd($imageFile['image']);

//         if(is_array($imageFile)){
//             $file = $imageFile['image'];
//         }else {
//             $file = $imageFile;
//         }
//         $fileName = uniqid(rand().'_');
//         $extension = $file->extension(); //拡張子取得
//         $fileNameToStore = $fileName.'.' . $extension; //拡張子とファイルを結合
//         $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode(); //サイズを指定してからエンコードにする
//         Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage ); //第一引数フォルダからのファイル名　第二引数リサイズした画像
//         return $fileNameToStore;
//     }
// }

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;


class ImageService
{
  public static function upload($imageFile, $folderName){
    //dd($imageFile['image']);
    if(is_array($imageFile))
    {
      $file = $imageFile['image'];
    } else {
      $file = $imageFile;
    }

    $fileName = uniqid(rand().'_');
    $extension = $file->extension();
    $fileNameToStore = $fileName. '.' . $extension;
    $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
    Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage );

    return $fileNameToStore;
  }
}
