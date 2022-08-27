<?php

namespace App\Exceptions;

use App\Utilities\Interfaces\JsendStatusValues;

class BaseException implements JsendStatusValues
{
    protected $e;
    protected int $stateResponse;

    public function stateResponse() {
        return $this->stateResponse;
    }

    public function responseJson($e) : array
    {
        $typeError = get_class($e);
        $exceptionCode = $e->getCode();
        $exceptionMessage = $e->getMessage();
        $this->stateResponse = $this->stateResponse ?? 400;
        $response = [
            'status' => JsendStatusValues::ERROR,
            'data' => [
                'file' => $e->getFile(),
                'Line' => $e->getLine()
            ],
            'message' => $exceptionMessage,
            'code' => $exceptionCode
        ];

        if ($typeError === 'Error') {
            $response['status'] = JsendStatusValues::WARNING;
            $response['message'] = __('exceptions.error') . ' (' . __('exceptions.3') . ')';
            $response['code'] = 3;
            $response['data']['message'] = $exceptionMessage;
            $this->stateResponse = 501;
        } else if ($typeError === 'Illuminate\Database\QueryException') {
            $response['status'] = JsendStatusValues::ERROR;
            $response['message'] = __('exceptions.error') . ' (' . __('exceptions.4') . ')';
            $response['code'] = 4;
            $response['data']['message'] = $exceptionMessage;
            $this->stateResponse = 500;
        }

        return $response;
    }
}
