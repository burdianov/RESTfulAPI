<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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

    protected function showAll(Collection $collection, $code = Response::HTTP_OK)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = Response::HTTP_OK)
    {
        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);
        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code = Response::HTTP_OK)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }
}