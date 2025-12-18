<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CurrencyConverterController extends Controller
{
    /**
     * Convert USD to Iranian Toman (IRT) | تبدیل دلار به تومان (IRT)
     * 
     * Convert USD amount to Iranian Toman using live exchange rate from Nobitex API.
     * 
     * @authenticated
     * @group Currency Converter
     * 
     * @bodyParam amount numeric required USD amount to convert (must be positive). Example: 100
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "usd_amount": 100,
     *     "usd_amount_formatted": "100.00",
     *     "exchange_rate": 42000000,
     *     "exchange_rate_formatted": "42,000,000",
     *     "irt_amount": 4200000000,
     *     "irt_amount_formatted": "4,200,000,000",
     *     "currency": "IRT",
     *     "source": "Nobitex",
     *     "timestamp": "2024-01-15T10:30:00Z",
     *     "last_update": "2024-01-15 10:25:00"
     *   }
     * }
     * 
     * @response 422 {
     *   "status": "error",
     *   "errors": {
     *     "amount": ["The amount field is required."]
     *   }
     * }
     * 
     * @response 500 {
     *   "status": "error",
     *   "message": "Failed to fetch exchange rate from Nobitex"
     * }
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
