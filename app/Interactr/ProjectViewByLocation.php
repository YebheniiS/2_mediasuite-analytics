<?php
namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class ProjectViewByLocation extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id', 'country_code'];

    protected $table = 'interactr_project_views_by_location';

    public $timestamps = false;
}
