<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;

class ResponseService extends Service
{
    public function success(array $params = [])
    {
        return $this->response(200, array_merge(['success' => true], $params));
    }


    public function error(array $params = [])
    {
        return $this->response(403, array_merge(['success' => false], $params));
    }


    private function response(int $statusCode, array $params = [])
    {
        return response()->json(
            $params,
            $statusCode
        );
    }
}
