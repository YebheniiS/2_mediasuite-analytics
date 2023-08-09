<?php

namespace App\Interactr;

use Illuminate\Database\Eloquent\Model;

class StorageCredits extends Model
{
    protected $hidden = ['api_key'];
    protected $fillable = ['api_key', 'user_id'];
    protected $table = 'interactr_storage_credits';
    public $timestamps = false;
}