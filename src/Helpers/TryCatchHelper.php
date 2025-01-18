<?php

namespace Vendor\LaravelRestToolkit\Helpers;

use Throwable;
use Vendor\LaravelRestToolkit\Helpers\JsonResponseBuilder;

class TryCatchHelper
{
    /**
     * اجرای یک فراخوانی درون یک بلاک try-catch و بازگرداندن پاسخ JSON.
     *
     * @param callable $callback
     * @param string $successMessage
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function handle(callable $callback, string $successMessage = 'Operation successful', $status = 200)
    {
        try {
            // اجرای فراخوانی
            $result = $callback();

            // بازگشت پاسخ موفقیت‌آمیز
            return JsonResponseBuilder::init()
                ->success($result, $successMessage)
                ->setStatus($status)
                ->build();
        } catch (Throwable $e) {
            // لاگ کردن خطا
            \Log::error('Exception caught in TryCatchHelper: ' . $e->getMessage(), ['exception' => $e]);

            // تعیین کد وضعیت مناسب
            $statusCode = is_numeric($e->getCode()) && $e->getCode() > 0 ? (int) $e->getCode() : 500;

            // بازگشت پاسخ خطا
            return JsonResponseBuilder::init()
                ->error($e->getMessage(), $statusCode)
                ->build();
        }
    }
}
