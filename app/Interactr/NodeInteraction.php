<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class NodeInteraction extends Model
{
    protected $fillable = ['api_key', 'date', 'project_id', 'view_path'];

    protected $table = 'interactr_node_interactions';

    public $timestamps = false;
}
