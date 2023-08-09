<?php

namespace App\Http\Controllers\Interactr;

use App\Interactr\NodeInteraction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\MetricController;
use Illuminate\Support\Facades\DB;

class NodeInteractionController extends MetricController
{
    //
    protected $modelClass = NodeInteraction::class;

    public function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'project_id' => $request->project_id,
                'view_path' => $request->view_path
            ]);

            $model->increment('count');

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function query($request){
        $from = Carbon::createFromDate($request['start_date']);
        $to = Carbon::createFromDate($request['end_date']);

        return DB::table('interactr_node_interactions')
            ->where('project_id', $request['filters']['project_id'])
            ->whereBetween('date', [$from, $to])
            ->select('view_path',
                DB::raw('SUM(count) as count')
            )
            ->groupBy('view_path')
            ->get();
    }

}
