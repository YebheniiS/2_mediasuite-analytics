<?php

namespace App\Interactr;

use App\Metric;

class MediaView extends Metric
{
    protected $fillable = ['api_key', 'date', 'media_id', 'unique', 'project_id'];

    protected $table = 'interactr_media_views';

    public $timestamps = false;
}
