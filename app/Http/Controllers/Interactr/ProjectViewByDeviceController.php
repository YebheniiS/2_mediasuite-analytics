<?php

namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\ProjectViewByDevice;
use Illuminate\Http\Request;

class ProjectViewByDeviceController extends MetricController
{
    //
    protected $modelClass = ProjectViewByDevice::class;
}
