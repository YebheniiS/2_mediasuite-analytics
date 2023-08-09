<?php
namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id'];

    protected $table = 'interactr_completions';

    public $timestamps = false;
}
