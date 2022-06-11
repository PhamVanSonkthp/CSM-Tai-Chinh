<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait{
    public static function storageTraitUpload($request, $fieldName, $folderName){

        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs($folderName . '/' . auth()->id() , $fileNameHash, ['disk' => 'public']);
            $dataUpluadTrait = [
                'file_name'=> $fileNameOrigin,
                'file_path'=> Storage::url($filePath) ,
            ];

            return $dataUpluadTrait;
        }

        return null;
    }
    public static function storageTraitUploadMultiple($file, $folderName){

        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($folderName . '/' . auth()->id() , $fileNameHash, ['disk' => 'public']);
        $dataUpluadTrait = [
            'file_name'=> $fileNameOrigin,
            'file_path'=> Storage::url($filePath) ,
        ];

        return $dataUpluadTrait;
    }
}
