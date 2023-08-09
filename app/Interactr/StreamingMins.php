<?php

namespace App\Interactr;

use App\Metric;

class StreamingMins extends Metric
{
    protected $fillable = ['api_key', 'project_id', 'date', 'user_id', 'node_id'];

    protected $table = 'interactr_streaming_mins';

    public $timestamps = false;
}
