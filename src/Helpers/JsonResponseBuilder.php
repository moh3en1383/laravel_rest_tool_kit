<?php

namespace App\LaravelRestToolKit\Helpers;

class JsonResponseBuilder
{
    protected $success;
    protected $message;
    protected $data;
    protected $status;
    protected $extra = [];

    public static function init()
    {
        return new self();
    }

    public function success($data = [], $message = 'Operation successful')
    {
        $this->success = true;
        $this->data = $data;
        $this->message = $message;
        $this->status = 200;
        return $this;
    }

    public function error($message = 'An error occurred', $status = 500)
    {
        $this->success = false;
        $this->message = $message;
        $this->data = null;
        $this->status = $status;
        return $this;
    }

    public function addExtra($key, $value)
    {
        $this->extra[$key] = $value;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function build()
    {
        $response = [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data
        ];

        if (!empty($this->extra)) {
            $response = array_merge($response, $this->extra);
        }

        return response()->json($response, $this->status);
    }
}
