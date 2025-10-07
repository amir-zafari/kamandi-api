<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CaptchaController extends Controller
{
    /**
     * تولید کپچای تصویری و ذخیره جواب در cache
     */
    public function generate(Request $request)
    {
        // متن کپچا (5 کاراکتر تصادفی)
        $text = strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5));
        $captchaId = (string) Str::uuid();

        // تصویر 200x70
        $width = 200;
        $height = 70;
        $img = imagecreatetruecolor($width, $height);

        // رنگ‌ها
        $bgColor = imagecolorallocate($img, 240, 240, 240);
        $textColor = imagecolorallocate($img, 30, 30, 30);

        // پس‌زمینه
        imagefilledrectangle($img, 0, 0, $width, $height, $bgColor);

        // نویز: خطوط
        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate($img, rand(100,200), rand(100,200), rand(100,200));
            imageline($img, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $lineColor);
        }

        // نویز: نقاط
        for ($i = 0; $i < 200; $i++) {
            $dotColor = imagecolorallocate($img, rand(100,240), rand(100,240), rand(100,240));
            imagesetpixel($img, rand(0,$width), rand(0,$height), $dotColor);
        }

        // نوشتن متن روی تصویر
        $fontPath = base_path('resources/fonts/Roboto-Bold.ttf'); // اگر فونت داری
        $fontSize = 28;

        if (file_exists($fontPath)) {
            // چرخش هر کاراکتر به صورت تصادفی
            $x = 20;
            $y = 50;
            for ($i = 0; $i < strlen($text); $i++) {
                $angle = rand(-20, 20);
                imagettftext($img, $fontSize, $angle, $x, $y, $textColor, $fontPath, $text[$i]);
                $x += 30; // فاصله بین حروف
            }
        } else {
            // fallback ساده
            imagestring($img, 5, 50, 20, $text, $textColor);
        }

        // خروجی base64
        ob_start();
        imagepng($img);
        $imageData = ob_get_clean();
        imagedestroy($img);

        $base64 = 'data:image/png;base64,' . base64_encode($imageData);

        // ذخیره جواب در Redis یا Cache
        Cache::put("captcha:$captchaId", $text, now()->addMinutes(2));

        return response()->json([
            'status' => 'success',
            'captcha_id' => $captchaId,
            'image' => $base64,
            'expires_in' => 120
        ]);
    }
}
