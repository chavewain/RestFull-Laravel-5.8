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
        if($collection->isEmpty())
            $this->successResponse($collection);

        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);

    	return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne($instance, $code = 200)
    {
    	return $this->successResponse(['data' => $instance], $code);
    }

    protected function showMessage($message, $code = 200){
        return $this->successResponse(['data' => $message], $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }
}
