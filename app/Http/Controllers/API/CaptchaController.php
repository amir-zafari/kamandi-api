<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CaptchaController extends Controller
{
    /**
     * Captcha generate
     * @unauthenticated
     * @group Authentication
     */
    public function generate(Request $request)
    {
        // متن کپچا (5 کاراکتر تصادفی)
        $text = strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5));
        $captchaId = (string) Str::uuid();

        // تصویر 150x60
        $width = 150;
        $height = 60;
        $img = imagecreatetruecolor($width, $height);

        // رنگ پس‌زمینه
        $bgColor = imagecolorallocate($img, 240, 240, 240);
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
        $fontPath = base_path('resources/fonts/Roboto-Bold.ttf');
        $fontSize = 22;

        if (file_exists($fontPath)) {

            $x = 15;
            $y = 45;

            for ($i = 0; $i < strlen($text); $i++) {

                // رنگ تصادفی برای هر حرف
                $charColor = imagecolorallocate(
                    $img,
                    rand(0, 150),
                    rand(0, 150),
                    rand(0, 150)
                );

                $angle = rand(-20, 20);

                imagettftext(
                    $img,
                    $fontSize,
                    $angle,
                    $x,
                    $y,
                    $charColor,
                    $fontPath,
                    $text[$i]
                );

                $x += 28; // فاصله بین حروف
            }

        } else {
            // اگر فونت نبود (Fallback)
            $x = 20;
            for ($i = 0; $i < strlen($text); $i++) {
                $charColor = imagecolorallocate($img, rand(0,150), rand(0,150), rand(0,150));
                imagestring($img, 5, $x, 20, $text[$i], $charColor);
                $x += 20;
            }
        }

        // خروجی base64
        ob_start();
        imagepng($img);
        $imageData = ob_get_clean();
        imagedestroy($img);

        $base64 = 'data:image/png;base64,' . base64_encode($imageData);

        // ذخیره کپچا
        Cache::put("captcha:$captchaId", $text, now()->addMinutes(2));

        return response()->json([
            'status' => 'success',
            'captcha_id' => $captchaId,
            'image' => $base64,
            'expires_in' => 120
        ]);
    }
}
