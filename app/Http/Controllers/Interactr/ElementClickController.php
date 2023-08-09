<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\Impression;
use App\Interactr\ElementClick;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ElementClickController extends MetricController
{
    //
    protected $modelClass = ElementClick::class;

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
                'project_id' => $request->project_id,
                'node_id' => $request->node_id,
                'date' => $carbon->format('Y-m-d'),
                'interaction_id' => $request->has('interaction_id') ? $request->interaction_id : 0,
                'modal_element_id' => $request->has('modal_element_id') ? $request->modal_element_id : 0,
            ]);

            $model->increment('count');

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
