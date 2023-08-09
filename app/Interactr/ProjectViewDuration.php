<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class ProjectViewDuration extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id', 'timestamp'];

    protected $table = 'interactr_project_view_duration';

    public $timestamps = false;
}
