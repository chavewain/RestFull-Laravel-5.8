<?php

namespace App\Http\Traits;

// use Illuminate\Support\Collection;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
    	return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
    	return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll($collection, $code = 200)
    {
    	return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne($instance, $code = 200)
    {
    	return $this->successResponse(['data' => $instance], $code);
    }
}
