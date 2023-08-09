<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class NodeViewDuration extends Model
{
    //
    protected $fillable = ['api_key', 'date', 'project_id', 'timestamp', 'node_id'];

    protected $table = 'interactr_node_view_duration';

    public $timestamps = false;
}
