<?php

namespace App\Interactr;

use App\Metric;

class ProjectView extends Metric
{
    protected $fillable = ['api_key', 'date', 'project_id', 'unique'];

    protected $table = 'interactr_project_views';

    public $timestamps = false;
}
