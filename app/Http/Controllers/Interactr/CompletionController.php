<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\Completion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CompletionController extends MetricController
{
    protected $modelClass = Completion::class;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'project_id' => $request->project_id
            ]);

            $model->increment('count');

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
