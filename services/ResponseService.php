<?php

class ResponseService
{

    public function success_response($payload)
    {
        $response = [];
        $response["status"] = 200;
        $response["payload"] = $payload;
        return json_encode($response);
    }
    public function error_response($message, $status_code)
    {
        http_response_code($status_code);
        return json_encode(["error" => $message]);
    }
}
