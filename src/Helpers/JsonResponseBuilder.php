<?php

namespace Vendor\LaravelRestToolkit\Helpers;

class JsonResponseBuilder
{
    protected $success;
    protected $message;
    protected $data;
    protected $status;
    protected $extra = [];

    // شروع ساخت یک پاسخ جدید
    public static function init()
    {
        return new self();
    }

    // تنظیم وضعیت موفقیت و داده‌ها
    public function success($data = [], $message = 'Operation successful')
    {
        $this->success = true;
        $this->data = $data;
        $this->message = $message;
        $this->status = 200;
        return $this;
    }

    // تنظیم وضعیت خطا و پیام خطا
    public function error($message = 'An error occurred', $status = 500)
    {
        $this->success = false;
        $this->message = $message;
        $this->data = null;
        $this->status = $status;
        return $this;
    }

    // افزودن جفت‌های کلید-مقدار اضافی به پاسخ
    public function addExtra($key, $value)
    {
        $this->extra[$key] = $value;
        return $this;
    }

    // تنظیم وضعیت HTTP سفارشی
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    // ساخت و بازگشت پاسخ JSON
    public function build()
    {
        $response = [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data
        ];

        // ترکیب هر فیلد اضافی
        if (!empty($this->extra)) {
            $response = array_merge($response, $this->extra);
        }

        return response()->json($response, $this->status);
    }
}
