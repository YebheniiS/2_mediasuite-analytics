<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\ProjectViewDuration;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectViewDurationController extends MetricController
{
    //
    protected $modelClass = ProjectViewDuration::class;

    public function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'project_id' => $request->project_id,
                'timestamp' => $request->timestamp
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

        return DB::table('interactr_project_view_duration')
                    ->whereBetween('date', [$from, $to])
                    ->where('project_id', $request['filters']['project_id'])
                    ->select('timestamp', DB::raw('SUM(count) as count'))
                    ->groupBy('timestamp')
                    ->get();

    }
}
