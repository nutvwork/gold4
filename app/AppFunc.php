<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Image;

class AppFunc {
    public static function deleteImage($path) {
        return Storage::disk('public')->delete(str_replace('/storage', '', $path));
    }

    public static function storeImage($file, $folder, $imgWidth = 0, $imgHeight = 0) {
        $imgPath = Storage::url($file->store($folder, 'public'));

        if ($imgWidth != 0 && $imgHeight != 0) {
            $img = Image::make(public_path($imgPath));
            $img->fit($imgWidth, $imgHeight);
            $img->save();
        }

        return $imgPath;
    }
}
