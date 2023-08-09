<?php
namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\StreamingMins;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StreamingMinsController extends MetricController
{
    protected $modelClass = StreamingMins::class;

    public final function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'project_id' => $request->project_id,
                'date' => $carbon->format('Y-m-d'),
                'user_id' => $request->user_id,
                'node_id' => $request->node_id,
            ]);

            $model->increment('count');

            return response()->json($model);

        }catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
