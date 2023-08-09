<?php

namespace App\Interactr;

use App\Metric;

class UploadStorage extends Metric
{
    protected $fillable = ['api_key', 'project_id', 'date', 'user_id', 'media_id', 'storage_used'];

    protected $table = 'interactr_upload_storage';

    public $timestamps = false;
}
