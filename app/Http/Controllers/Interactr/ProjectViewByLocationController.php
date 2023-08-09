<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\ProjectViewByLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectViewByLocationController extends MetricController
{
    //
    protected $modelClass = ProjectViewByLocation::class;


    public function query($request){
        $from = Carbon::createFromDate($request['start_date']);
        $to = Carbon::createFromDate($request['end_date']);

        $projects = (is_array($request['filters']['project_id'])) ? $request['filters']['project_id'] : [$request['filters']['project_id']];

        return ProjectViewByLocation::whereBetween('date', [$from, $to])
                ->whereIn('project_id', $projects)
                ->get();
    }
}
