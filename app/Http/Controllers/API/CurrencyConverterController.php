<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CurrencyConverterController extends Controller
{
    /**
     * Convert USD to IRT
     * @group Currency Converter
     * @authenticated
     */
    public function convertUsdToIrt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $usdAmount = $request->amount;

        try {
            // دریافت نرخ دلار از API نوبیتکس
            $response = Http::timeout(10)->get('https://apiv2.nobitex.ir/v3/orderbook/USDTIRT');

            if (!$response->successful()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch exchange rate from Nobitex'
                ], 500);
            }

            $data = $response->json();

            if (!isset($data['status']) || $data['status'] !== 'ok') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid response from Nobitex'
                ], 500);
            }

            // گرفتن آخرین قیمت معامله شده
            $exchangeRate = (float) $data['lastTradePrice'];

            // محاسبه مبلغ نهایی به تومان
            $irtAmount = $usdAmount * $exchangeRate;

            // فرمت کردن اعداد برای نمایش بهتر
            $formattedUsdAmount = number_format($usdAmount, 2, '.', ',');
            $formattedExchangeRate = number_format($exchangeRate, 0, '.', ',');
            $formattedIrtAmount = number_format($irtAmount, 0, '.', ',');

            return response()->json([
                'status' => 'success',
                'data' => [
                    'usd_amount' => (float) $usdAmount,
                    'usd_amount_formatted' => $formattedUsdAmount,
                    'exchange_rate' => $exchangeRate,
                    'exchange_rate_formatted' => $formattedExchangeRate,
                    'irt_amount' => $irtAmount,
                    'irt_amount_formatted' => $formattedIrtAmount,
                    'currency' => 'IRT',
                    'source' => 'Nobitex',
                    'timestamp' => now()->toIso8601String(),
                    'last_update' => isset($data['lastUpdate']) ? date('Y-m-d H:i:s', $data['lastUpdate'] / 1000) : null,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
