<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseException;
use App\Utilities\Enums\JsendStatus;
use App\Utilities\Interfaces\JsendStatusValues;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class Controller extends BaseController implements JsendStatusValues
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public string $status = '';
    public $data = [];
    public string $message = '';
    public int $stateResponse;
    protected $responseJson = [];

    public function asJson()
    {
        if (empty($this->status)) {
            $msg = __('exceptions.1', ['var' => 'status']);
            throw new Exception($msg, 1);
        }

        JsendStatus::success->valid($this->status);
        $this->stateResponse = $this->stateResponse ?? 200;
        $this->responseJson = [
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message
        ];

        return $this->asResponse();
    }

    public function asResponse()
    {
        return response()->json($this->responseJson, $this->stateResponse);
    }

    public function baseException($e)
    {
        $exceptions = new BaseException();
        $this->responseJson = $exceptions->responseJson($e);
        $this->stateResponse =  $this->stateResponse ?? $exceptions->stateResponse();

        return $this->asResponse();
    }
}
