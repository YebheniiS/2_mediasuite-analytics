<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class ElementClick extends Model
{
    //
    protected $fillable = ['api_key', 'project_id', 'node_id', 'interaction_id', 'date', 'modal_element_id'];

    protected $table = 'interactr_element_clicks';

    public $timestamps = false;
}
