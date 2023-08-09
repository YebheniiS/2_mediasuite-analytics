<?php
namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id'];

    protected $table = 'interactr_impressions';

    public $timestamps = false;
}
