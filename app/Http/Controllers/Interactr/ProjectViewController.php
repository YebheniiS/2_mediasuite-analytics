<?php

namespace App\Http\Controllers\Interactr;

use App\Interactr\ProjectView;
use App\Http\Controllers\MetricController;
use App\Interactr\ProjectViewByDevice;
use App\Interactr\ProjectViewByLocation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ProjectViewController extends MetricController
{
    protected $modelClass = ProjectView::class;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public final function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'project_id' => $request->project_id
            ]);

            $model->increment('count');

            if($request->has('unique') && $request->unique){
                $model->increment('unique');
            }

            $return['views'] = $model;

            if($request->has('country_code') && $request->country_code){
                $return['country_code'] = ProjectViewByLocation::firstOrCreate([
                    'api_key' => $request->apiKey,
                    'date' => $carbon->format('Y-m-d'),
                    'project_id' => $request->project_id,
                    'country_code' => $request->country_code
                ]);

                $return['country_code']->increment('count');
            }

            if($request->has('device') && $request->device){
                $return['device'] = ProjectViewByDevice::firstOrCreate([
                    'api_key' => $request->apiKey,
                    'date' => $carbon->format('Y-m-d'),
                    'project_id' => $request->project_id,
                ]);

                if($request->device === 'mobile'){
                    $return['device']->increment('mobile');
                }

                if($request->device === 'desktop'){
                    $return['device']->increment('desktop');
                }
            }

            return response()->json($return);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

}
