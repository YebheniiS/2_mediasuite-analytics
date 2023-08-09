<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class ModalView extends Model
{
    protected $fillable = ['api_key', 'date', 'modal_id', 'project_id'];

    protected $table = 'interactr_modal_views';

    public $timestamps = false;
}
