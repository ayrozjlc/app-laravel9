<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class ImageController extends Controller
{
	public function index()
	{
        try {
            $this->status = parent::SUCCESS;
            $this->message = '';
            $this->data = [];

            return $this->asJson();
        } catch (Throwable $e) {
            return $this->baseException($e);
        }
	}
}
