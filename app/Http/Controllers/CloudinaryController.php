<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CloudinaryController extends Controller
{
    public static function path($path){
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function upload($file, $folderPath, $width = null, $height = null)
    {
        $randomString = Str::random(10);
        $public_id = $randomString . '_' . date('Ymd');

        $transformation = ["crop" => "fill"];

        if ($width) {
            $transformation["width"] = $width;
        }
        if ($height) {
            $transformation["height"] = $height;
        }

        $result = cloudinary()->upload($file, [
            "public_id" => self::path($public_id),
            "folder"    => $folderPath,
            "transformation" => $transformation
        ])->getSecurePath();

        return $result;
    }

    public static function replace($path, $file, $folderPath, $width = null, $height = null)
    {
        self::delete($path, $folderPath);
        return self::upload($file, $folderPath, $width, $height);
    }

    public static function delete($path, $folderPath)
    {
        $public_id = $folderPath . '/' . self::path($path);
        return cloudinary()->destroy($public_id);
    }
}
