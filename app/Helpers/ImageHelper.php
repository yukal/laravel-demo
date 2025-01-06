<?php

namespace App\Helpers;

// use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function createPNGImage(int $w, $h, string $text = ''): string
    {
        $imgPath = storage_path('app/private/.fakeimage.png');

        $img = imagecreate($w, $h);
        $background = imagecolorallocate($img, 25, 25, 25);

        if ($text != '') {
            $textColor = imagecolorallocate($img, 255, 255, 0);
            $textSize = 20;

            // $textFont = Storage::disk('local')->get('NotoSansMono[wght].ttf');
            $textFont = storage_path('app/private/fonts/NotoSansMono-SemiBold.ttf');

            // Determine center by X, Y

            $box = imagettfbbox($textSize, 0, $textFont, $text);

            $textWidth = abs($box[2]) - abs($box[0]);
            $textHeight = abs($box[5]) - abs($box[3]);

            $x = (imagesx($img) - $textWidth) / 2;
            $y = (imagesy($img) + $textHeight) / 2;

            // Write text

            imagettftext($img, $textSize, 0, $x, $y, $textColor, $textFont, $text);
            // imagestring($img, $textSize, $x, $y, $text,  $textColor);
        }

        imagepng($img, $imgPath);
        imagedestroy($img);

        // return Storage::disk('public')->putFile($dir, $dest);
        return $imgPath;
    }
}
