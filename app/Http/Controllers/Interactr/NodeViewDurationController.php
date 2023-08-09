<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\NodeViewDuration;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeViewDurationController extends MetricController
{
    //
    protected $modelClass = NodeViewDuration::class;

    public function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'project_id' => $request->project_id,
                'node_id' => $request->node_id,
            ]);

            $model->increment( $request->percentage_viewed );

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function query($request){

        $from = Carbon::createFromDate($request['start_date']);
        $to = Carbon::createFromDate($request['end_date']);

        // Reworked this to make it more efficent, leaving the old version here in case any issues
        $query  =  DB::table('interactr_node_view_duration')
            ->where('project_id', $request['filters']['project_id'])
            ->whereBetween('date', [$from, $to])
            ->groupBy('node_id')
            ->select(
                DB::raw('node_id'),
                DB::raw('SUM(`10%`) as `10%`'),
                DB::raw('SUM(`20%`) as `20%`'),
                DB::raw('SUM(`30%`) as `30%`'),
                DB::raw('SUM(`40%`) as `40%`'),
                DB::raw('SUM(`50%`) as `50%`'),
                DB::raw('SUM(`60%`) as `60%`'),
                DB::raw('SUM(`70%`) as `70%`'),
                DB::raw('SUM(`80%`) as `80%`'),
                DB::raw('SUM(`90%`) as `90%`'),
                DB::raw('SUM(`100%`) as `100%`')
            )->get();

        // The new format gives the data different to the old way so we need to reformat so
        // any client that consumes the api still gets the data in the same format
        $result = [];
        foreach ($query as $q) {
            $result[$q->node_id] = [
                '10%' => $q->{"10%"},
                '20%' => $q->{"20%"},
                '30%' => $q->{"30%"},
                '40%' => $q->{"40%"},
                '50%' => $q->{"50%"},
                '60%' => $q->{"60%"},
                '70%' => $q->{"70%"},
                '80%' => $q->{"80%"},
                '90%' => $q->{"90%"},
                '100%' => $q->{"100%"},
            ];
        }

        return $result;


        // This is a slow and messy way to do this will need to refactor for larger data
//        $nodes = $this->modelClass::where('project_id', $request['filters']['project_id'])
//                        ->whereBetween('date', [$from, $to])
//                        ->groupBy('node_id')
//                        ->select('node_id')
//                        ->get()->toArray();
//
//        $result = [];
//
//        foreach($nodes as $node) {
//            $result[$node->node_id] = DB::table('interactr_node_view_duration')
//                ->where('node_id', $node->node_id)
//                ->whereBetween('date', [$from, $to])
//                ->select(
//                    DB::raw('SUM(`10%`) as `10%`'),
//                    DB::raw('SUM(`20%`) as `20%`'),
//                    DB::raw('SUM(`30%`) as `30%`'),
//                    DB::raw('SUM(`40%`) as `40%`'),
//                    DB::raw('SUM(`50%`) as `50%`'),
//                    DB::raw('SUM(`60%`) as `60%`'),
//                    DB::raw('SUM(`70%`) as `70%`'),
//                    DB::raw('SUM(`80%`) as `80%`'),
//                    DB::raw('SUM(`90%`) as `90%`'),
//                    DB::raw('SUM(`100%`) as `100%`')
//                )->first();
//        }
//
//        return $result;
    }
}
