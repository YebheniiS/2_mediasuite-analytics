<?php
namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class ProjectViewByDevice extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id', 'mobile', 'desktop'];

    protected $table = 'interactr_project_views_by_device';

    public $timestamps = false;
}
