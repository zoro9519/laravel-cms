<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    public function retrieveReponse($message = null, mixed $data = null, $code = Response::HTTP_OK)
    {
        return $this->responseHandle(status: true, message: $message, data: $data, code: $code);
    }

    private function responseHandle(bool $status, string $message = null, mixed $data = null, int $code)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data?->response()->getData(true),
        ];
        return response($response, $code);
    }
}
